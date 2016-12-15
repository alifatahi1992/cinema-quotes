<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //we change the main call to AdminTableSeeder
         $this->call(AdminTableSeeder::class);
    }
}
