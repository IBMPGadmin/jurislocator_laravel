<?php

require_once 'vendor/autoload.php';

// Simulate the Laravel application environment
$app = require_once 'bootstrap/app.php';

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\User\ToolsController;

echo "Testing ToolsController addSubtractFromDate method\n";
echo "=================================================\n\n";

try {
    // Create a mock request with form data
    $requestData = [
        'date' => '2024-07-04 13:00:00',
        'years' => '1',
        'years_operation' => 'add',
        'months' => '6',
        'months_operation' => 'add',
        'weeks' => '0',
        'weeks_operation' => 'add',
        'days' => '15',
        'days_operation' => 'subtract',
        'hours' => '2',
        'hours_operation' => 'add',
        'minutes' => '30',
        'minutes_operation' => 'subtract',
        'seconds' => '0',
        'seconds_operation' => 'add'
    ];

    // Create a request instance
    $request = Request::create('/tools/add-subtract-from-date', 'POST', $requestData);

    // Create controller instance
    $controller = new ToolsController();

    // Call the method
    $response = $controller->addSubtractFromDate($request);

    // Get the response content
    $responseData = json_decode($response->getContent(), true);

    if (isset($responseData['error'])) {
        echo "Error: " . $responseData['message'] . "\n";
    } else {
        echo "Success!\n";
        echo "Result Date: " . $responseData['result_date'] . "\n";
        echo "Formatted Date: " . $responseData['formatted_date'] . "\n";
        echo "Day of Week: " . $responseData['day_of_week'] . "\n";
    }

} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Stack trace:\n" . $e->getTraceAsString() . "\n";
}
