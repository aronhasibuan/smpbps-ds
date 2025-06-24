<?php

namespace Database\Seeders;

use App\Models\Activity;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ActivitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Kegiatan Tim Statistik Produksi Januari 2025
        #1
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei KSA Januari 2025',
            'activity_slug' => '1-survei-ksa-januari-2025',
            'activity_unit' => 'Segmen',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #2
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Hortikultura Dan Indikator Pertanian Januari 2025',
            'activity_slug' => '2-survei-hortikultura-dan-indikator-pertanian-januari-2025',
            'activity_unit' => 'Rumah Tangga Usaha Pertanian',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #3
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Pertanian Tanaman Pangan/Ubinan Januari 2025',
            'activity_slug' => '3-survei-pertanian-tanaman-pangan-ubinan-januari-2025',
            'activity_unit' => 'Segmen',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #4
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perkebunan Januari 2025',
            'activity_slug' => '4-survei-perusahaan-perkebunan-januari-2025',
            'activity_unit' => 'Perusahaan Perkebunan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #5
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Kehutanan Januari 2025',
            'activity_slug' => '5-survei-perusahaan-kehutanan-januari-2025',
            'activity_unit' => 'Perusahaan Kehutanan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #6
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perikanan Januari 2025',
            'activity_slug' => '6-survei-perusahaan-perikanan-januari-2025',
            'activity_unit' => 'Perusahaan Perikanan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #7
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Peternakan Januari 2025',
            'activity_slug' => '7-survei-perusahaan-peternakan-januari-2025',
            'activity_unit' => 'Perusahaan Peternakan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        // Kegiatan Tim Statistik Distribusi Januari 2025
        #8
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Triwulanan Kegiatan Usaha Terintegrasi (STKUT) Januari 2025',
            'activity_slug' => '8-survei-triwulanan-kegiatan-usaha-terintegrasi-stkut-januari-2025',
            'activity_unit' => 'Perusahaan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #9
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Waktu Tunggu (Dwelling Time) Januari 2025',
            'activity_slug' => '9-survei-waktu-tunggu-dwelling-time-januari-2025',
            'activity_unit' => 'Responden',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #10
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Harga Konsumen Dan Survei Volume Penjualan Eceran Beras Januari 2025',
            'activity_slug' => '10-survei-harga-konsumen-dan-survei-volume-penjualan-eceran-beras-januari-2025',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #11
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Harga Perdagangan Besar (SHPB) Januari 2025',
            'activity_slug' => '11-survei-harga-perdagangan-besar-shpb-januari-2025',
            'activity_unit' => 'Perusahaan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #12
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Harga Perdesaan Januari 2025',
            'activity_slug' => '12-survei-harga-perdesaan-januari-2025',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #13
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Statistik Harga Produsen (SHP) Januari 2025',
            'activity_slug' => '13-survei-statistik-harga-produsen-shp-januari-2025',
            'activity_unit' => 'Perusahaan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        #14
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Pendataan Statistik E-Commerce (PSE) Januari 2025',
            'activity_slug' => '14-pendataan-statistik-e-commerce-pse-januari-2025',
            'activity_unit' => 'Responden',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-30',
            'activity_active_status' => 0,
        ]);

        // Kegiatan Tim Statistik Produksi Februari 2025
        #15
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei KSA Februari 2025',
            'activity_slug' => '15-survei-ksa-februari-2025',
            'activity_unit' => 'Segmen',
            'activity_start' => '2025-02-01',
            'activity_end' => '2025-02-28',
            'activity_active_status' => 0,
        ]);

        #16
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Hortikultura Dan Indikator Pertanian Februari 2025',
            'activity_slug' => '16-survei-hortikultura-dan-indikator-pertanian-februari-2025',
            'activity_unit' => 'Rumah Tangga Usaha Pertanian',
            'activity_start' => '2025-02-01',
            'activity_end' => '2025-02-25',
            'activity_active_status' => 0,
        ]);

        #17
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Pertanian Tanaman Pangan/Ubinan Februari 2025',
            'activity_slug' => '17-survei-pertanian-tanaman-pangan-ubinan-februari-2025',
            'activity_unit' => 'Segmen',
            'activity_start' => '2025-02-01',
            'activity_end' => '2025-02-20',
            'activity_active_status' => 0,
        ]);

        #18
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perkebunan Februari 2025',
            'activity_slug' => '18-survei-perusahaan-perkebunan-februari-2025',
            'activity_unit' => 'Perusahaan Perkebunan',
            'activity_start' => '2025-02-01',
            'activity_end' => '2025-02-15',
            'activity_active_status' => 0,
        ]);

        #19
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Kehutanan Februari 2025',
            'activity_slug' => '19-survei-perusahaan-kehutanan-februari-2025',
            'activity_unit' => 'Perusahaan Kehutanan',
            'activity_start' => '2025-02-01',
            'activity_end' => '2025-02-28',
            'activity_active_status' => 0,
        ]);

        #20
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perikanan Februari 2025',
            'activity_slug' => '20-survei-perusahaan-perikanan-februari-2025',
            'activity_unit' => 'Perusahaan Perikanan',
            'activity_start' => '2025-02-01',
            'activity_end' => '2025-02-10',
            'activity_active_status' => 0,
        ]);

        #21
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Peternakan Februari 2025',
            'activity_slug' => '21-survei-perusahaan-peternakan-februari-2025',
            'activity_unit' => 'Perusahaan Peternakan',
            'activity_start' => '2025-02-01',
            'activity_end' => '2025-02-15',
            'activity_active_status' => 0,
        ]);

        // Kegiatan Aktif Tim Statistik Produksi
        #22
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Sensus Pertanian',
            'activity_slug' => '22-sensus-pertanian',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(7)->format('Y-m-d'),
            'activity_end' => now()->addDays(3)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]); 

        #23
        Activity::create([
            'user_leader_id' => '2',
            'activity_name' => 'Survei KSA',
            'activity_slug' => '23-survei-ksa',
            'activity_unit' => 'Segmen',
            'activity_start' => now()->subDays(7)->format('Y-m-d'),
            'activity_end' => now()->subDays(6)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #24
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Ubinan',
            'activity_slug' => '24-survei-ubinan',
            'activity_unit' => 'Petak Lahan',
            'activity_start' => now()->subDays(5)->format('Y-m-d'),
            'activity_end' => now()->subDays(1)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #25
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Industri Besar Sedang',
            'activity_slug' => '25-survei-industri-besar-sedang',
            'activity_unit' => 'Perusahaan',
            'activity_start' => now()->subDay(4)->format('Y-m-d'),
            'activity_end' => now()->addDays(2)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #26
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Konversi Gabah Beras',
            'activity_slug' => '26-survei-konversi-gabah-beras',
            'activity_unit' => 'Penggilingan Padi',
            'activity_start' => now()->subDays(4)->format('Y-m-d'),
            'activity_end' => now()->addDays(5)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #27
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Industri Mikro dan Kecil',
            'activity_slug' => '27-survei-industri-mikro-dan-kecil',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(3)->format('Y-m-d'),
            'activity_end' => now()->addDays(1)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #28
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Pertanian Antar Sensus',
            'activity_slug' => '28-survei-pertanian-antar-sensus',
            'activity_unit' => 'Responden',
            'activity_start' => now()->subDays(1)->format('Y-m-d'),
            'activity_end' => now()->subDays(5)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        // Kegiatan Aktif Tim Statistik Distribusi
        #29
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Matriks Arus Komoditas',
            'activity_slug' => '29-survei-matriks-arus-komoditas',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(5)->format('Y-m-d'),
            'activity_end' => now()->addDays(3)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #30
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Harga Konsumen',
            'activity_slug' => '30-survei-harga-konsumen',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(4)->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #31
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Harga Produsen',
            'activity_slug' => '31-survei-harga-produsen',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(1)->format('Y-m-d'),
            'activity_end' => now()->addDays(4)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        // Kegiatan Aktif Tim Statistik Sosial
        #32
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Angkatan Kerja Nasional',
            'activity_slug' => '32-survei-angkatan-kerja-nasional',
            'activity_unit' => 'Blok Sensus',
            'activity_start' => now()->subDays(7)->format('Y-m-d'),
            'activity_end' => now()->subDays(1)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #33
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Sensus Ekonomi',
            'activity_slug' => '33-sensus-ekonomi',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(6)->format('Y-m-d'),
            'activity_end' => now()->addDays(5)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);
        
        #34
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Sosial Ekonomi Nasional',
            'activity_slug' => '34-survei-sosial-ekonomi-nasional',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(4)->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #35
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Perilaku Anti Korupsi',
            'activity_slug' => '35-survei-perilaku-anti-korupsi',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(3)->format('Y-m-d'),
            'activity_end' => now()->addDays(1)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #36
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Demografi dan Kependudukan Indonesia',
            'activity_slug' => '36-survei-demografi-dan-kependudukan-indonesia',
            'activity_unit' => 'Dokumen',
            'activity_start' => now()->subDays(1)->format('Y-m-d'),
            'activity_end' => now()->addDays(4)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #37
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Tendensi Konsumen',
            'activity_slug' => '37-survei-tendensi-konsumen',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->subDays(1)->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);
  
        #38
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Sensus Penduduk',
            'activity_slug' => '38-sensus-penduduk',
            'activity_unit' => 'Rumah Tangga', 
            'activity_start' => now()->subDays(1)->format('Y-m-d'),
            'activity_end' => now()->addDays(6)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);
        
        // Seeder Tambahan Produksi
        #39
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Hortikultura dan Indikator Pertanian',
            'activity_slug' => '39-survei-hortikultura-dan-indikator-pertanian',
            'activity_unit' => 'Rumah Tangga Usaha Pertanian',
            'activity_start' => now()->subDays(2)->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #40
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Pertanian Tanaman Pangan/Ubinan',
            'activity_slug' => '40-survei-pertanian-tanaman-pangan-ubinan',
            'activity_unit' => 'Segmen',
            'activity_start' => now()->subDays(2)->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #41
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perkebunan',
            'activity_slug' => '41-survei-perusahaan-perkebunan',
            'activity_unit' => 'Perusahaan Perkebunan',
            'activity_start' => now()->subDays(3)->format('Y-m-d'),
            'activity_end' => now()->addDays(3)->format('Y-m-d'),
            'activity_active_status' => 1,
        ]);

        #42
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Kehutanan',
            'activity_slug' => '42-survei-perusahaan-kehutanan',
            'activity_unit' => 'Perusahaan Kehutanan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(6)->format('Y-m-d'),
            'activity_active_status' => 0,
        ]);
    }
}