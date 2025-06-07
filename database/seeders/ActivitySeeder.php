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
        #1
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Hortikultura dan Indikator Pertanian',
            'activity_slug' => '1_survei-hortikultura-dan-indikator-pertanian',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #2
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Pertanian Tanaman Pangan atau Ubinan',
            'activity_slug' => '2_survei-pertanian-tanaman-pangan-atau-ubinan',
            'activity_unit' => 'Segmen',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #3
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perkebunan',
            'activity_slug' => '3_survei_perusahaan_perkebunan',
            'activity_unit' => 'Perusahaan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #4
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Kehutanan',
            'activity_slug' => '4_survei_perusahaan_kehutanan',
            'activity_unit' => 'Perusahaan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #5
        Activity::create([
            'user_leader_id' => 2,
            'activity_name' => 'Survei Perusahaan Perikanan',
            'activity_slug' => '5_survei_perusahaan_perikanan',
            'activity_unit' => 'Perusahaan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #6
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Perdagangan Antar Wilayah',
            'activity_slug' => '6_survei_perdagangan_antar_wilayah',
            'activity_unit' => 'Unit Perdagangan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #7
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Pola Distribusi Barang dan Jasa',
            'activity_slug' => '7_survei_pola_distribusi_barang_dan_jasa',
            'activity_unit' => 'Responden',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #8
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Survei Harga Perdesaan',
            'activity_slug' => '8_survei_harga_perdesaan',
            'activity_unit' => 'Perdesaan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #9
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Passenger Exit Survei',
            'activity_slug' => '9_passenger_exit_survei',
            'activity_unit' => 'Wisatawan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #10
        Activity::create([
            'user_leader_id' => 3,
            'activity_name' => 'Pendataan Statistik E-Commerce',
            'activity_slug' => '10_pendataan_statistik_e-commerce',
            'activity_unit' => 'Usaha E-commerce',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #11
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Angkatan Kerja Nasional',
            'activity_slug' => '11_survei_angkatan_kerja_nasional',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #12
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Survei Perilaku Anti Korupsi',
            'activity_slug' => '12_survei_perilaku_anti_korupsi',
            'activity_unit' => 'Responden',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #13
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Pendataan Podes',
            'activity_slug' => '13_pendataan_podes',
            'activity_unit' => 'Kecamatan',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #14
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Susenas Kor dan Konsumsi',
            'activity_slug' => '14_susenas_kor_dan_konsumsi',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);

        #15
        Activity::create([
            'user_leader_id' => 4,
            'activity_name' => 'Susenas Modul Ketahanan Nasional',
            'activity_slug' => '15_susenas_modul_ketahanan_sosial',
            'activity_unit' => 'Rumah Tangga',
            'activity_start' => now()->format('Y-m-d'),
            'activity_end' => now()->addDays(7)->format('Y-m-d'),
            'activity_active_status' => 4
        ]);
    }
}
