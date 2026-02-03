<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create a default admin for testing/initial setup
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'admin@xlerion.com',
            'password' => bcrypt('ChangeMe123!'),
            'role' => 'admin',
        ]);

        // Seed some buyers and sellers
        User::factory()->count(8)->create();
    }
}
