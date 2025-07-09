<?php

// Simple test for notes functionality
require_once __DIR__ . '/vendor/autoload.php';

use App\Models\UserPersonalNote;
use App\Models\ClientNote;
use Illuminate\Support\Facades\App;

$app = App::createApplication();

try {
    echo "Testing UserPersonalNote model...\n";
    $userNote = new UserPersonalNote();
    echo "UserPersonalNote model created successfully\n";
    
    echo "Testing ClientNote model...\n";
    $clientNote = new ClientNote();
    echo "ClientNote model created successfully\n";
    
    echo "Testing table connections...\n";
    echo "UserPersonalNote table: " . $userNote->getTable() . "\n";
    echo "ClientNote table: " . $clientNote->getTable() . "\n";
    
    echo "Testing fillable fields...\n";
    echo "UserPersonalNote fillable: " . implode(', ', $userNote->getFillable()) . "\n";
    echo "ClientNote fillable: " . implode(', ', $clientNote->getFillable()) . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
