<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <= 5; $i++) { 
            User::create(['name'=>'Dummy', 'password'=>'dummypassword', 'email'=>$i.'dummyemail@mail.com']);
        }
    }
}
