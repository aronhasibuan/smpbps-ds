<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Task::create([
            'namakegiatan' => 'SUSENAS Maret 2025',
            'slug' => '1_SUSENAS-Maret-2025_'.now()->format('d-m-Y').'_'.now()->addDays(6)->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk melaksanakan SUSENAS Maret 2025, dengan tanggung jawab melakukan pencacahan di 7 blok sensus dalam waktu 6 hari. Pastikan data yang dikumpulkan akurat dan sesuai dengan prosedur BPS. Segera mulai pekerjaan dan laporkan perkembangan secara berkala.',
            'volume' => 7,
            'satuan' => 'Blok Sensus',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'penerimatugas_id' => 7, //7
            'progress' => 0,
            'attachment' => NULL,
            'active' => TRUE
        ]);

        Task::create([
            'namakegiatan' => 'PODES 2025',
            'slug' => '2_PODES-2025_'.now()->format('d-m-Y').'_'.now()->addDays(5)->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk melaksanakan PODES 2025, dengan tanggung jawab menyusun dan menyelesaikan 3 publikasi dalam waktu 5 hari. Pastikan setiap publikasi memenuhi standar kualitas dan ketepatan data yang ditetapkan. Segera mulai pekerjaan dan laporkan perkembangan secara berkala.',
            'volume' => 3,
            'satuan' => 'Publikasi',
            'tenggat' => now()->addDays(5)->format('Y-m-d'),
            'pemberitugas_id' => 4,
            'penerimatugas_id' => 5, //5
            'progress' => 1,
            'attachment' => NULL,
            'active' => TRUE
        ]);

        Task::create([
            'namakegiatan' => 'SAKERNAS Februari 2025',
            'slug' => '3_SAKERNAS-Februari-2025_'.now()->subDays(2)->format('d-m-Y').'_'.now()->addDays(2)->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk melaksanakan SAKERNAS Februari 2025, dengan tanggung jawab melakukan listing di 5 blok sensus dalam waktu 2 hari. Pastikan data yang dikumpulkan lengkap dan sesuai dengan standar BPS. Segera selesaikan pekerjaan dan laporkan perkembangan secara berkala.',
            'volume' => 5,
            'satuan' => 'Blok Sensus',
            'tenggat' => now()->addDays(2)->format('Y-m-d'),
            'pemberitugas_id' => 3,
            'penerimatugas_id' => 7, //7
            'progress' => 4,
            'attachment' => NULL,
            'active' => TRUE,
            'created_at' => now()->subDays(2)->format('d-m-Y')
        ]);

        Task::create([
            'namakegiatan' => 'Survei IMK 2025',
            'slug' => '4_Survei-IMK-2025_'.now()->subDays(7)->format('d-m-Y').'_'.now()->subDays(2)->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk melaksanakan Survei IMK 2025, dengan tanggung jawab melakukan pencacahan terhadap 3 responden dalam periode 7 hari hingga batas waktu yang telah ditentukan. Pastikan data yang dikumpulkan akurat dan sesuai dengan pedoman survei. Segera selesaikan tugas dan laporkan perkembangan secara berkala.',
            'volume' => 3,
            'satuan' => 'Responden',
            'tenggat' => now()->subDays(2)->format('Y-m-d'),
            'pemberitugas_id' => 2,
            'penerimatugas_id' => 6, //6
            'progress' => 1,
            'attachment' => NULL,
            'active' => TRUE,
            'created_at' => now()->subDays(7)->format('Y-m-d')
        ]);

        Task::create([
            'namakegiatan' => 'Survei KSA April',
            'slug' => '5_Survei-KSA-April_'.now()->subDays(1)->format('d-m-Y').'_'.now()->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk melaksanakan Survei KSA April, dengan tanggung jawab melakukan pencacahan pada 1 segmen dalam waktu yang telah ditentukan. Pastikan data yang dikumpulkan akurat dan sesuai dengan prosedur yang berlaku. Segera laksanakan tugas dan laporkan perkembangan secara berkala.',
            'volume' => 1,
            'satuan' => 'Segmen',
            'tenggat' => now()->format('Y-m-d'),
            'pemberitugas_id' => 9,
            'penerimatugas_id' => 10, //10
            'progress' => 0,
            'attachment' => NULL,
            'active' => TRUE,
            'created_at' => now()->subDays(1)->format('d-m-Y')
        ]);

        Task::create([
            'namakegiatan' => 'Survei HK',
            'slug' => '6_Survei-HK_'.now()->format('d-m-Y').'_'.now()->addDays(6)->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk melaksanakan Survei HK, dengan tanggung jawab melakukan pencacahan pada 10 rumah tangga dalam waktu yang telah ditentukan. Pastikan data yang dikumpulkan akurat dan sesuai dengan prosedur yang berlaku. Segera laksanakan tugas dan laporkan perkembangan secara berkala.',
            'volume' => 10,
            'satuan' => 'Rumah Tangga',
            'tenggat' => now()->addDays(6)->format('Y-m-d'),
            'pemberitugas_id' => 2,
            'penerimatugas_id' => 6, //6
            'progress' => 5,
            'attachment' => NULL,
            'active' => TRUE,
        ]);

        Task::create([
            'namakegiatan' => 'Survei Pola Distribusi',
            'slug' => '7_Survei-Pola-Distribusi_'.now()->format('d-m-Y').'_'.now()->addDays(3)->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk melaksanakan Survei Pola Distribusi, dengan tanggung jawab melakukan pencacahan pada 3 rumah tangga dalam waktu yang telah ditentukan. Pastikan data yang dikumpulkan akurat dan sesuai dengan prosedur yang berlaku. Segera laksanakan tugas dan laporkan perkembangan secara berkala.',
            'volume' => 3,
            'satuan' => 'Rumah Tangga',
            'tenggat' => now()->addDays(3)->format('Y-m-d'),
            'pemberitugas_id' => 2,
            'penerimatugas_id' => 11, //11
            'progress' => 0,
            'attachment' => NULL,
            'active' => TRUE,
        ]);

        Task::create([
            'namakegiatan' => 'Sensus Ekonomi 2026',
            'slug' => '8_Sensus-Ekonomi_'.now()->format('d-m-Y').'_'.now()->addDays(7)->format('d-m-Y'),
            'deskripsi' => 'Anda ditugaskan untuk membuat publikasi Sensus Ekonomi 2026, dengan target menyelesaikan 4 bab publikasi dalam waktu yang telah ditentukan. Pastikan setiap bab disusun dengan akurat dan sesuai standar yang berlaku. Segera mulai pekerjaan dan laporkan perkembangan secara berkala.',
            'volume' => 4,
            'satuan' => 'Bab Publikasi',
            'tenggat' => now()->addDays(7)->format('Y-m-d'),
            'pemberitugas_id' => 4,
            'penerimatugas_id' => 8, //8
            'progress' => 1,
            'attachment' => NULL,
            'active' => TRUE,
        ]);

    }
}
