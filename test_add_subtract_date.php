<?php

require_once 'vendor/autoload.php';

use Carbon\Carbon;

echo "Testing Add/Subtract Date Calculator\n";
echo "====================================\n\n";

try {
    // Test 1: Basic addition
    $date = Carbon::parse('2024-01-01 12:00:00');
    echo "Original date: " . $date->format('Y-m-d H:i:s') . "\n";
    
    // Add 3 years
    $result1 = $date->copy()->addYears(3);
    echo "After adding 3 years: " . $result1->format('Y-m-d H:i:s') . "\n";
    
    // Add 6 months
    $result2 = $date->copy()->addMonths(6);
    echo "After adding 6 months: " . $result2->format('Y-m-d H:i:s') . "\n";
    
    // Add 2 weeks
    $result3 = $date->copy()->addWeeks(2);
    echo "After adding 2 weeks: " . $result3->format('Y-m-d H:i:s') . "\n";
    
    // Add 10 days
    $result4 = $date->copy()->addDays(10);
    echo "After adding 10 days: " . $result4->format('Y-m-d H:i:s') . "\n";
    
    echo "\n";
    
    // Test 2: Subtraction
    echo "Testing subtraction:\n";
    $result5 = $date->copy()->subYears(1);
    echo "After subtracting 1 year: " . $result5->format('Y-m-d H:i:s') . "\n";
    
    $result6 = $date->copy()->subMonths(3);
    echo "After subtracting 3 months: " . $result6->format('Y-m-d H:i:s') . "\n";
    
    echo "\n";
    
    // Test 3: Combined operations (simulating what controller does)
    echo "Testing combined operations:\n";
    $testDate = Carbon::parse('2024-07-04 13:00:00');
    echo "Starting date: " . $testDate->format('Y-m-d H:i:s') . "\n";
    
    // Simulate form data
    $units = [
        'years' => ['value' => 1, 'operation' => 'add'],
        'months' => ['value' => 6, 'operation' => 'add'],
        'weeks' => ['value' => 0, 'operation' => 'add'],
        'days' => ['value' => 15, 'operation' => 'subtract'],
        'hours' => ['value' => 2, 'operation' => 'add'],
        'minutes' => ['value' => 30, 'operation' => 'subtract'],
        'seconds' => ['value' => 0, 'operation' => 'add']
    ];
    
    foreach ($units as $unit => $config) {
        $value = (int) $config['value'];
        $operation = $config['operation'];
        
        if ($value > 0) {
            $methodName = $operation === 'add' ? 'add' . ucfirst($unit) : 'sub' . ucfirst($unit);
            echo "Applying: {$operation} {$value} {$unit} using method {$methodName}\n";
            $testDate = $testDate->$methodName($value);
        }
    }
    
    echo "Final result: " . $testDate->format('Y-m-d H:i:s') . "\n";
    echo "Formatted: " . $testDate->format('l, F j, Y g:i A') . "\n";
    echo "Day of week: " . $testDate->format('l') . "\n";
    
    echo "\nTest completed successfully!\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
