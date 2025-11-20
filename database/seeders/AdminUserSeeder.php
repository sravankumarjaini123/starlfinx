<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Prevent duplicate admin
        if (User::where('email', 'admin@starlfinx.com')->exists()) {
            return;
        }

        User::create([
            'name' => 'Super Admin',
            'email' => 'admin@starlfinx.com',
            'mobile' => '9876543210',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'status' => 'active',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s')
        ]);
    }
}
