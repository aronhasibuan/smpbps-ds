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
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-30',
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

        // Kegiatan Tim Statistik Produksi Juni 2025
        #15
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei KSA Juni 2025',
            'activity_slug' => '8-survei-ksa-januari-2025',
            'activity_unit' => 'Segmen',
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-30',
            'activity_active_status' => 1,
        ]);

        #16
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Hortikultura Dan Indikator Pertanian Juni 2025',
            'activity_slug' => '9-survei-hortikultura-dan-indikator-pertanian-juni-2025',
            'activity_unit' => 'Rumah Tangga Usaha Pertanian',
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-25',
            'activity_active_status' => 1,
        ]);

        #17
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Pertanian Tanaman Pangan/Ubinan Juni 2025',
            'activity_slug' => '10-survei-pertanian-tanaman-pangan-ubinan-juni-2025',
            'activity_unit' => 'Segmen',
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-20',
            'activity_active_status' => 1,
        ]);

        #18
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perkebunan Juni 2025',
            'activity_slug' => '11-survei-perusahaan-perkebunan-juni-2025',
            'activity_unit' => 'Perusahaan Perkebunan',
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-15',
            'activity_active_status' => 1,
        ]);

        #19
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Kehutanan Juni 2025',
            'activity_slug' => '12-survei-perusahaan-kehutanan-juni-2025',
            'activity_unit' => 'Perusahaan Kehutanan',
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-30',
            'activity_active_status' => 1,
        ]);

        #20
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perikanan Juni 2025',
            'activity_slug' => '13-survei-perusahaan-perikanan-juni-2025',
            'activity_unit' => 'Perusahaan Perikanan',
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-10',
            'activity_active_status' => 1,
        ]);

        #21
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Peternakan Juni 2025',
            'activity_slug' => '14-survei-perusahaan-peternakan-juni-2025',
            'activity_unit' => 'Perusahaan Peternakan',
            'activity_start' => '2025-06-01',
            'activity_end' => '2025-06-15',
            'activity_active_status' => 1,
        ]);
        
    }
}