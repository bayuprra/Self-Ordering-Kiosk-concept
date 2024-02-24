<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;

class kategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'nama'         => 'Makanan',
            ],
            [
                'nama'         => 'Minuman',
            ],
            [
                'nama'         => 'Lainnya',
            ]
        ];

        foreach ($data as $item) {
            Kategori::create($item);
        }
    }
}
