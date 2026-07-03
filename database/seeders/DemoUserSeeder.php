<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DemoUserSeeder extends Seeder
{
    public function run(): void
    {
        $subAdmins = [
            ['name' => 'Priya Sharma', 'email' => 'priya.subadmin@mnutravels.com'],
            ['name' => 'Rohit Verma', 'email' => 'rohit.subadmin@mnutravels.com'],
        ];

        foreach ($subAdmins as $user) {
            $created = User::query()->updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('Password@123'),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );

            $created->syncRoles(['Sub Admin']);
        }

        $helpliners = [
            ['name' => 'Anjali Mehta', 'email' => 'anjali.helpliner@mnutravels.com'],
            ['name' => 'Suresh Kumar', 'email' => 'suresh.helpliner@mnutravels.com'],
            ['name' => 'Neha Gupta', 'email' => 'neha.helpliner@mnutravels.com'],
        ];

        foreach ($helpliners as $user) {
            $created = User::query()->updateOrCreate(
                ['email' => $user['email']],
                [
                    'name' => $user['name'],
                    'password' => Hash::make('Password@123'),
                    'status' => 'active',
                    'email_verified_at' => now(),
                ]
            );

            $created->syncRoles(['Helpliner']);
        }
    }
}
