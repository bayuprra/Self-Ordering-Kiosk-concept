<?php

namespace Database\Seeders;

use App\Models\Meja;
use Illuminate\Database\Seeder;

class mejaSeeder extends Seeder
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
                'nomor'         => 001,
            ],
            [
                'nomor'         => 002,
            ],
            [
                'nomor'         => 003,
            ]
        ];

        foreach ($data as $item) {
            Meja::create($item);
        }
    }
}
