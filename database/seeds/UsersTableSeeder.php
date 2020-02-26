<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'manager',
            'email' => 'manager@gmail.com',
            'password' => bcrypt('manager'),
            'fullname' => 'manager',
            'address' => 'manager',
            'phone' => '00000000000',
            'credit_number' => '0000000000000000',
            'mm' => '00',
            'yy' => '00',
            'credit_name' => 'manager',
            'code' => '000',
            'role' => 1,
        ]);
    }
}
