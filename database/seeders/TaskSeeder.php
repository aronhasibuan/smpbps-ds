<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        #1
        Task::create([
            'activity_id' => 1,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '1_anggotatim1',
            'task_description' => 'Pencacahan Survei Hortikultura dan Indikator Pertanian',
            'task_volume' => 7,
            'task_latest_progress' => 6,
            'task_attachment' => null,
        ]);

        #2
        Task::create([
            'activity_id' => 1,
            'user_member_id' => 10,
            'status_id' => 2,
            'task_slug' => '2_anggotatim2',
            'task_description' => 'Pencacahan Survei Hortikultura dan Indikator Pertanian',
            'task_volume' => 2,
            'task_latest_progress' => 0,
            'task_attachment' => null,
        ]);

        #3
        Task::create([
            'activity_id' => 2,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '3_anggotatim1',
            'task_description' => 'Pencacahan Survei Pertanian Tanaman Pangan atau Ubinan',
            'task_volume' => 5,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #4 
        Task::create([
            'activity_id' => 2,
            'user_member_id' => 11,
            'status_id' => 2,
            'task_slug' => '4_anggotatim3',
            'task_description' => 'Pencacahan Survei Pertanian Tanaman Pangan atau Ubinan',
            'task_volume' => 10,
            'task_latest_progress' => 0,
            'task_attachment' => null,
        ]);

        #5
        Task::create([
            'activity_id' => 3,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '5_anggotatim1',
            'task_description' => 'Pencacahan Survei Perusahaan Perkebunan',
            'task_volume' => 3,
            'task_latest_progress' => 0,
            'task_attachment' => null,
        ]);

        #6
        Task::create([
            'activity_id' => 3,
            'user_member_id' => 12,
            'status_id' => 2,
            'task_slug' => '6_anggotatim4',
            'task_description' => 'Pencacahan Survei Perusahaan Perkebunan',
            'task_volume' => 4,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #7
        Task::create([
            'activity_id' => 4,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '7_anggotatim1',
            'task_description' => 'Pencacahan Survei Perusahaan Kehutanan',
            'task_volume' => 5,
            'task_latest_progress' => 4,
            'task_attachment' => null,
        ]);

        #8
        Task::create([
            'activity_id' => 4,
            'user_member_id' => 13,
            'status_id' => 2,
            'task_slug' => '8_anggotatim2',
            'task_description' => 'Pencacahan Survei Perusahaan Kehutanan',
            'task_volume' => 3,
            'task_latest_progress' => 0,
            'task_attachment' => null,
        ]);

        #9
        Task::create([
            'activity_id' => 5,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '9_anggotatim1',
            'task_description' => 'Pencacahan Survei Perusahaan Perikanan',
            'task_volume' => 3,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        #10
        Task::create([
            'activity_id' => 5,
            'user_member_id' => 14,
            'status_id' => 2,
            'task_slug' => '10_anggotatim5',
            'task_description' => 'Pencacahan Survei Perusahaan Perikanan',
            'task_volume' => 4,
            'task_latest_progress' => 3,
            'task_attachment' => null,
        ]);

    }
}
