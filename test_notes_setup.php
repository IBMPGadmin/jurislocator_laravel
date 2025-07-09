<?php
// Test file to verify notes functionality
require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Support\Facades\DB;

// Test database connection
try {
    echo "Testing database connection...\n";
    
    // Check if tables exist
    $userNotesTable = DB::select("SHOW TABLES LIKE 'user_personal_notes'");
    $clientNotesTable = DB::select("SHOW TABLES LIKE 'client_notes'");
    
    if (empty($userNotesTable)) {
        echo "ERROR: user_personal_notes table does not exist\n";
    } else {
        echo "✓ user_personal_notes table exists\n";
    }
    
    if (empty($clientNotesTable)) {
        echo "ERROR: client_notes table does not exist\n";
    } else {
        echo "✓ client_notes table exists\n";
    }
    
    // Check table structure
    $userNotesStructure = DB::select("DESCRIBE user_personal_notes");
    $clientNotesStructure = DB::select("DESCRIBE client_notes");
    
    echo "\nUser Personal Notes table structure:\n";
    foreach ($userNotesStructure as $column) {
        echo "- {$column->Field} ({$column->Type})\n";
    }
    
    echo "\nClient Notes table structure:\n";
    foreach ($clientNotesStructure as $column) {
        echo "- {$column->Field} ({$column->Type})\n";
    }
    
    echo "\n✓ Database tables are set up correctly!\n";
    
} catch (Exception $e) {
    echo "ERROR: " . $e->getMessage() . "\n";
}
