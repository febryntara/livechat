<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Department;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'administrator',
            'email' => 'administrator@admin.com',
            'password' => Hash::make("pnblivechat"),
            'role' => 'admin'
        ]);

        for ($i = 0; $i < 5; $i++) {
            Department::factory()->create();
        }

        for ($i = 0; $i < 5; $i++) {
            $y = $i + 1;
            \App\Models\User::factory()->create([
                'name' => 'admin',
                'email' => "cs$y@admin.com",
                'password' => Hash::make("pnblivechat"),
                'role' => 'cs',
                'department_id' => $y
            ]);
        }
    }
}
