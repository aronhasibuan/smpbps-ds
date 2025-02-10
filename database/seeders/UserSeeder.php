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
        User::create([
            'name' => 'Elly Suharyadi, SST, M.Si',
            'username' => 'ellysuharyadi',
            'email' => 'EllySuharyadi@bps.go.id',
            'role' => 'kepalakantor',
            'password' => Hash::make('password'),
            'no_hp'=> '08xxxxxxxxxx',
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Ridho Julandra, SST, M.Sc',
            'username' => 'julandra',
            'email' => 'RidhoJulandra@bps.go.id',
            'role' => 'ketuatim',
            'no_hp'=> '081264569233',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Hot Bonar, SST, M.Stat',
            'username' => 'bonarsitumorang',
            'email' => 'HotBonar@bps.go.id',
            'role' => 'ketuatim',
            'no_hp'=> '081362102388',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Irwanto, S.Kom',
            'username' => 'irwanto2',
            'email' => 'Irwanto@bps.go.id',
            'role' => 'ketuatim',
            'no_hp'=> '081361234177',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Irwanto Pardamean Hutagalung, A.Md',
            'username' => 'irwantopardamean',
            'email' => 'IrwantoHutagalung@bps.go.id',
            'role' => 'anggotatim',
            'no_hp'=> '081218615368',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Juhar Monang.S.Tambun, SST',
            'username' => 'juharmonang',
            'email' => 'JuharMonang@bps.go.id',
            'role' => 'anggotatim',
            'no_hp'=> '081260756948',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Novi Fahdilla, S.Tr.Stat.',
            'username' => 'novi.fahdilla',
            'email' => 'Novifahdilla@bps.go.id',
            'role' => 'anggotatim',
            'no_hp'=> '085780507906',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);

        User::create([
            'name' => 'Dwi Nissa Ananda, S.Tr.Stat.',
            'username' => 'dwi.nissa',
            'email' => 'DwiNissa@bps.go.id',
            'role' => 'anggotatim',
            'no_hp' => '082274975190',
            'password' => Hash::make('password'),
            'remember_token' => Str::random(10)
        ]);
    }
}