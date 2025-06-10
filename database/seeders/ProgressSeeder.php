<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Progress;

class ProgressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Survei KSA Januari 2025
        Progress::create([
            'task_id' => 1,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 1,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Hortikultura Dan Indikator Pertanian Januari 2025
        Progress::create([
            'task_id' => 2,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 2,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan Januari 2025
        Progress::create([
            'task_id' => 3,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 3,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perkebunan Januari 2025
        Progress::create([
            'task_id' => 4,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 4,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Kehutanan Januari 2025
        Progress::create([
            'task_id' => 5,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 5,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perikanan Januari 2025
        Progress::create([
            'task_id' => 6,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 6,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Peternakan Januari 2025
        Progress::create([
            'task_id' => 7,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 7,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Triwulanan Kegiatan Usaha Terintegrasi (STKUT) Januari 2025
        Progress::create([
            'task_id' => 8,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 8,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Waktu Tunggu (Dwelling Time) Januari 2025
        Progress::create([
            'task_id' => 9,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 9,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Kegiatan Harga Konsumen dan Survei Volume Penjualan Eceran Beras Januari 2025
        Progress::create([
            'task_id' => 10,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 10,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Harga Perdagangan Besar Januari 2025
        Progress::create([
            'task_id' => 11,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 11,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Harga Perdesaan Januari 2025
        Progress::create([
            'task_id' => 12,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 12,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei Statistik Harga Produsen Januari 2025
        Progress::create([
            'task_id' => 13,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 13,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Pendataan Statistik E-Commerce Januari 2025
        Progress::create([
            'task_id' => 14,
            'progress_date' => '2025-01-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 14,
            'progress_date' => '2025-01-25',
            'progress_amount' => 10,
            'progress_notes' => 'Pencacahan selesai',
            'progress_documentation' => null,
        ]);

        // Survei KSA Juni 2025
        Progress::create([
            'task_id' => 15,
            'progress_date' => '2025-06-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 15,
            'progress_date' => '2025-06-10',
            'progress_amount' => 1,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Hortikultura Dan Indikator Pertanian Juni 2025
        Progress::create([
            'task_id' => 16,
            'progress_date' => '2025-06-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 16,
            'progress_date' => '2025-06-10',
            'progress_amount' => 8,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan Juni 2025
        Progress::create([
            'task_id' => 17,
            'progress_date' => '2025-06-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 17,
            'progress_date' => '2025-06-10',
            'progress_amount' => 9,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perkebunan Juni 2025
        Progress::create([
            'task_id' => 18,
            'progress_date' => '2025-06-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 18,
            'progress_date' => '2025-06-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Kehutanan Juni 2025
        Progress::create([
            'task_id' => 19,
            'progress_date' => '2025-06-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 19,
            'progress_date' => '2025-06-10',
            'progress_amount' => 11,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perikanan Juni 2025
        Progress::create([
            'task_id' => 20,
            'progress_date' => '2025-06-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 20,
            'progress_date' => '2025-06-10',
            'progress_amount' => 12,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Peternakan Juni 2025
        Progress::create([
            'task_id' => 21,
            'progress_date' => '2025-06-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);
        Progress::create([
            'task_id' => 21,
            'progress_date' => '2025-06-10',
            'progress_amount' => 13,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

    }
}
