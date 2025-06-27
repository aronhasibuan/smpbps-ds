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

        // Survei KSA Februari 2025
        Progress::create([
            'task_id' => 15,
            'progress_date' => '2025-02-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 15,
            'progress_date' => '2025-02-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Hortikultura Dan Indikator Pertanian Februari 2025
        Progress::create([
            'task_id' => 16,
            'progress_date' => '2025-02-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 16,
            'progress_date' => '2025-02-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan Februari 2025
        Progress::create([
            'task_id' => 17,
            'progress_date' => '2025-02-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 17,
            'progress_date' => '2025-02-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perkebunan Februari 2025
        Progress::create([
            'task_id' => 18,
            'progress_date' => '2025-02-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 18,
            'progress_date' => '2025-02-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Kehutanan Februari 2025
        Progress::create([
            'task_id' => 19,
            'progress_date' => '2025-02-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 19,
            'progress_date' => '2025-02-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perikanan Februari 2025
        Progress::create([
            'task_id' => 20,
            'progress_date' => '2025-02-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 20,
            'progress_date' => '2025-02-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Peternakan Februari 2025
        Progress::create([
            'task_id' => 21,
            'progress_date' => '2025-02-01',
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);
        Progress::create([
            'task_id' => 21,
            'progress_date' => '2025-02-10',
            'progress_amount' => 10,
            'progress_notes' => 'Progres pencacahan',
            'progress_documentation' => null,
        ]);

        // Sensus Pertanian
        Progress::create([
            'task_id' => 22,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 23,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 24,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 25,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 26,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 22,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 7,
            'progress_notes' => 'Pengerjaan Berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 23,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Pengerjaan Berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 24,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 4,
            'progress_notes' => 'Pengerjaan Berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 25,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan Berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 26,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan Berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei KSA
        Progress::create([
            'task_id' => 27,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 28,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 29,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 30,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 31,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Tugas dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 27,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 10,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 28,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 29,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 10,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 30,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 31,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 4,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Ubinan
        Progress::create([
            'task_id' => 32,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 33,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 34,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 32,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 9,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 33,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Industri Besar Sedang
        Progress::create([
            'task_id' => 35,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',  
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 36,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',  
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 37,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai', 
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 35,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 6,
            'progress_notes' => 'Pengerjaan berlangsung', 
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 36,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',  
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 37,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',  
            'progress_documentation' => null,
        ]);

        // Survei Konversi Gabah Beras
        Progress::create([
            'task_id' => 38,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 39,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 40,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 41,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 38,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 38,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);
        
        Progress::create([
            'task_id' => 39,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 7,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 40,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 41,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 4,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Industri Mikro dan Kecil
        Progress::create([
            'task_id' => 42,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 43,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 44,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 42,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 4,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 43,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 44,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Pertanian Antar Sensus
        Progress::create([
            'task_id' => 45,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 46,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 47,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 48,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 45,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 45,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Responden sulit untuk ditemui',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 46,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 47,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 48,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Matriks Arus Komoditas
        Progress::create([
            'task_id' => 49,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 50,
            'progress_date' => now()->subDays(5)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai', 
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 50,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Harga Konsumen
        Progress::create([
            'task_id' => 51,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 52,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 53,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 51,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 52,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 53,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Harga Produsen
        Progress::create([
            'task_id' => 54,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 55,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 56,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 54,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 55,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 6,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 56,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Angkatan Kerja Nasional
        Progress::create([
            'task_id' =>57,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 58,
            'progress_date' => now()->subDays(7)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 57,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 58,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 4,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Sensus Ekonomi
        Progress::create([
            'task_id' => 59,
            'progress_date' => now()->subDays(6)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 60,
            'progress_date' => now()->subDays(6)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 61,
            'progress_date' => now()->subDays(6)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 62,
            'progress_date' => now()->subDays(6)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 63,
            'progress_date' => now()->subDays(6)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 59,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 60,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 61,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 62,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 6,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 63,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Sosial Ekonomi Nasional
        Progress::create([
            'task_id' => 64,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 64,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Perilaku Anti Korupsi
        Progress::create([
            'task_id' => 65,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 66,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 65,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 6,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 66,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Demografi dan Kependudukan Indonesia
        Progress::create([
            'task_id' => 67,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 68,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 69,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 70,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 67,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 68,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 69,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 70,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 4,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Tendensi Konsumen
        Progress::create([
            'task_id' => 71,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 72,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 71,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 72,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Sensus Penduduk
        Progress::create([
            'task_id' => 73,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 73,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Hortikultura dan Indikator Pertanian
        Progress::create([
            'task_id' => 74,
            'progress_date' => now()->subDays(2)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 74,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 74,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan
        Progress::create([
            'task_id' => 75,
            'progress_date' => now()->subDays(2)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 75,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 75,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 6,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perkebunan
        Progress::create([
            'task_id' => 76,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 76,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 2,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 76,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Pengerjaan berlangsung',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Kehutanan
        Progress::create([
            'task_id' => 77,
            'progress_date' => now()->format('Y-m-d'),
            'progress_amount' => 0,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        // Survei Perusahaan Perikanan
        Progress::create([
            'task_id' => 78,
            'progress_date' => now()->subDays(6)->format('Y-m-d'),
            'progress_amount' => 1,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 78,
            'progress_date' => now()->subDays(4)->format('Y-m-d'),
            'progress_amount' => 3,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 78,
            'progress_date' => now()->subDays(3)->format('Y-m-d'),
            'progress_amount' => 5,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);

        Progress::create([
            'task_id' => 78,
            'progress_date' => now()->subDays(1)->format('Y-m-d'),
            'progress_amount' => 7,
            'progress_notes' => 'Progress dimulai',
            'progress_documentation' => null,
        ]);
    }
}