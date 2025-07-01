<?php
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

try {
    echo "Checking user_pinned_popups table structure:\n";
    
    if (Schema::hasTable('user_pinned_popups')) {
        echo "Table exists.\n";
        
        $columns = Schema::getColumnListing('user_pinned_popups');
        echo "Columns: " . implode(', ', $columns) . "\n";
        
        // Check if client_id column exists
        if (in_array('client_id', $columns)) {
            echo "client_id column exists.\n";
        } else {
            echo "client_id column does NOT exist.\n";
        }
        
        // Show some sample data if any
        $count = DB::table('user_pinned_popups')->count();
        echo "Row count: {$count}\n";
        
    } else {
        echo "Table does NOT exist.\n";
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
