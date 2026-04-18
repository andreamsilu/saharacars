<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed admin panel users.
     */
    public function run(): void
    {
        $adminUsers = [
            [
                'name' => 'Super Admin',
                'email' => 'admin@saharacars.test',
                'password' => 'admin12345',
            ],
            [
                'name' => 'Sales Admin',
                'email' => 'sales.admin@saharacars.test',
                'password' => 'admin12345',
            ],
        ];

        foreach ($adminUsers as $adminUser) {
            User::query()->updateOrCreate(
                ['email' => $adminUser['email']],
                [
                    'name' => $adminUser['name'],
                    // Store only a hash to keep credentials secure at rest.
                    'password' => Hash::make($adminUser['password']),
                ]
            );
        }
    }
}
