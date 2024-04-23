<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;


class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategoris')->insert([
            [
                'nama' => 'Fiksi',
                'kode' => 'AR-FIK',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Non-Fiksi',
                'kode' => 'AR-NONF',
                'status' => 'aktif'
            ],
            [
                'nama' => 'Pendidikan',
                'kode' => 'AR-PEND',
                'status' => 'aktif'
            ]
        ]);
    }
}
