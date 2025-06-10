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

        // #5
        User::create([
            'team_id' => 5,
            'User_full_name' => 'Ketua Tim Nerwilis',
            'user_nickname' => 'ketuatimnerwilis',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTimNerwilis@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #6
        User::create([
            'team_id' => 6,
            'User_full_name' => 'Ketua Tim IPDS',
            'user_nickname' => 'ketuatimipds',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTimIPDS@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #7
        User::create([
            'team_id' => 7,
            'User_full_name' => 'Ketua Tim Sektoral',
            'user_nickname' => 'ketuatimsektoral',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTimSektoral@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #8
        User::create([
            'team_id' => 8,
            'User_full_name' => 'Ketua Tim Humas',
            'user_nickname' => 'ketuatimhumas',
            'user_role' => 'ketuatim',
            'email' => 'KetuaTimHumas@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number'=> '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // Anggota Tim
        // #9
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

        // #10
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

        // #11
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

        // #12
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

        // #13
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

        // #14
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

        // #15
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

        // #16
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

        // #17
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

        // #18
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

        // #19
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

        // #20
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

        // #21
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

        // #22
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

        // #23
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

        // #24
        User::create([
            'team_id' => 5,
            'user_full_name' => 'Anggota Nerwilis 1',
            'user_nickname' => 'anggotanerwilis1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaNerwilis1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #25
        User::create([
            'team_id' => 5,
            'user_full_name' => 'Anggota Nerwilis 2',
            'user_nickname' => 'anggotanerwilis2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaNerwilis2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #26
        User::create([
            'team_id' => 5,
            'user_full_name' => 'Anggota Nerwilis 3',
            'user_nickname' => 'anggotanerwilis3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaNerwilis3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #27
        User::create([
            'team_id' => 5,
            'user_full_name' => 'Anggota Nerwilis 4',
            'user_nickname' => 'anggotanerwilis4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaNerwilis4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #28
        User::create([
            'team_id' => 5,
            'user_full_name' => 'Anggota Nerwilis 5',
            'user_nickname' => 'anggotanerwilis5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaNerwilis5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #29
        User::create([
            'team_id' => 6,
            'user_full_name' => 'Anggota IPDS 1',
            'user_nickname' => 'anggotaipds1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaIPDS1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #30
        User::create([
            'team_id' => 6,
            'user_full_name' => 'Anggota IPDS 2',
            'user_nickname' => 'anggotaipds2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaIPDS2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #31
        User::create([
            'team_id' => 6,
            'user_full_name' => 'Anggota IPDS 3',
            'user_nickname' => 'anggotaipds3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaIPDS3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #32
        User::create([
            'team_id' => 6,
            'user_full_name' => 'Anggota IPDS 4',
            'user_nickname' => 'anggotaipds4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaIPDS4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #33
        User::create([
            'team_id' => 6,
            'user_full_name' => 'Anggota IPDS 5',
            'user_nickname' => 'anggotaipds5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaIPDS5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #34
        User::create([
            'team_id' => 7,
            'user_full_name' => 'Anggota Sektoral 1',
            'user_nickname' => 'anggotasektoral1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSektoral1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #35
        User::create([
            'team_id' => 7,
            'user_full_name' => 'Anggota Sektoral 2',
            'user_nickname' => 'anggotasektoral2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSektoral2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #36
        User::create([
            'team_id' => 7,
            'user_full_name' => 'Anggota Sektoral 3',
            'user_nickname' => 'anggotasektoral3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSektoral3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #37
        User::create([
            'team_id' => 7,
            'user_full_name' => 'Anggota Sektoral 4',
            'user_nickname' => 'anggotasektoral4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSektoral4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #38
        User::create([
            'team_id' => 7,
            'user_full_name' => 'Anggota Sektoral 5',
            'user_nickname' => 'anggotasektoral5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaSektoral5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #39
        User::create([
            'team_id' => 8,
            'user_full_name' => 'Anggota Humas 1',
            'user_nickname' => 'anggotahumas1',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaHumas1@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #40
        User::create([
            'team_id' => 8,
            'user_full_name' => 'Anggota Humas 2',
            'user_nickname' => 'anggotahumas2',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaHumas2@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #41
        User::create([
            'team_id' => 8,
            'user_full_name' => 'Anggota Humas 3',
            'user_nickname' => 'anggotahumas3',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaHumas3@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #42
        User::create([
            'team_id' => 8,
            'user_full_name' => 'Anggota Humas 4',
            'user_nickname' => 'anggotahumas4',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaHumas4@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);

        // #43
        User::create([
            'team_id' => 8,
            'user_full_name' => 'Anggota Humas 5',
            'user_nickname' => 'anggotahumas5',
            'user_role' => 'anggotatim',
            'email' => 'AnggotaHumas5@gmail.com',
            'password' => Hash::make('password'),
            'user_whatsapp_number' => '08887654811',
            'remember_token' => Str::random(10)
        ]);
        
    }
}