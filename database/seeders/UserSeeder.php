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
        // Administrator
        // #1
        User::create([
            'name' => 'Administrator',
            'username' => 'admin',
            'email' => 'administratorsmpbpsds@gmail.com',
            'role' => 'administrator',
            'password' => Hash::make('password'),
            'no_hp'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // Kepala BPS
        // #2
        User::create([
            'name' => 'Kepala BPS Deli Serdang',
            'username' => 'Kepala_bps',
            'email' => 'KepalaBPS@gmail.com',
            'role' => 'kepalakantor',
            'password' => Hash::make('password'),
            'no_hp'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // Ketua Tim
        // #3
        User::create([
            'name' => 'Ketua Tim',
            'username' => 'ketuatim',
            'email' => 'KetuaTim@gmail.com',
            'role' => 'ketuatim',
            'no_hp'=> '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // Anggota Tim
        // #4
        User::create([
            'name' => 'Anggota Tim 1',
            'username' => 'anggota1',
            'email' => 'anggotatim1@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #5
        User::create([
            'name' => 'Anggota Tim 2',
            'username' => 'anggota2',
            'email' => 'anggotatim2@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #6
        User::create([
            'name' => 'Anggota Tim 3',
            'username' => 'anggota3',
            'email' => 'anggotatim3@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #7
        User::create([
            'name' => 'Anggota Tim 4',
            'username' => 'anggota4',
            'email' => 'anggotatim4@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #8
        User::create([
            'name' => 'Anggota Tim 5',
            'username' => 'anggota5',
            'email' => 'anggotatim5@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    }
}