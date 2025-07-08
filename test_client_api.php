<?php

require_once __DIR__ . '/vendor/autoload.php';

// Create a new Laravel application instance
$app = require_once __DIR__ . '/bootstrap/app.php';

// Boot the application
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

// Test the client API functionality
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

echo "=== Testing Client API Functionality ===\n\n";

// Check if clients table exists and has data
try {
    echo "1. Checking client_table structure:\n";
    $clients = Client::all();
    echo "Total clients in database: " . $clients->count() . "\n";
    
    if ($clients->count() > 0) {
        echo "Sample client data:\n";
        foreach ($clients->take(3) as $client) {
            echo "- ID: {$client->id}, Name: {$client->client_name}, User ID: {$client->user_id}\n";
        }
    }
    echo "\n";
    
    echo "2. Checking users who have clients:\n";
    $usersWithClients = Client::select('user_id')->distinct()->pluck('user_id');
    echo "Users with clients: " . $usersWithClients->implode(', ') . "\n\n";
    
    echo "3. Testing ClientController methods directly:\n";
    
    // Test with first user who has clients
    if ($usersWithClients->count() > 0) {
        $testUserId = $usersWithClients->first();
        $user = User::find($testUserId);
        
        if ($user) {
            echo "Testing with user ID: {$testUserId}, Name: {$user->name}\n";
            
            // Manually authenticate user
            Auth::login($user);
            
            // Test getClients method
            $controller = new \App\Http\Controllers\ClientController();
            $request = new \Illuminate\Http\Request();
            
            // Call getClients method
            $response = $controller->getClients($request);
            $responseData = json_decode($response->getContent(), true);
            
            echo "getClients response:\n";
            echo "Success: " . ($responseData['success'] ? 'true' : 'false') . "\n";
            if (isset($responseData['clients'])) {
                echo "Clients count: " . count($responseData['clients']) . "\n";
                foreach ($responseData['clients'] as $client) {
                    echo "- {$client['client_name']} (ID: {$client['id']})\n";
                }
            }
        }
    } else {
        echo "No users with clients found.\n";
    }
    
} catch (\Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}

echo "\n=== Test Complete ===\n";
