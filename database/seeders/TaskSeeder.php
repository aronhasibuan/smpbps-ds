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
        // Survei KSA Januari 2025
        #1
        Task::create([
            'activity_id' => 1,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '1-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Hortikultura Dan Indikator Pertanian Januari 2025
        #2
        Task::create([
            'activity_id' => 2,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '2-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan Januari 2025
        #3
        Task::create([
            'activity_id' => 3,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '3-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perkebunan Januari 2025
        #4
        Task::create([
            'activity_id' => 4,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '4-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);


        // Survei Perusahaan Kehutanan Januari 2025
        #5
        Task::create([
            'activity_id' => 5,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '5-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perikanan Januari 2025
        #6
        Task::create([
            'activity_id' => 6,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '6-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Peternakan Januari 2025
        #7
        Task::create([
            'activity_id' => 7,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '7-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Triwulanan Kegiatan Usaha Terintegrasi (STKUT) Januari 2025
        #8
        Task::create([
            'activity_id' => 8,
            'user_member_id' => 14,
            'status_id' => 1,
            'task_slug' => '8-anggotadistribusi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Waktu tunggu (Dwelling Time) Januari 2025
        #9
        Task::create([
            'activity_id' => 9,
            'user_member_id' => 14,
            'status_id' => 1,
            'task_slug' => '9-anggotadistribusi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Kegiatan Harga Konsumen dan Survei Volume Penjualan Eceran Beras Januari 2025
        #10
        Task::create([
            'activity_id' => 10,
            'user_member_id' => 14,
            'status_id' => 1,
            'task_slug' => '10-anggotadistribusi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Harga Perdagangan Besar (SHPB) Januari 2025
        #11
        Task::create([
            'activity_id' => 11,
            'user_member_id' => 14,
            'status_id' => 1,
            'task_slug' => '11-anggotadistribusi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Harga Perdesaan Januari 2025
        #12
        Task::create([
            'activity_id' => 12,
            'user_member_id' => 14,
            'status_id' => 1,
            'task_slug' => '12-anggotadistribusi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Statistik Harga Produsen (SHP) Januari 2025
        #13
        Task::create([
            'activity_id' => 13,
            'user_member_id' => 14,
            'status_id' => 1,
            'task_slug' => '13-anggotadistribusi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Pendataan Statistik E-Commerce (PSE) Januari 2025
        #14
        Task::create([
            'activity_id' => 14,
            'user_member_id' => 14,
            'status_id' => 1,
            'task_slug' => '14-distribusi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 8,
            'task_attachment' => null,
        ]);

        // Survei KSA Juni 2025
        #15
        Task::create([
            'activity_id' => 15,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '15-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 30,
            'task_latest_progress' => 11,
            'task_attachment' => null,
        ]);

        // Survei Hortikultura Dan Indikator Pertanian Juni 2025
        #16
        Task::create([
            'activity_id' => 16,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '16-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 8,
            'task_attachment' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan Juni 2025
        #17
        Task::create([
            'activity_id' => 17,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '17-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 9,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perkebunan Juni 2025
        #18
        Task::create([
            'activity_id' => 18,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '18-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 30,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Kehutanan Juni 2025
        #19
        Task::create([
            'activity_id' => 19,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '19-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 30,
            'task_latest_progress' => 11,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perikanan Juni 2025
        #20
        Task::create([
            'activity_id' => 20,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '20-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 30,
            'task_latest_progress' => 12,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Peternakan Juni 2025
        #21
        Task::create([
            'activity_id' => 21,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '21-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 30,
            'task_latest_progress' => 13,
            'task_attachment' => null,
        ]);
    }
}
