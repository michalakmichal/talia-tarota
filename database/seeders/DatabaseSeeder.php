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
         //echo \App\Models\User::factory(10)->create();
         \App\Models\Message::factory(500)->create();
         //\App\Models\Card::factory(78)->create();
    }
}
