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
        // Inactive activities
        #1
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Hortikultura dan Indikator Pertanian Januari 2025',
            'activity_slug' => '1_survei-hortikultura-dan-indikator-pertanian-januari-2025',
            'activity_unit' => 'Rumah Tangga Usaha Pertanian',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-25',
            'activity_active_status' => 0
        ]);

        #2
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Pertanian Tanaman Pangan atau Ubinan Januari 2025',
            'activity_slug' => '2_survei-pertanian-tanaman-pangan-atau-ubinan-januari-2025',
            'activity_unit' => 'Segmen Sawah',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-20',
            'activity_active_status' => 0
        ]);

        #3
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perkebunan Januari 2025',
            'activity_slug' => '3_survei_perusahaan_perkebunan-januari-2025',
            'activity_unit' => 'Perusahaan Perkebunan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-25',
            'activity_active_status' => 0
        ]);

        #4
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Kehutanan 2025',
            'activity_slug' => '4_survei_perusahaan_kehutanan-2025',
            'activity_unit' => 'Perusahaan Kehutanan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-03-31',
            'activity_active_status' => 0
        ]);

        #5
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perikanan 2025',
            'activity_slug' => '5_survei_perusahaan_perikanan-2025',
            'activity_unit' => 'Perusahaan Perikanan',
            'activity_start' => '2025-01-01',
            'activity_end' => '2025-01-31',
            'activity_active_status' => 0
        ]);

        #6
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Perdagangan Antar Wilayah Maret 2025',
            'activity_slug' => '6_survei_perdagangan_antar_wilayah-maret-2025',
            'activity_unit' => 'Perusahaan ekspedisi, pelabuhan, bandara, pedagang pengangkut',
            'activity_start' => '2025-03-01',
            'activity_end' => '2025-03-20',
            'activity_active_status' => 0
        ]);

        #7
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Pola Distribusi Barang dan Jasa Maret 2025',
            'activity_slug' => '7_survei_pola_distribusi_barang_dan_jasa-maret-2025',
            'activity_unit' => 'Produsen, pedagang grosir, eceran, agen, distributor, penyedia jasa',
            'activity_start' => '2025-03-01',
            'activity_end' => '2025-03-20',
            'activity_active_status' => 0
        ]);

        #8
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Harga Perdesaan',
            'activity_slug' => '8_survei_harga_perdesaan',
            'activity_unit' => 'Perdesaan',
            'activity_start' => now()->subDays(6)->format('Y-m-d'),
            'activity_end' => now()->addDays(5)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);

        #9
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Passenger Exit Survei',
            'activity_slug' => '9_passenger_exit_survei',
            'activity_unit' => 'Wisatawan',
            'activity_start' => now()->subDays(3)->format('Y-m-d'),
            'activity_end' => now()->addDays(4)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);

        #10
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Pendataan Statistik E-Commerce',
            'activity_slug' => '10_pendataan_statistik_e-commerce',
            'activity_unit' => 'Usaha E-commerce',
            'activity_start' => now()->subDays(3)->format('Y-m-d'),
            'activity_end' => now()->addDays(1)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);

        #11
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Angkatan Kerja Nasional',
            'activity_slug' => '11_survei_angkatan_kerja_nasional',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->subDays(2)->format('Y-m-d'),
            'activity_end' => now()->addDays(6)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);

        #12
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Perilaku Anti Korupsi',
            'activity_slug' => '12_survei_perilaku_anti_korupsi',
            'activity_unit' => 'Responden',
            'activity_start' => now()->subDays(3)->format('Y-m-d'),
            'activity_end' => now()->addDays(4)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);

        #13
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Pendataan Podes',
            'activity_slug' => '13_pendataan_podes',
            'activity_unit' => 'Kecamatan',
            'activity_start' => now()->subDays(3)->format('Y-m-d'),
            'activity_end' => now()->addDays(5)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);

        #14
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Susenas Kor dan Konsumsi',
            'activity_slug' => '14_susenas_kor_dan_konsumsi',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->subDays(1)->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);

        #15
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Susenas Modul Ketahanan Nasional',
            'activity_slug' => '15_susenas_modul_ketahanan_sosial',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->subDays(7)->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 1
        ]);
    }
}
