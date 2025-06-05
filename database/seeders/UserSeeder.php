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
            'user_full_name' => 'Ketua Tim 1',
            'user_nickname' => 'ketuatim1',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTim1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #3
        User::create([
            'team_id' => 3,
            'User_full_name' => 'Ketua Tim 2',
            'user_nickname' => 'ketuatim2',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTim2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // Anggota Tim
        // #4
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Tim 1',
            'user_nickname' => 'anggotatim1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaTim1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #5
        User::create([
            'team_id' => 3,
            'user_full_name' => 'Anggota Tim 2',
            'user_nickname' => 'anggotatim2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaTim2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #6
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Tim 3',
            'user_nickname' => 'anggotatim3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaTim3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #7
        User::create([
            'team_id' => 3,
            'user_full_name' => 'Anggota Tim 4',
            'user_nickname' => 'anggotatim4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaTim4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #8
        User::create([
            'team_id' => 2,
            'user_full_name' => 'Anggota Tim 5',
            'user_nickname' => 'anggotatim5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaTim5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);
    }
}