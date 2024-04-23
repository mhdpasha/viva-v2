<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class BukuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $judul = "Filosofi Teras";
        $stok = 5;
        $kategori = 3;

        DB::table('bukus')->insert([
            [
                'kategori_id' => $kategori,
                'judul' => $judul,
                'pengarang' => "Henry Manampiring",
                'penerbit' => "Erlangga",
                'deskripsi' => "Buku mengenai pehamahaman filsuf stoa",
                'image' => "https://gerai.kompas.id/wp-content/uploads/2023/06/ginee_20230622180630695_7892702895.png",
                'stok' => $stok
            ]
        ]);

        $serial = substr($judul, 0, 1);

        for($i = 0; $i < $stok; $i ++)
        {
            DB::table('detail_bukus')->insert([
                'buku_id' => 1,
                'status' => 'Tersedia',
                'serial_num' => "AR-{$serial}" . "-{$kategori}-" . "BOOK-" . $i + 1 . "-" . Str::orderedUuid()
            ]);
        }
    }
}
