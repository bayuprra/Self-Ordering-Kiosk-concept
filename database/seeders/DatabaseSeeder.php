<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(AkunSeeder::class);
        $this->call(kategoriSeeder::class);
        $this->call(menuSeeder::class);
        $this->call(mejaSeeder::class);
    }
}
