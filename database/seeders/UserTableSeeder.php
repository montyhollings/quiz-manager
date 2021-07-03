<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::insert('insert into users (id, name, email, password ) values (?, ?, ?, ?)', [1, 'Monty Hollings', 'montyhollings@mailbox.org', '$2y$10$KcDadQfDIYyiHQdf0AKbMOiBjPEYhWkXv1WiZoAjoeE.hHNskM6c2']);
    }
}
