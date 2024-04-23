<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'no_induk' => '12510',
                'nama' => 'Muhamad Pasha Albara',
                'tempatlahir' => 'Jakarta',
                'tanggallahir' => '2006-10-01',
                'email' => 'pasha@gmail.com',
                'password' => Hash::make('pasha'),
                'status' => 'aktif',
                'role' => 'admin'
            ],
            [
                'no_induk' => '12511',
                'nama' => 'Muhamad Faang Fadilah',
                'tempatlahir' => 'Jakarta',
                'tanggallahir' => '2004-12-21',
                'email' => 'paang@gmail.com',
                'password' => Hash::make('paang'),
                'status' => 'aktif',
                'role' => 'user'
            ],
        ]);
    }
}
