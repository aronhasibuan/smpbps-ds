<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Kepala BPS
        // #1
        User::create([
            'team_id' => 1,
            'user_full_name' => 'Kepala BPS Deli Serdang',
            'user_nickname' => 'Kepala_bps',
            'user_role' => 'kepalabps',
            'email' => 'KepalaBPS@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // Ketua Tim
        // #2
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Ketua Tim Produksi',
            'user_nickname' => 'ketuatimproduksi',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTimProduksi@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #3
        User::create([
            'team_id' => 3,
            'User_full_name' => 'Ketua Tim Distribusi',
            'user_nickname' => 'ketuatimdistribusi',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTimDistribusi@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #4
        User::create([
            'team_id' => 4,
            'User_full_name' => 'Ketua Tim Sosial',
            'user_nickname' => 'ketuatimsosial',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTimSosial@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // Anggota Tim
        // #5
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Produksi 1',
            'user_nickname' => 'anggotaproduksi1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaProduksi1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #6
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Produksi 2',
            'user_nickname' => 'anggotaproduksi2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaProduksi2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #7
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Produksi 3',
            'user_nickname' => 'anggotaproduksi3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaProduksi3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #8
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Produksi 4',
            'user_nickname' => 'anggotaproduksi4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaProduksi4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #9
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Produksi 5',
            'user_nickname' => 'anggotaproduksi5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaProduksi5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #10
        User::create([
            'team_id' => 3,
            'user_full_name' => 'Anggota Distribusi 1',
            'user_nickname' => 'anggotadistribusi1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaDistribusi1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #11
        User::create([
            'team_id' => 3,
            'user_full_name' => 'Anggota Distribusi 2',
            'user_nickname' => 'anggotadistribusi2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaDistribusi2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #12
        User::create([
            'team_id' => 3,
            'user_full_name' => 'Anggota Distribusi 3',
            'user_nickname' => 'anggotadistribusi3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaDistribusi3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #13
        User::create([
            'team_id' => 3,
            'user_full_name' => 'Anggota Distribusi 4',
            'user_nickname' => 'anggotadistribusi4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaDistribusi4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #14
        User::create([
            'team_id' => 3,
            'user_full_name' => 'Anggota Distribusi 5',
            'user_nickname' => 'anggotadistribusi5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaDistribusi5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #15
        User::create([
            'team_id' => 4,
            'user_full_name' => 'Anggota Sosial 1',
            'user_nickname' => 'anggotasosial1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSosial1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #16
        User::create([
            'team_id' => 4,
            'user_full_name' => 'Anggota Sosial 2',
            'user_nickname' => 'anggotasosial2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSosial2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #17
        User::create([
            'team_id' => 4,
            'user_full_name' => 'Anggota Sosial 3',
            'user_nickname' => 'anggotasosial3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSosial3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #18
        User::create([
            'team_id' => 4,
            'user_full_name' => 'Anggota Sosial 4',
            'user_nickname' => 'anggotasosial4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSosial4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #19
        User::create([
            'team_id' => 4,
            'user_full_name' => 'Anggota Sosial 5',
            'user_nickname' => 'anggotasosial5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSosial5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);
        
    }
}