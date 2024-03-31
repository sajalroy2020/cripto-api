<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::insert([
            ['uu_id' => '3353', 'name' => 'Admin', 'role' => 1, 'email' => 'admin@gmail.com', 'password' => Hash::make(12345678), 'status' => 1],
        ]);
    }
}
