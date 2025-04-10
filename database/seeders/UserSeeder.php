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
            'email' => 'administratorsmpbpsds@bps.go.id',
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
            'email' => 'KepalaBPS@bps.go.id',
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
            'email' => 'KetuaTim@bps.go.id',
            'role' => 'ketuatim',
            'no_hp'=> '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // Anggota Tim
        // #4
        User::create([
            'name' => 'Aron Zyode Kaxanca Hasibuan',
            'username' => 'aronhsb16',
            'email' => 'AronHasibuan@bps.go.id',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #5
        User::create([
            'name' => 'Arsyka Laila Oktalia Siregar',
            'username' => 'arsyka_laila',
            'email' => 'ArsykaLaila@bps.go.id',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #6
        User::create([
            'name' => 'Kristian Ernala Wicaksono',
            'username' => 'ignya.kristian',
            'email' => 'KristianErnala@bps.go.id',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #7
        User::create([
            'name' => 'Pratiwi',
            'username' => 'pratiwi',
            'email' => 'Pratiwi@bps.go.id',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        // #8
        User::create([
            'name' => 'Mita Febrianti',
            'username' => 'mita_febrianti',
            'email' => 'MitaFebrianti@bps.go.id',
            'role' => 'anggotatim',
            'no_hp' => '08887654811',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    }
}