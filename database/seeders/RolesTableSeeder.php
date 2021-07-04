<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into roles (id, description ) values (?, ?)', [1, 'Restricted']);
        DB::insert('insert into roles (id, description ) values (?, ?)', [2, 'View']);
        DB::insert('insert into roles (id, description ) values (?, ?)', [3, 'Edit']);

    }
}
