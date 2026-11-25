<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TaskSeeder extends Seeder
{
    public function run(): void
    {
        $student = User::firstOrCreate(
            ['email' => 'mahasiswa@example.test'],
            [
                'name' => 'Mahasiswa Demo',
                'password' => Hash::make('password'),
            ],
        );

        if ($student->tasks()->withTrashed()->exists()) {
            return;
        }

        $student->tasks()->createMany([
            [
                'title' => 'Rancang ERD sistem perpustakaan',
                'course' => 'Basis Data',
                'assignment_type' => 'assignment',
                'description' => 'Buat ERD dan dokumentasikan relasi antar tabel.',
                'status' => 'in_progress',
                'priority' => 'high',
                'due_date' => now()->addDays(3)->toDateString(),
            ],
            [
                'title' => 'Presentasi algoritma pencarian',
                'course' => 'Struktur Data',
                'assignment_type' => 'presentation',
                'description' => 'Siapkan presentasi kelompok tentang binary search.',
                'status' => 'pending',
                'priority' => 'medium',
                'due_date' => now()->addDays(7)->toDateString(),
            ],
            [
                'title' => 'Kuis kalkulus',
                'course' => 'Kalkulus',
                'assignment_type' => 'quiz',
                'description' => null,
                'status' => 'completed',
                'priority' => 'low',
                'due_date' => now()->subDays(1)->toDateString(),
            ],
        ]);
    }
}
