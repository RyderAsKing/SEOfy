<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        if (!\App\Models\User::where('email', 'admin@example.com')->exists()) {
            \App\Models\User::factory()->create([
                'name' => 'Admin',
                'password' => bcrypt('password'), // 'password
                'email' => 'admin@example.com',
                'is_admin' => true,
            ]);
        } else {
            echo "Admin user already exists.\n";
        }
    }
}
