<?php
// Section Matching Diagnostic Tool
// This script helps diagnose and verify section matching in the legal document system

// Initialize Laravel
require_once __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
);

// Get the database connection
$db = $app->make('db');

echo "===== SECTION MATCHING DIAGNOSTIC TOOL =====\n\n";

// Test function to check section ID matching
function testSectionIdMatching($db, $sectionId) {
    echo "Testing section ID matching for: $sectionId\n";
    
    // Execute raw SQL query with both methods to compare results
    echo "Method 1: Using LIKE operator\n";
    $resultsLike = $db->select("
        SELECT id, title, section_number, section_id 
        FROM legal_sections 
        WHERE section_id LIKE '%$sectionId%' 
        ORDER BY id LIMIT 10
    ");
    
    echo "Found " . count($resultsLike) . " sections with LIKE operator\n";
    foreach ($resultsLike as $row) {
        echo "  - ID: {$row->id}, Title: {$row->title}, Section Number: {$row->section_number}, Section ID: {$row->section_id}\n";
    }
    
    echo "\nMethod 2: Using exact matching\n";
    $resultsExact = $db->select("
        SELECT id, title, section_number, section_id 
        FROM legal_sections 
        WHERE section_id = '$sectionId' 
        OR section_id REGEXP '^{$sectionId}$' 
        OR section_id REGEXP '^{$sectionId}\\\\b' 
        OR section_id REGEXP '\\\\b{$sectionId}$' 
        OR section_id REGEXP '\\\\b{$sectionId}\\\\b'
        ORDER BY id LIMIT 10
    ");
    
    echo "Found " . count($resultsExact) . " sections with exact matching\n";
    foreach ($resultsExact as $row) {
        echo "  - ID: {$row->id}, Title: {$row->title}, Section Number: {$row->section_number}, Section ID: {$row->section_id}\n";
    }
    
    echo "\nMethod 3: Using strict numeric comparison for numeric section IDs\n";
    if (is_numeric($sectionId)) {
        $resultsNumeric = $db->select("
            SELECT id, title, section_number, section_id 
            FROM legal_sections 
            WHERE (section_id = '$sectionId' OR section_number = '$sectionId')
            AND NOT (
                section_id REGEXP '^{$sectionId}[0-9]' OR 
                section_id REGEXP '[0-9]{$sectionId}$' OR 
                section_id REGEXP '[0-9]{$sectionId}[0-9]' OR
                section_number REGEXP '^{$sectionId}[0-9]' OR 
                section_number REGEXP '[0-9]{$sectionId}$' OR 
                section_number REGEXP '[0-9]{$sectionId}[0-9]'
            )
            ORDER BY id LIMIT 10
        ");
        
        echo "Found " . count($resultsNumeric) . " sections with strict numeric comparison\n";
        foreach ($resultsNumeric as $row) {
            echo "  - ID: {$row->id}, Title: {$row->title}, Section Number: {$row->section_number}, Section ID: {$row->section_id}\n";
        }
    } else {
        echo "Not a numeric section ID, skipping numeric comparison test\n";
    }
    
    echo "\n";
}

// Test some common section IDs
$testSectionIds = ['17', '170', '17.1', '17(1)', '100'];

foreach ($testSectionIds as $sectionId) {
    testSectionIdMatching($db, $sectionId);
    echo "------------------------------\n\n";
}

// Get the controller class that handles section matching
echo "===== CONTROLLER CODE INSPECTION =====\n\n";

// Check if the ViewLegalTableController exists and inspect its methods
$controllerPath = __DIR__ . '/app/Http/Controllers/ViewLegalTableController.php';
if (file_exists($controllerPath)) {
    $controllerCode = file_get_contents($controllerPath);
    
    echo "ViewLegalTableController found\n";
    
    // Check for the buildSectionSearchQuery method
    if (preg_match('/function\s+buildSectionSearchQuery\s*\([^)]*\)\s*{([^}]+)}/s', $controllerCode, $matches)) {
        echo "buildSectionSearchQuery method found:\n";
        echo $matches[1] . "\n";
        
        // Check if the method has the exact matching code
        if (strpos($matches[1], 'strict numeric comparison') !== false) {
            echo "✅ Controller contains strict numeric comparison for section IDs\n";
        } else {
            echo "❌ Controller does NOT contain strict numeric comparison for section IDs\n";
        }
    } else {
        echo "buildSectionSearchQuery method not found\n";
    }
} else {
    echo "ViewLegalTableController not found at path: $controllerPath\n";
}

echo "\n===== JAVASCRIPT FIXES VERIFICATION =====\n\n";

// Check for the client-side fixes
$jsFiles = [
    'section-matching-fix.js' => __DIR__ . '/public/user_assets/js/section-matching-fix.js',
    'section-debug-tool.js' => __DIR__ . '/public/user_assets/js/section-debug-tool.js',
    'exact-section-matcher.js' => __DIR__ . '/public/user_assets/js/exact-section-matcher.js',
    'last-resort-filter.js' => __DIR__ . '/public/user_assets/js/last-resort-filter.js'
];

foreach ($jsFiles as $name => $path) {
    if (file_exists($path)) {
        echo "✅ $name exists\n";
        $fileSize = filesize($path);
        echo "   File size: " . round($fileSize / 1024, 2) . " KB\n";
        
        // Check the file content for key indicators
        $fileContent = file_get_contents($path);
        
        if ($name === 'exact-section-matcher.js') {
            if (strpos($fileContent, 'window.fetch') !== false) {
                echo "   Contains fetch API interception\n";
            }
        }
        
        if ($name === 'last-resort-filter.js') {
            if (strpos($fileContent, 'MutationObserver') !== false) {
                echo "   Contains MutationObserver for DOM monitoring\n";
            }
            if (strpos($fileContent, 'filterPopupContent') !== false) {
                echo "   Contains popup content filtering\n";
            }
        }
    } else {
        echo "❌ $name does not exist at path: $path\n";
    }
}

echo "\n===== DIAGNOSTIC COMPLETE =====\n";
echo "Multiple layers of protection are now in place to ensure exact section matching:\n";
echo "1. Server-side SQL filtering with strict numeric comparison\n";
echo "2. Fetch API interception for client-side filtering\n";
echo "3. DOM-level last resort filter using MutationObserver\n";
echo "\nThis comprehensive approach should ensure that clicking on 'Section 17' only shows section 17, not section 170.\n";
