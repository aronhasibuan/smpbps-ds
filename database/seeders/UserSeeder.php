<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Elly Suharyadi, SST, M.Si',
            'username' => 'ellysuharyadi',
            'email' => 'EllySuharyadi@bps.go.id',
            'role' => 'kepalakantor',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Ridho Julandra, SST, M.Sc',
            'username' => 'julandra',
            'email' => 'RidhoJulandra@bps.go.id',
            'role' => 'ketuatim',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Hot Bonar, SST, M.Stat',
            'username' => 'bonarsitumorang',
            'email' => 'HotBonar@bps.go.id',
            'role' => 'ketuatim',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Irwanto, S.Kom',
            'username' => 'irwanto2',
            'email' => 'Irwanto@bps.go.id',
            'role' => 'ketuatim',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Irwanto Pardamean Hutagalung, A.Md',
            'username' => 'irwantopardamean',
            'email' => 'IrwantoHutagalung@bps.go.id',
            'role' => 'anggotatim',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Juhar Monang.S.Tambun, SST',
            'username' => 'juharmonang',
            'email' => 'JuharMonang@bps.go.id',
            'role' => 'anggotatim',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Novi Fahdilla, S.Tr.Stat.',
            'username' => 'novi.fahdilla',
            'email' => 'Novifahdilla@bps.go.id',
            'role' => 'anggotatim',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

    }
}