<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class AddTestClients extends Migration
{
    public function up()
    {
        // Add some test clients
        $userId = 1; // Assuming user ID 1 exists
        
        DB::table('client_table')->insert([
            [
                'client_name' => 'Test Client 1',
                'client_email' => 'client1@example.com',
                'client_status' => 'Active',
                'user_id' => $userId,
                'last_accessed' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_name' => 'Test Client 2',
                'client_email' => 'client2@example.com',
                'client_status' => 'Active',
                'user_id' => $userId,
                'last_accessed' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'client_name' => 'Test Client 3',
                'client_email' => 'client3@example.com',
                'client_status' => 'Inactive',
                'user_id' => $userId,
                'last_accessed' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down()
    {
        DB::table('client_table')->where('client_email', 'like', '%@example.com')->delete();
    }
}
