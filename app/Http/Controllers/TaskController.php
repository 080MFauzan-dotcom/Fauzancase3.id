<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Support\StudyActivity;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function dashboard(Request $request): View
    {
        $userId = $request->user()->id;
        $version = $this->cacheVersion($userId);
        $summary = $this->summaryFor($userId, $version);
        $upcomingTasks = cache()->remember('tasks.upcoming.'.$userId.'.'.$version, now()->addMinutes(5), function () use ($userId) {
            return Task::query()
                ->where('user_id', $userId)
                ->where('status', '!=', 'completed')
                ->whereNotNull('due_date')
                ->orderBy('due_date')
                ->limit(5)
                ->get();
        });
        $courseCount = cache()->remember('tasks.course-count.'.$userId.'.'.$version, now()->addMinutes(5), function () use ($userId) {
            return Task::query()->where('user_id', $userId)->distinct()->count('course');
        });
        $activity = StudyActivity::forUser($userId);

        return view('dashboard', compact('summary', 'upcomingTasks', 'courseCount') + $activity);
    }

    public function index(Request $request): View
    {
        $filters = $request->validate([
            'status' => ['nullable', 'in:pending,in_progress,completed'],
            'course' => ['nullable', 'string', 'max:150'],
            'search' => ['nullable', 'string', 'max:255'],
            'page' => ['sometimes', 'integer', 'min:1'],
        ]);
        $filters['page'] = (int) ($filters['page'] ?? 1);
        $userId = $request->user()->id;
        $version = $this->cacheVersion($userId);
        $cacheKey = 'tasks.active.'.$userId.'.'.$version.'.'.hash('sha256', serialize($filters));

        $tasks = cache()->remember($cacheKey, now()->addMinutes(5), function () use ($request, $filters) {
            return Task::query()
                ->where('user_id', $request->user()->id)
                ->when(! empty($filters['status']), fn ($query) => $query->where('status', $filters['status']))
                ->when(! empty($filters['course']), fn ($query) => $query->where('course', $filters['course']))
                ->when(! empty($filters['search']), fn ($query) => $query->where('title', 'like', '%'.$filters['search'].'%'))
                ->orderByRaw("CASE WHEN status = 'completed' THEN 1 ELSE 0 END")
                ->orderByRaw('CASE WHEN due_date IS NULL THEN 1 ELSE 0 END')
                ->orderBy('due_date')
                ->latest('id')
                ->paginate(10)
                ->appends($filters);
        });
        $courses = cache()->remember('tasks.courses.'.$userId.'.'.$version, now()->addMinutes(5), function () use ($userId) {
            return Task::query()
                ->where('user_id', $userId)
                ->whereNotNull('course')
                ->distinct()
                ->orderBy('course')
                ->pluck('course');
        });

        return view('tasks.index', compact('tasks', 'courses'));
    }

    public function create(): View
    {
        return view('tasks.create');
    }

    public function store(Request $request): RedirectResponse
    {
        Task::create($this->validatedTask($request) + ['user_id' => $request->user()->id]);
        $this->bumpCacheVersion($request->user()->id);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function edit(Task $task): View
    {
        $this->ensureOwner($task);

        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task): RedirectResponse
    {
        $this->ensureOwner($task);
        $task->update($this->validatedTask($request));
        $this->bumpCacheVersion($request->user()->id);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil diperbarui.');
    }

    public function destroy(Request $request, Task $task): RedirectResponse
    {
        $this->ensureOwner($task);
        $task->delete();
        $this->bumpCacheVersion($request->user()->id);

        return redirect()->route('tasks.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function trash(Request $request): View
    {
        $userId = $request->user()->id;
        $page = max(1, (int) $request->query('page', 1));
        $cacheKey = 'tasks.trash.'.$userId.'.'.$this->cacheVersion($userId).'.'.$page;
        $tasks = cache()->remember($cacheKey, now()->addMinutes(5), function () use ($userId) {
            return Task::onlyTrashed()
                ->where('user_id', $userId)
                ->latest('deleted_at')
                ->paginate(10);
        });

        return view('tasks.trash', compact('tasks'));
    }

    public function restore(Request $request, int $task): RedirectResponse
    {
        $deletedTask = Task::onlyTrashed()
            ->where('user_id', $request->user()->id)
            ->findOrFail($task);
        $deletedTask->restore();
        $this->bumpCacheVersion($request->user()->id);

        return redirect()->route('tasks.trash')->with('success', 'Tugas berhasil dipulihkan.');
    }

    public function forceDelete(Request $request, int $task): RedirectResponse
    {
        $deletedTask = Task::onlyTrashed()
            ->where('user_id', $request->user()->id)
            ->findOrFail($task);
        $deletedTask->forceDelete();
        $this->bumpCacheVersion($request->user()->id);

        return redirect()->route('tasks.trash')->with('success', 'Tugas dihapus permanen.');
    }

    private function ensureOwner(Task $task): void
    {
        abort_unless((int) $task->user_id === (int) Auth::id(), 404);
    }

    private function cacheVersion(int $userId): int
    {
        return (int) cache()->get('tasks.version.'.$userId, 1);
    }

    private function summaryFor(int $userId, int $version): object
    {
        $summary = cache()->remember('tasks.summary.'.$userId.'.'.$version, now()->addMinutes(5), function () use ($userId) {
            return Task::query()
                ->where('user_id', $userId)
                ->selectRaw(
                    "COUNT(*) as total,
                    COUNT(CASE WHEN status = 'pending' THEN 1 END) as pending,
                    COUNT(CASE WHEN status = 'in_progress' THEN 1 END) as in_progress,
                    COUNT(CASE WHEN status = 'completed' THEN 1 END) as completed,
                    COUNT(CASE WHEN due_date >= ? AND due_date <= ? AND status != 'completed' THEN 1 END) as due_soon",
                    [now()->toDateString(), now()->addDays(7)->toDateString()]
                )
                ->first();
        });

        $summary->completion_rate = $summary->total > 0
            ? (int) round($summary->completed / $summary->total * 100)
            : 0;

        return $summary;
    }

    private function bumpCacheVersion(int $userId): void
    {
        $key = 'tasks.version.'.$userId;
        cache()->put($key, $this->cacheVersion($userId) + 1, now()->addDays(30));
    }

    private function validatedTask(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:255'],
            'course' => ['required', 'string', 'max:150'],
            'assignment_type' => ['required', 'in:assignment,exam,project,presentation,reading,quiz,lab,other'],
            'description' => ['nullable', 'string', 'max:5000'],
            'status' => ['required', 'in:pending,in_progress,completed'],
            'priority' => ['required', 'in:low,medium,high'],
            'due_date' => ['nullable', 'date'],
        ]);
    }
}
