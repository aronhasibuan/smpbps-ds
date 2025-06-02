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
            'name' => 'Kepala BPS Deli Serdang',
            'username' => 'Kepala_bps',
            'email' => 'KepalaBPS@gmail.com',
            'role' => 'kepalakantor',
            'no_hp'=> '08887654811',
            'team_id' => 1,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // Ketua Tim
        // #2
        User::create([
            'name' => 'Ketua Tim',
            'username' => 'ketuatim',
            'email' => 'KetuaTim@gmail.com',
            'role' => 'ketuatim',
            'no_hp'=> '08887654811',
            'team_id' => 2,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #3
        User::create([
            'name' => 'Ketua Tim 2',
            'username' => 'ketuatim2',
            'email' => 'KetuaTim2@gmail.com',
            'role' => 'ketuatim',
            'no_hp'=> '08887654811',
            'team_id' => 3,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // Anggota Tim
        // #4
        User::create([
            'name' => 'Anggota Tim 1',
            'username' => 'anggotatim1',
            'email' => 'anggotatim1@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'team_id' => 2,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #5
        User::create([
            'name' => 'Anggota Tim 2',
            'username' => 'anggotatim2',
            'email' => 'anggotatim2@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'team_id' => 3,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #6
        User::create([
            'name' => 'Anggota Tim 3',
            'username' => 'anggotatim3',
            'email' => 'anggotatim3@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'team_id' => 2,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #7
        User::create([
            'name' => 'Anggota Tim 4',
            'username' => 'anggotatim4',
            'email' => 'anggotatim4@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'team_id' => 3,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #8
        User::create([
            'name' => 'Anggota Tim 5',
            'username' => 'anggotatim5',
            'email' => 'anggotatim5@gmail.com',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'team_id' => 2,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    }
}