<?php

// Test script to verify the content workflow
require_once 'vendor/autoload.php';
require_once 'bootstrap/app.php';

echo "=== Testing Content Workflow ===\n\n";

try {
    // Test 1: Check if Content model exists and table is accessible
    echo "1. Testing Content model...\n";
    $contentCount = \App\Models\Content::count();
    echo "   ✓ Content table accessible, found {$contentCount} records\n\n";
    
    // Test 2: Check route configuration
    echo "2. Testing route configuration...\n";
    $routes = app('router')->getRoutes();
    $clientManagementRoute = false;
    $saveContentRoute = false;
    
    foreach ($routes as $route) {
        if ($route->uri() === 'client-management') {
            $clientManagementRoute = true;
            echo "   ✓ /client-management route found\n";
        }
        if ($route->uri() === 'save-content') {
            $saveContentRoute = true;
            echo "   ✓ /save-content route found\n";
        }
    }
    
    if (!$clientManagementRoute) echo "   ✗ /client-management route NOT found\n";
    if (!$saveContentRoute) echo "   ✗ /save-content route NOT found\n";
    
    echo "\n";
    
    // Test 3: Check controller methods
    echo "3. Testing controller methods...\n";
    $clientController = new \App\Http\Controllers\ClientController();
    $contentController = new \App\Http\Controllers\ContentController();
    
    if (method_exists($clientController, 'legalTables')) {
        echo "   ✓ ClientController::legalTables method exists\n";
    } else {
        echo "   ✗ ClientController::legalTables method NOT found\n";
    }
    
    if (method_exists($contentController, 'saveContent')) {
        echo "   ✓ ContentController::saveContent method exists\n";
    } else {
        echo "   ✗ ContentController::saveContent method NOT found\n";
    }
    
    echo "\n";
    
    // Test 4: Check view file
    echo "4. Testing view file...\n";
    $viewPath = resource_path('views/user-legal-tables.blade.php');
    if (file_exists($viewPath)) {
        echo "   ✓ user-legal-tables.blade.php view exists\n";
        
        $viewContent = file_get_contents($viewPath);
        if (strpos($viewContent, 'droppableArea') !== false) {
            echo "   ✓ Droppable area found in view\n";
        } else {
            echo "   ✗ Droppable area NOT found in view\n";
        }
        
        if (strpos($viewContent, 'contentEditor') !== false) {
            echo "   ✓ Content editor found in view\n";
        } else {
            echo "   ✗ Content editor NOT found in view\n";
        }
    } else {
        echo "   ✗ user-legal-tables.blade.php view NOT found\n";
    }
    
    echo "\n=== Test Complete ===\n";
    
} catch (\Exception $e) {
    echo "Error during testing: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
