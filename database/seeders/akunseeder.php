<?php

namespace Database\Seeders;

use App\Models\AkunModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AkunSeeder extends Seeder
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
                'username'         => 'owner@gmail.com',
                'password'      => bcrypt("owner1234"),
                'role_id'       => 1,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username'         => 'kasir@gmail.com',
                'password'      => bcrypt("kasir1234"),
                'role_id'       => 2,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'username'         => 'kitchen@gmail.com',
                'password'      => bcrypt("kitchen1234"),
                'role_id'       => 3,
                'created_at'    => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at'    => Carbon::now()->format('Y-m-d H:i:s'),
            ]
        ];

        foreach ($data as $item) {
            AkunModel::create($item);
        }
    }
}
