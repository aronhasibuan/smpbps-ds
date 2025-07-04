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
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei KSA Februari 2025
        #15
        Task::create([
            'activity_id' => 15,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '15-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Hortikultura Dan Indikator Pertanian Februari 2025
        #16
        Task::create([
            'activity_id' => 16,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '16-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan Februari 2025
        #17
        Task::create([
            'activity_id' => 17,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '17-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perkebunan Februari 2025
        #18
        Task::create([
            'activity_id' => 18,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '18-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Kehutanan Februari 2025
        #19
        Task::create([
            'activity_id' => 19,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '19-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 11,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perikanan Februari 2025
        #20
        Task::create([
            'activity_id' => 20,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '20-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 12,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Peternakan Februari 2025
        #21
        Task::create([
            'activity_id' => 21,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '21-anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 13,
            'task_attachment' => null,
        ]);

        // Sensus Pertanian
        #22
        Task::create([
            'activity_id' => 22,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '22_anggotaproduksi1',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 7,
            'task_latest_progress' => 7,
            'task_attachment' => null,
        ]);

        #23
        Task::create([
            'activity_id' => 22,
            'user_member_id' => 10,
            'status_id' => 2,
            'task_slug' => '23_anggotaproduksi2',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 9,
            'task_latest_progress' => 5,
            'task_attachment' => null,
        ]);

        #24
        Task::create([
            'activity_id' => 22,
            'user_member_id' => 11,
            'status_id' => 2,
            'task_slug' => '24_anggotaproduksi3',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 10,
            'task_latest_progress' => 4,
            'task_attachment' => null,
        ]);

        #25
        Task::create([
            'activity_id' => 22,
            'user_member_id' => 12,
            'status_id' => 2,
            'task_slug' => '25_anggotaproduksi4',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 6,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        #26
        Task::create([
            'activity_id' => 22,
            'user_member_id' => 13,
            'status_id' => 1,
            'task_slug' => '26_anggotaproduksi5',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 1,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        // Survei KSA
        #27
        Task::create([
            'activity_id' => 23,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '27_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        #28
        Task::create([
            'activity_id' => 23,
            'user_member_id' => 10,
            'status_id' => 1,
            'task_slug' => '28_anggotaproduksi2',
            'task_description' => 'Pencacahan',
            'task_volume' => 2,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        #29
        Task::create([
            'activity_id' => 23,
            'user_member_id' => 11,
            'status_id' => 1,
            'task_slug' => '29_anggotaproduksi3',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 10,
            'task_attachment' => null,
        ]);

        #30
        Task::create([
            'activity_id' => 23,
            'user_member_id' => 12,
            'status_id' => 2,
            'task_slug' => '30_anggotaproduksi4',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 3,
            'task_attachment' => null,
        ]);

        #31
        Task::create([
            'activity_id' => 23,
            'user_member_id' => 13,
            'status_id' => 1,
            'task_slug' => '31_anggotaproduksi5',
            'task_description' => 'Pencacahan',
            'task_volume' => 4,
            'task_latest_progress' => 4,
            'task_attachment' => null,
        ]);

        // Survei Ubinan
        #32
        Task::create([
            'activity_id' => 24,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '32_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 9,
            'task_latest_progress' => 9,
            'task_attachment' => null,
        ]);

        #33
        Task::create([
            'activity_id' => 24,
            'user_member_id' => 11,
            'status_id' => 2,
            'task_slug' => '33_anggotaproduksi3',
            'task_description' => 'Pencacahan',
            'task_volume' => 4,
            'task_latest_progress' => 1,
            'task_attachment' => null, 
        ]);

        #34
        Task::create([
            'activity_id' => 24,
            'user_member_id' => 12,
            'status_id' => 2,
            'task_slug' => '34_anggotaproduksi4',
            'task_description' => 'Pencacahan',
            'task_volume' => 1,
            'task_latest_progress' => 0,
            'task_attachment' => null,
        ]);

        // Survei industri Besar Sedang
        #35
        Task::create([
            'activity_id' => 25,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '35_anggotaproduksi1',
            'task_description' => 'Listing',
            'task_volume' => 7,
            'task_latest_progress' => 6,
            'task_attachment' => null,
        ]);

        #36
        Task::create([
            'activity_id' => 25,
            'user_member_id' => 10,
            'status_id' => 2,
            'task_slug' => '36_anggotaproduksi2',
            'task_description' => 'Listing',
            'task_volume' => 9,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        #37
        Task::create([
            'activity_id' => 25,
            'user_member_id' => 13,
            'status_id' => 1,
            'task_slug' => '37_anggotaproduksi5',
            'task_description' => 'Listing',
            'task_volume' => 1,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        // Survei Konversi Gabah Beras
        #38
        Task::create([
            'activity_id' => 26,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '38_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 5,
            'task_attachment' => null, 
        ]);

        #39
        Task::create([
            'activity_id' => 26,
            'user_member_id' => 11,
            'status_id' => 1,
            'task_slug' => '39_anggotaproduksi3',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 7,
            'task_attachment' => null, 
        ]);

        #40
        Task::create([
            'activity_id' => 26,
            'user_member_id' => 12, 
            'status_id' => 2,
            'task_slug' => '40_anggotaproduksi4',
            'task_description' => 'Pencacahan',
            'task_volume' => 3,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        #41
        Task::create([
            'activity_id' => 26,
            'user_member_id' => 13,
            'status_id' => 2,
            'task_slug' => '41_anggotaproduksi5',
            'task_description' => 'Pencacahan',
            'task_volume' => 9,
            'task_latest_progress' => 4,
            'task_attachment' => null,
        ]);

        // Survei Industri Mikro dan Kecil
        #42
        Task::create([
            'activity_id' => 27,
            'user_member_id' => 9,
            'status_id' => 1,
            'task_slug' => '42_anggotaproduksi1',
            'task_description' => 'Cleaning',
            'task_volume' => 4,
            'task_latest_progress' => 4,
            'task_attachment' => null,
        ]);

        #43
        Task::create([
            'activity_id' => 27,
            'user_member_id' => 10,
            'status_id' => 4,
            'task_slug' => '43_anggotaproduksi2',
            'task_description' => 'Cleaning',
            'task_volume' => 1,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #44
        Task::create([
            'activity_id' => 27,
            'user_member_id' => 12,
            'status_id' => 1,
            'task_slug' => '44_anggotaproduksi4',
            'task_description' => 'Cleaning',
            'task_volume' => 1,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        // Survei Pertanian Antar Sensus
        #45
        Task::create([
            'activity_id' => 28,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '45_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 7,
            'task_latest_progress' => 5,
            'task_attachment' => null,
        ]);

        #46
        Task::create([
            'activity_id' => 28,
            'user_member_id' => 11,
            'status_id' => 2,
            'task_slug' => '46_anggotaproduksi3',
            'task_description' => 'Pencacahan',
            'task_volume' => 8,
            'task_latest_progress' => 3,
            'task_attachment' => null,
        ]);

        #47
        Task::create([
            'activity_id' => 28,
            'user_member_id' => 12,
            'status_id' => 2,
            'task_slug' => '47_anggotaproduksi4',
            'task_description' => 'Pencacahan',
            'task_volume' => 4,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #48
        Task::create([
            'activity_id' => 28,
            'user_member_id' => 13,
            'status_id' => 1,
            'task_slug' => '48_anggotaproduksi5',
            'task_description' => 'Pencacahan',
            'task_volume' => 2,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        // Survei Matriks Arus Komoditas
        #49
        Task::create([
            'activity_id' => 29,
            'user_member_id' => 14,
            'status_id' => 2,
            'task_slug' => '49_anggotadistribusi1',
            'task_description' => 'Pengolahan',
            'task_volume' => 1,
            'task_latest_progress' => 0,
            'task_attachment' => null,
        ]);

        #50
        Task::create([
            'activity_id' => 29,
            'user_member_id' => 15,
            'status_id' => 2,
            'task_slug' => '50_anggotadistribusi2',
            'task_description' => 'Pengolahan',
            'task_volume' => 5,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        // Survei Harga Konsumen
        #51
        Task::create([
            'activity_id' => 30,
            'user_member_id' => 14,
            'status_id' => 2,
            'task_slug' => '51_anggotadistribusi1',
            'task_description' => 'Cleaning',
            'task_volume' => 9,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #52
        Task::create([
            'activity_id' => 30,
            'user_member_id' => 15,
            'status_id' => 2,
            'task_slug' => '52_anggotadistribusi2',
            'task_description' => 'Cleaning',
            'task_volume' => 6,
            'task_latest_progress' => 3,
            'task_attachment' => null,
        ]);

        #53
        Task::create([
            'activity_id' => 30,
            'user_member_id' => 18,
            'status_id' => 2,
            'task_slug' => '53_anggotadistribusi5',
            'task_description' => 'Cleaning',
            'task_volume' => 8,
            'task_latest_progress' => 5,
            'task_attachment' => null,
        ]);

        // Survei Harga Produsen
        #54
        Task::create([
            'activity_id' => 31,
            'user_member_id' => 14,
            'status_id' => 2,
            'task_slug' => '54_anggotadistribusi1',
            'task_description' => 'Cleaning',
            'task_volume' => 5,
            'task_latest_progress' => 3,
            'task_attachment' => null,
        ]);

        #55
        Task::create([
            'activity_id' => 31,
            'user_member_id' => 16,
            'status_id' => 2,
            'task_slug' => '55_anggotadistribusi3',
            'task_description' => 'Cleaning',
            'task_volume' => 10,
            'task_latest_progress' => 6,
            'task_attachment' => null,
        ]);

        #56
        Task::create([
            'activity_id' => 31,
            'user_member_id' => 17,
            'status_id' => 2,
            'task_slug' => '56_anggotadistribusi4',
            'task_description' => 'Cleaning',
            'task_volume' => 10,
            'task_latest_progress' => 5,
            'task_attachment' => null,
        ]);

        // Survei Angkatan Kerja Nasional
        #57
        Task::create([
            'activity_id' => 32,
            'user_member_id' => 19,
            'status_id' => 2,
            'task_slug' => '57_anggotasosial1',
            'task_description' => 'Listing',
            'task_volume' => 2,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #58
        Task::create([
            'activity_id' => 32,
            'user_member_id' => 22,
            'status_id' => 2,
            'task_slug' => '58_anggotasosial4',
            'task_description' => 'Listing',
            'task_volume' => 8,
            'task_latest_progress' => 4,
            'task_attachment' => null,
        ]);

        // Sensus Ekonomi
        #59
        Task::create([
            'activity_id' => 33,
            'user_member_id' => 19,
            'status_id' => 2,
            'task_slug' => '59_anggotasosial1',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 5,
            'task_latest_progress' => 3,
            'task_attachment' => null,
        ]);

        #60
        Task::create([
            'activity_id' => 33,
            'user_member_id' => 20,
            'status_id' => 1,
            'task_slug' => '60_anggotasosial2',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 1,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #61
        Task::create([
            'activity_id' => 33,
            'user_member_id' => 21,
            'status_id' => 2,
            'task_slug' => '61_anggotasosial3',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 4,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #62
        Task::create([
            'activity_id' => 33,
            'user_member_id' => 22,
            'status_id' => 2,
            'task_slug' => '62_anggotasosial4',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 7,
            'task_latest_progress' => 6,
            'task_attachment' => null,
        ]);

        #63
        Task::create([
            'activity_id' => 33,
            'user_member_id' => 23,
            'status_id' => 2,
            'task_slug' => '63_anggotasosial5',
            'task_description' => 'Pembuatan Publikasi',
            'task_volume' => 9,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        // Survei Sosial Ekonomi Nasional
        #64
        Task::create([
            'activity_id' => 34,
            'user_member_id' => 19,
            'status_id' => 2,
            'task_slug' => '30_anggotasosial1',
            'task_description' => 'Cleaning',
            'task_volume' => 2,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        // Survei Perilaku Anti Korupsi
        #65
        Task::create([
            'activity_id' => 35,
            'user_member_id' => 19,
            'status_id' => 2,
            'task_slug' => '65_anggotasosial1',
            'task_description' => 'Cleaning',
            'task_volume' => 8,
            'task_latest_progress' => 6,
            'task_attachment' => null,
        ]);

        #66
        Task::create([
            'activity_id' => 35,
            'user_member_id' => 22,
            'status_id' => 2,
            'task_slug' => '66_anggotasosial4',
            'task_description' => 'Cleaning',
            'task_volume' => 9,
            'task_latest_progress' => 5,
            'task_attachment' => null,
        ]);

        // Survei Demografi dan Kependudukan Indonesia
        #67
        Task::create([
            'activity_id' => 36,
            'user_member_id' => 19,
            'status_id' => 1,
            'task_slug' => '67_anggotasosial1',
            'task_description' => 'Pengolahan',
            'task_volume' => 2,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        #68
        Task::create([
            'activity_id' => 36,
            'user_member_id' => 20,
            'status_id' => 1,
            'task_slug' => '68_anggotasosial2',
            'task_description' => 'Pengolahan',
            'task_volume' => 1,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #69
        Task::create([
            'activity_id' => 36,
            'user_member_id' => 21,
            'status_id' => 2,
            'task_slug' => '69_anggotasosial3',
            'task_description' => 'Pengolahan',
            'task_volume' => 2,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        #70
        Task::create([
            'activity_id' => 36,
            'user_member_id' => 22,
            'status_id' => 2,
            'task_slug' => '70_anggotasosial4',
            'task_description' => 'Pengolahan',
            'task_volume' => 9,
            'task_latest_progress' => 4,
            'task_attachment' => null,
        ]);

        // Survei Tendensi Konsumen
        #71
        Task::create([
            'activity_id' => 37,
            'user_member_id' => 19,
            'status_id' => 2,
            'task_slug' => '71_anggotasosial1',
            'task_description' => 'Pencacahan',
            'task_volume' => 6,
            'task_latest_progress' => 5,
            'task_attachment' => null,
        ]);

        #72
        Task::create([
            'activity_id' => 37,
            'user_member_id' => 23,
            'status_id' => 2,
            'task_slug' => '72_anggotasosial5',
            'task_description' => 'Pencacahan',
            'task_volume' => 3,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);

        // Sensus Penduduk
        #73
        Task::create([
            'activity_id' => 38,
            'user_member_id' => 19,
            'status_id' => 2,
            'task_slug' => '73_anggotasosial1',
            'task_description' => 'Pencacahan',
            'task_volume' => 3,
            'task_latest_progress' => 2,
            'task_attachment' => null,
        ]);


        // Survei Hortikultura dan Indikator Pertanian
        #74
        Task::create([
            'activity_id' => 39,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '74_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 1,
            'task_attachment' => null,
        ]);

        // Survei Pertanian Tanaman Pangan/Ubinan
        #75
        Task::create([
            'activity_id' => 40,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '75_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 10,
            'task_latest_progress' => 6,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perkebunan
        #76
        Task::create([
            'activity_id' => 41,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '76_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 7,
            'task_latest_progress' => 5,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Kehutanan
        #77
        Task::create([
            'activity_id' => 42,
            'user_member_id' => 9,
            'status_id' => 2,
            'task_slug' => '77_anggotaproduksi1',
            'task_description' => 'Pencacahan',
            'task_volume' => 7,
            'task_latest_progress' => 0,
            'task_attachment' => null,
        ]);

        // Survei Perusahaan Perikanan
        #78
        Task::create([
            'activity_id' => 43,
            'user_member_id' => 10,
            'status_id' => 4,
            'task_slug' => '78_anggotaproduksi2',
            'task_description' => 'Pencacahan',
            'task_volume' => 7,
            'task_latest_progress' => 7,
            'task_attachment' => null,
        ]);
    }
}
