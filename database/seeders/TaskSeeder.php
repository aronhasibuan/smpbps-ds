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
        // #1
        Task::create([
            'namakegiatan' => 'Survei Angkatan Kerja Nasional',
            'slug' => '1_aronhsb16',
            'kegiatan_id' => 1,
            'deskripsi' => 'Listing',
            'volume' => 2,
            'satuan' => 'Blok Sensus',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Angkatan Kerja Nasional',
            'slug' => '2_pratiwi',
            'kegiatan_id' => 1,
            'deskripsi' => 'Listing',
            'volume' => 8,
            'satuan' => 'Blok Sensus',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 4,
            'attachment' => null,
            'active' => 1,
        ]);

        // #2
        Task::create([
            'namakegiatan' => 'Sensus Pertanian',
            'slug' => '3_aronhsb16',
            'kegiatan_id' => 2,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 7,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 7,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Pertanian',
            'slug' => '4_arsyka_laila',
            'kegiatan_id' => 2,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 9,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 5,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Pertanian',
            'slug' => '5_ignya_kristian',
            'kegiatan_id' => 2,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 10,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 4,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Pertanian',
            'slug' => '6_pratiwi',
            'kegiatan_id' => 2,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 6,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Pertanian',
            'slug' => '7_mita_febrianti',
            'kegiatan_id' => 2,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 1,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 0,
        ]);

        // #3
        Task::create([
            'namakegiatan' => 'Survei KSA',
            'slug' => '8_aronhsb16',
            'kegiatan_id' => 3,
            'deskripsi' => 'Pencacahan',
            'volume' => 10,
            'satuan' => 'Segmen',
            'tenggat' => now()->subDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Survei KSA',
            'slug' => '9_arsyka_laila',
            'kegiatan_id' => 3,
            'deskripsi' => 'Pencacahan',
            'volume' => 2,
            'satuan' => 'Segmen',
            'tenggat' => now()->subDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Survei KSA',
            'slug' => '10_ignya_kristian',
            'kegiatan_id' => 3,
            'deskripsi' => 'Pencacahan',
            'volume' => 10,
            'satuan' => 'Segmen',
            'tenggat' => now()->subDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 10,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Survei KSA',
            'slug' => '11_pratiwi',
            'kegiatan_id' => 3,
            'deskripsi' => 'Pencacahan',
            'volume' => 10,
            'satuan' => 'Segmen',
            'tenggat' => now()->subDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 3,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei KSA',
            'slug' => '12_mita_febrianti',
            'kegiatan_id' => 3,
            'deskripsi' => 'Pencacahan',
            'volume' => 4,
            'satuan' => 'Segmen',
            'tenggat' => now()->subDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 4,
            'attachment' => null,
            'active' => 0,
        ]);

        // #4
        Task::create([
            'namakegiatan' => 'Sensus Ekonomi',
            'slug' => '13_aronhsb16',
            'kegiatan_id' => 4,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 5,
            'satuan' => 'Segmen',
            'tenggat' => now()->addDays(5)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 3,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Ekonomi',
            'slug' => '14_arsyka_laila',
            'kegiatan_id' => 4,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 1,
            'satuan' => 'Segmen',
            'tenggat' => now()->addDays(5)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Ekonomi',
            'slug' => '15_ignya_kristian',
            'kegiatan_id' => 4,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 4,
            'satuan' => 'Segmen',
            'tenggat' => now()->addDays(5)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Ekonomi',
            'slug' => '16_pratiwi',
            'kegiatan_id' => 4,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 7,
            'satuan' => 'Segmen',
            'tenggat' => now()->addDays(5)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 6,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Ekonomi',
            'slug' => '17_mita_febrianti',
            'kegiatan_id' => 4,
            'deskripsi' => 'Pembuatan Publikasi',
            'volume' => 9,
            'satuan' => 'Segmen',
            'tenggat' => now()->addDays(5)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 1,
        ]);

        #5
        Task::create([
            'namakegiatan' => 'Survei Ubinan',
            'slug' => '18_aronhsb16',
            'kegiatan_id' => 5,
            'deskripsi' => 'Pencacahan',
            'volume' => 9,
            'satuan' => 'Petak Lahan',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 9,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Ubinan',
            'slug' => '19_ignya_kristian',
            'kegiatan_id' => 5,
            'deskripsi' => 'Pencacahan',
            'volume' => 4,
            'satuan' => 'Petak Lahan',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Ubinan',
            'slug' => '20_pratiwi',
            'kegiatan_id' => 5,
            'deskripsi' => 'Pencacahan',
            'volume' => 1,
            'satuan' => 'Petak Lahan',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 0,
            'attachment' => null,
            'active' => 1,
        ]);

        // #6
        Task::create([
            'namakegiatan' => 'Survei Matriks Arus Komoditas',
            'slug' => '21_aronhsb16',
            'kegiatan_id' => 6,
            'deskripsi' => 'Pengolahan',
            'volume' => 1,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 0,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Matriks Arus Komoditas',
            'slug' => '22_arsyka_laila',
            'kegiatan_id' => 6,
            'deskripsi' => 'Pengolahan',
            'volume' => 5,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 1,
        ]);

        // #7
        Task::create([
            'namakegiatan' => 'Survei Industri Besar Sedang',
            'slug' => '23_aronhsb16',
            'kegiatan_id' => 7,
            'deskripsi' => 'Listing',
            'volume' => 7,
            'satuan' => 'Perusahaan',
            'tenggat' => now()->addDays(2)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 6,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Industri Besar Sedang',
            'slug' => '24_arsyka_laila',
            'kegiatan_id' => 7,
            'deskripsi' => 'Listing',
            'volume' => 9,
            'satuan' => 'Perusahaan',
            'tenggat' => now()->addDays(2)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Industri Besar Sedang',
            'slug' => '25_mita_febrianti',
            'kegiatan_id' => 7,
            'deskripsi' => 'Listing',
            'volume' => 1,
            'satuan' => 'Perusahaan',
            'tenggat' => now()->addDays(2)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 0,
        ]);

        // #8
        Task::create([
            'namakegiatan' => 'Survei Konversi Gabah Beras',
            'slug' => '26_aronhsb16',
            'kegiatan_id' => 8,
            'deskripsi' => 'Pencacahan',
            'volume' => 9,
            'satuan' => 'Penggilingan Padi',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 3,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Konversi Gabah Beras',
            'slug' => '27_ignya_kristian',
            'kegiatan_id' => 8,
            'deskripsi' => 'Pencacahan',
            'volume' => 10,
            'satuan' => 'Penggilingan Padi',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 7,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Konversi Gabah Beras',
            'slug' => '28_pratiwi',
            'kegiatan_id' => 8,
            'deskripsi' => 'Pencacahan',
            'volume' => 3,
            'satuan' => 'Penggilingan Padi',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Konversi Gabah Beras',
            'slug' => '29_mita_febrianti',
            'kegiatan_id' => 8,
            'deskripsi' => 'Pencacahan',
            'volume' => 9,
            'satuan' => 'Penggilingan Padi',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 4,
            'attachment' => null,
            'active' => 1,
        ]);

        // #9
        Task::create([
            'namakegiatan' => 'Survei Sosial Ekonomi Nasional',
            'slug' => '30_aronhsb16',
            'kegiatan_id' => 9,
            'deskripsi' => 'Cleaning',
            'volume' => 2,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 1,
        ]);

        // #10
        Task::create([
            'namakegiatan' => 'Survei Harga Konsumen',
            'slug' => '31_aronhsb16',
            'kegiatan_id' => 10,
            'deskripsi' => 'Cleaning',
            'volume' => 9,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Harga Konsumen',
            'slug' => '32_arsyka_laila',
            'kegiatan_id' => 10,
            'deskripsi' => 'Cleaning',
            'volume' => 6,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 3,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Harga Konsumen',
            'slug' => '33_mita_febrianti',
            'kegiatan_id' => 10,
            'deskripsi' => 'Cleaning',
            'volume' => 8,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 5,
            'attachment' => null,
            'active' => 1,
        ]);

        // #11
        Task::create([
            'namakegiatan' => 'Survei Perilaku Anti Korupsi',
            'slug' => '34_aronhsb16',
            'kegiatan_id' => 11,
            'deskripsi' => 'Cleaning',
            'volume' => 8,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(1)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 6,
            'attachment' => null,
            'active' => 1,
        ]);
        
        Task::create([
            'namakegiatan' => 'Survei Perilaku Anti Korupsi',
            'slug' => '35_pratiwi',
            'kegiatan_id' => 11,
            'deskripsi' => 'Cleaning',
            'volume' => 9,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(1)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 5,
            'attachment' => null,
            'active' => 1,
        ]);

        // #12
        Task::create([
            'namakegiatan' => 'Survei Industri Mikro dan Kecil',
            'slug' => '36_aronhsb16',
            'kegiatan_id' => 12,
            'deskripsi' => 'Cleaning',
            'volume' => 4,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(1)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 4,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Industri Mikro dan Kecil',
            'slug' => '37_arsyka_laila',
            'kegiatan_id' => 12,
            'deskripsi' => 'Cleaning',
            'volume' => 1,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(1)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 0,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Industri Mikro dan Kecil',
            'slug' => '38_pratiwi',
            'kegiatan_id' => 12,
            'deskripsi' => 'Cleaning',
            'volume' => 1,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(1)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 0,
        ]);

        // #13
        Task::create([
            'namakegiatan' => 'Survei Pertanian Antar Sensus',
            'slug' => '39_aronhsb16',
            'kegiatan_id' => 13,
            'deskripsi' => 'Pencacahan',
            'volume' => 9,
            'satuan' => 'Responden',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 6,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Pertanian Antar Sensus',
            'slug' => '40_ignya_kristian',
            'kegiatan_id' => 13,
            'deskripsi' => 'Pencacahan',
            'volume' => 8,
            'satuan' => 'Responden',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 3,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Pertanian Antar Sensus',
            'slug' => '41_pratiwi',
            'kegiatan_id' => 13,
            'deskripsi' => 'Pencacahan',
            'volume' => 4,
            'satuan' => 'Responden',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Pertanian Antar Sensus',
            'slug' => '42_mita_febrianti',
            'kegiatan_id' => 13,
            'deskripsi' => 'Pencacahan',
            'volume' => 2,
            'satuan' => 'Responden',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 0,
        ]);

        // #14
        Task::create([
            'namakegiatan' => 'Survei Demografi dan Kependudukan Indonesia',
            'slug' => '43_aronhsb16',
            'kegiatan_id' => 14,
            'deskripsi' => 'Pengolahan',
            'volume' => 2,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Demografi dan Kependudukan Indonesia',
            'slug' => '44_arsyka_laila',
            'kegiatan_id' => 14,
            'deskripsi' => 'Pengolahan',
            'volume' => 1,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 5,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 0,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Demografi dan Kependudukan Indonesia',
            'slug' => '45_kristian_ernala',
            'kegiatan_id' => 14,
            'deskripsi' => 'Pengolahan',
            'volume' => 2,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 1,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Demografi dan Kependudukan Indonesia',
            'slug' => '46_aronhsb16',
            'kegiatan_id' => 14,
            'deskripsi' => 'Pengolahan',
            'volume' => 9,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 4,
            'attachment' => null,
            'active' => 1,
        ]);

        // #15
        Task::create([
            'namakegiatan' => 'Survei Tendensi Konsumen',
            'slug' => '47_aronhsb16',
            'kegiatan_id' => 15,
            'deskripsi' => 'Pencacahan',
            'volume' => 6,
            'satuan' => 'Responden',
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 5,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Tendensi Konsumen',
            'slug' => '48_mita_febrianti',
            'kegiatan_id' => 15,
            'deskripsi' => 'Pencacahan',
            'volume' => 3,
            'satuan' => 'Responden',
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 8,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 1,
        ]);

        // #16
        Task::create([
            'namakegiatan' => 'Survei Harga Produsen',
            'slug' => '49_aronhsb16',
            'kegiatan_id' => 16,
            'deskripsi' => 'Cleaning',
            'volume' => 5,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 3,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Harga Produsen',
            'slug' => '50_ignya_kristian',
            'kegiatan_id' => 16,
            'deskripsi' => 'Cleaning',
            'volume' => 10,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 6,
            'latestprogress' => 6,
            'attachment' => null,
            'active' => 1,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Harga Produsen',
            'slug' => '51_pratiwi',
            'kegiatan_id' => 16,
            'deskripsi' => 'Cleaning',
            'volume' => 10,
            'satuan' => 'Dokumen',
            'tenggat' => now()->addDays(4)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 7,
            'latestprogress' => 5,
            'attachment' => null,
            'active' => 1,
        ]);

        // #17
        Task::create([
            'namakegiatan' => 'Sensus Penduduk',
            'slug' => '52_aronhsb16',
            'kegiatan_id' => 17,
            'deskripsi' => 'Pencacahan',
            'volume' => 3,
            'satuan' => 'Rumah Tangga',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3, 
            'penerimatugas_id' => 4,
            'latestprogress' => 2,
            'attachment' => null,
            'active' => 1,
        ]);
    }
}
