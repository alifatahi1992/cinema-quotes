<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //creating new admin whic have name and encrypt password
        $admin = new Admin();
        $admin->name = "test";
        $admin->password = bcrypt("test");
        $admin->save();
    }
}
