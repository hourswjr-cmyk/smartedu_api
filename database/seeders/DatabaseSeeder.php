<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call(AdminUserSeeder::class);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password123'),
            'role' => 'cashier',
        ]);
         User::updateOrCreate(
            ['email' => 'cashier@electricstore.com'],
            [
                'name' => 'Cashier User',
                'password' => Hash::make('cashier123'),
                'role' => 'cashier',
            ]
        );

        User::updateOrCreate(
            ['email' => 'storekeeper@electricstore.com'],
            [
                'name' => 'Storekeeper User',
                'password' => Hash::make('storekeeper123'),
                'role' => 'storekeeper',
            ]
        );
    }
}
