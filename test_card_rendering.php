<?php

require_once __DIR__ . '/vendor/autoload.php';

// Create a simple test file to debug the rendering issue
echo "Starting card rendering test...\n";

// Simulate the data structure
$results = collect([
    (object)[
        'act_name' => 'French IRPA',
        'act_id' => 1,
        'law_id' => 1,
        'jurisdiction_id' => 1,
        'language_id' => 2,
        'table_name' => 'french_irpa',
        'created_at' => '2024-01-01 00:00:00'
    ],
    (object)[
        'act_name' => 'Test Act',
        'act_id' => 2,
        'law_id' => 2,
        'jurisdiction_id' => 2,
        'language_id' => 1,
        'table_name' => 'test_act',
        'created_at' => '2024-01-02 00:00:00'
    ]
]);

$acts = [
    1 => 'Acts',
    2 => 'Appeal & Review Processes'
];

$lawSubjects = [
    1 => 'Immigration',
    2 => 'Citizenship'
];

$jurisdictions = [
    1 => 'Federal',
    2 => 'Alberta'
];

$languages = [
    1 => 'English',
    2 => 'French'
];

// Test the same logic as in the Blade template
echo "Testing array access logic:\n";

foreach ($results as $index => $row) {
    echo "Card {$index}:\n";
    echo "  Act Name: " . ($row->act_name ?? 'N/A') . "\n";
    echo "  Category: " . ($acts[$row->act_id ?? 0] ?? ($row->act_id ?? 'N/A')) . "\n";
    echo "  Law: " . ($lawSubjects[$row->law_id ?? 0] ?? ($row->law_id ?? 'N/A')) . "\n";
    echo "  Jurisdiction: " . ($jurisdictions[$row->jurisdiction_id ?? 0] ?? ($row->jurisdiction_id ?? 'N/A')) . "\n";
    echo "  Language: " . ($languages[$row->language_id ?? 0] ?? ($row->language_id ?? 'N/A')) . "\n";
    echo "  Date: " . ($row->created_at ? date('M d, Y', strtotime($row->created_at)) : 'N/A') . "\n";
    echo "\n";
}

echo "Test completed successfully!\n";
