<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Check if admin already exists
        $adminExists = User::where('email', 'admin@jurislocator.com')->exists();
        
        if (!$adminExists) {
            User::create([
                'name' => 'System Administrator',
                'first_name' => 'System',
                'last_name' => 'Administrator', 
                'email' => 'admin@jurislocator.com',
                'password' => Hash::make('Admin123!'),
                'role' => 'admin',
                'user_type' => 'consultant', // Set a default user type
                'approval_status' => 'approved',
                'approved_at' => Carbon::now(),
                'email_verified_at' => Carbon::now(),
            ]);
            
            $this->command->info('Admin user created successfully!');
            $this->command->info('Email: admin@jurislocator.com');
            $this->command->info('Password: Admin123!');
        } else {
            $this->command->info('Admin user already exists.');
        }
    }
}
