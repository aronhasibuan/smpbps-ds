<?php

namespace Database\Seeders;

use App\Models\Kegiatan;
use Illuminate\Database\Seeder;

class KegiatanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // #1
        Kegiatan::create([
            'namakegiatan' => 'Survei Angkatan Kerja Nasional',
            'slug' => '1_survei_angkatan_kerja_nasional_'.now()->subDays(7)->format('d-m-Y').'_'.now()->format('d-m-Y'),
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #2
        Kegiatan::create([
            'namakegiatan' => 'Sensus Pertanian',
            'slug' => '2_sensus_pertanian_'.now()->subDays(7)->format('d-m-Y').'_'.now()->addDays(3)->format('d-m-Y'),
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #3
        Kegiatan::create([
            'namakegiatan' => 'Survei KSA',
            'slug' => '3_sensus_ksa_'.now()->subDays(7)->format('d-m-Y').'_'.now()->subDays(6)->format('d-m-Y'),
            'tenggat' => now()->subDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #4
        Kegiatan::create([
            'namakegiatan' => 'Sensus Ekonomi',
            'slug' => '4_sensus_ekonomi_'.now()->subDays(6)->format('d-m-Y').'_'.now()->addDays(5)->format('d-m-Y'),
            'tenggat' => now()->addDays(5)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #5
        Kegiatan::create([
            'namakegiatan' => 'Survei Ubinan',
            'slug' => '5_survei_ubinan_'.now()->subDays(5)->format('d-m-Y').'_'.now()->format('d-m-Y'),
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #6
        Kegiatan::create([
            'namakegiatan' => 'Survei Matriks Arus Komoditas',
            'slug' => '6_survei_matriks_arus_komoditas_'.now()->subDays(5)->format('d-m-Y').'_'.now()->addDays(3)->format('d-m-Y'),
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #7
        Kegiatan::create([
            'namakegiatan' => 'Survei Industri Besar Sedang',
            'slug' => '7_survei_industri_besar_sedang_'.now()->subDay(4)->format('d-m-Y').'_'.now()->addDays(2)->format('d-m-Y'),
            'tenggat' => now()->addDays(2)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #8
        Kegiatan::create([
            'namakegiatan' => 'Survei Konversi Gabah Beras',
            'slug' => '8_survei_konversi_gabah_beras_'.now()->subDays(4)->format('d-m-Y').'_'.now()->addDays(6)->format('d-m-Y'),
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #9
        Kegiatan::create([
            'namakegiatan' => 'Survei Sosial Ekonomi Nasional',
            'slug' => '9_survei_sosial_ekonomi_nasional_'.now()->subDays(4)->format('d-m-Y').'_'.now()->addDays(7)->format('d-m-Y'),
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #10
        Kegiatan::create([
            'namakegiatan' => 'Survei Harga Konsumen',
            'slug' => '10_survei_harga_konsumen_'.now()->subDays(4)->format('d-m-Y').'_'.now()->addDays(7)->format('d-m-Y'),
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #11
        Kegiatan::create([
            'namakegiatan' => 'Survei Perilaku Anti Korupsi',
            'slug' => '11_survei_perilaku_anti_korupsi_'.now()->subDays(3)->format('d-m-Y').'_'.now()->addDays(1)->format('d-m-Y'),
            'tenggat' => now()->addDays(1)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #12
        Kegiatan::create([
            'namakegiatan' => 'Survei Industri Mikro dan Kecil',
            'slug' => '12_survei_industri_mikro_dan_kecil_'.now()->subDays(3)->format('d-m-Y').'_'.now()->addDays(1)->format('d-m-Y'),
            'tenggat' => now()->addDays(1)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #13
        Kegiatan::create([
            'namakegiatan' => 'Survei Pertanian Antar Sensus',
            'slug' => '13_survei_pertanian_antar_sensus_'.now()->subDays(1)->format('d-m-Y').'_'.now()->format('d-m-Y'),
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #14
        Kegiatan::create([
            'namakegiatan' => 'Survei Demografi dan Kependudukan Indonesia',
            'slug' => '14_survei_demografi_dan_kependudukan_indonesia_'.now()->subDays(1)->format('d-m-Y').'_'.now()->addDays(4)->format('d-m-Y'),
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #15
        Kegiatan::create([
            'namakegiatan' => 'Survei Tendensi Konsumen',
            'slug' => '15_survei_tendensi_konsumen_'.now()->subDays(1)->format('d-m-Y').'_'.now()->addDays(7)->format('d-m-Y'),
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #16
        Kegiatan::create([
            'namakegiatan' => 'Survei Harga Produsen',
            'slug' => '16_survei_harga_produsen_'.now()->format('d-m-Y').'_'.now()->addDays(4)->format('d-m-Y'),
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);

        // #17
        Kegiatan::create([
            'namakegiatan' => 'Sensus Penduduk',
            'slug' => '17_sensus_penduduk_'.now()->format('d-m-Y').'_'.now()->addDays(6)->format('d-m-Y'),
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'active' => 1,
        ]);        
    }
}