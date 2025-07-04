<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AdminUserSeeder::class, // Add admin first
            UserSeeder::class,
            GovernmentLinkSeeder::class,
            RCICDeadlineSeeder::class,
            LegalKeyTermsTableSeeder::class,
            SubscriptionPackageSeeder::class,
            DashboardDemoDataSeeder::class,
        ]);
    }
}
