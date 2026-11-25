<?php

namespace App\Support;

use App\Models\Task;
use Illuminate\Support\Collection;

class StudyActivity
{
    /**
     * @return array{weeklyActivity: Collection<int, array{label: string, date: \Illuminate\Support\Carbon, count: int}>, studyStreak: int}
     */
    public static function forUser(int $userId): array
    {
        $weekStart = now()->startOfWeek()->startOfDay();
        $weekEnd = now()->endOfWeek()->endOfDay();
        $activityCounts = Task::query()
            ->where('user_id', $userId)
            ->whereBetween('created_at', [$weekStart->copy()->subDays(6), $weekEnd])
            ->get(['created_at'])
            ->countBy(fn (Task $task) => $task->created_at->format('Y-m-d'));
        $dayLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
        $weeklyActivity = collect(range(0, 6))->map(function (int $offset) use ($weekStart, $activityCounts, $dayLabels) {
            $date = $weekStart->copy()->addDays($offset);

            return [
                'label' => $dayLabels[$offset],
                'date' => $date,
                'count' => (int) $activityCounts->get($date->format('Y-m-d'), 0),
            ];
        });

        $streakDate = now()->startOfDay();
        if ($activityCounts->get($streakDate->format('Y-m-d'), 0) === 0) {
            $streakDate->subDay();
        }

        $studyStreak = 0;
        for ($offset = 0; $offset < 7; $offset++) {
            if ($activityCounts->get($streakDate->copy()->subDays($offset)->format('Y-m-d'), 0) === 0) {
                break;
            }

            $studyStreak++;
        }

        return compact('weeklyActivity', 'studyStreak');
    }
}
