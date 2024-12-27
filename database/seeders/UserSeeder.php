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
            'name' => 'Ridho Julandra, SST, M.Sc',
            'username' => 'julandra',
            'email' => 'RidhoJulandra@gmail.com',
            'is_teamleader' => 1,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Hot Bonar, SST, M.Stat',
            'username' => 'bonarsitumorang',
            'email' => 'HotBonar@gmail.com',
            'is_teamleader' => 1,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Irwanto, S.Kom',
            'username' => 'irwanto2',
            'email' => 'Irwanto@gmail.com',
            'is_teamleader' => 1,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Irwanto Pardamean Hutagalung, A.Md',
            'username' => 'irwantopardamean',
            'email' => 'IrwantoHutagalung@gmail.com',
            'is_teamleader' => 0,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Juhar Monang.S.Tambun, SST',
            'username' => 'juharmonang',
            'email' => 'JuharMonang@gmail.com',
            'is_teamleader' => 0,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Novi Fahdilla, S.Tr.Stat.',
            'username' => 'novi.fahdilla',
            'email' => 'Novifahdilla@gmail.com',
            'is_teamleader' => 0,
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

    }
}
