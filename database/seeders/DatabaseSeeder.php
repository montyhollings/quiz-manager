<?php

namespace Database\Seeders;
use Database\Seeders\UserTableSeeder;
use Database\Seeders\RolesTableSeeder;
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
        $this->call([
            RolesTableSeeder::class,
            UserTableSeeder::class,
        ]);
    }
}
