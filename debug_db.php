<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

try {
    echo "=== Database Debug Info ===\n";
    
    // Check if irpr table exists
    $tables = DB::select("SHOW TABLES LIKE 'irpr'");
    echo "IRPR table exists: " . (count($tables) > 0 ? "YES" : "NO") . "\n";
    
    if (count($tables) > 0) {
        // Check if record with id=1 exists
        $record = DB::table('irpr')->where('id', 1)->first();
        echo "Record with id=1 exists: " . ($record ? "YES" : "NO") . "\n";
        
        if ($record) {
            echo "Record title: " . ($record->title ?? 'N/A') . "\n";
            echo "Record has text_content: " . (!empty($record->text_content) ? "YES" : "NO") . "\n";
        }
        
        // Check total records in irpr
        $count = DB::table('irpr')->count();
        echo "Total records in irpr: $count\n";
        
        // Check first few records
        $firstRecords = DB::table('irpr')->limit(3)->get();
        echo "First 3 records:\n";
        foreach ($firstRecords as $i => $record) {
            echo "  Record " . ($i+1) . ": ID=" . $record->id . ", Title=" . ($record->title ?? 'N/A') . "\n";
        }
    }
    
    // Check legal_tables_master
    echo "\n=== Legal Tables Master ===\n";
    $legalTables = DB::table('legal_tables_master')->limit(10)->get();
    foreach ($legalTables as $table) {
        echo "ID: {$table->id}, Table: {$table->table_name}, Title: " . ($table->title ?? 'N/A') . "\n";
    }
    
    // Check if legaldocument1 exists and has data
    echo "\n=== Legal Document 1 Table ===\n";
    $doc1Tables = DB::select("SHOW TABLES LIKE 'legaldocument1'");
    echo "legaldocument1 table exists: " . (count($doc1Tables) > 0 ? "YES" : "NO") . "\n";
    
    if (count($doc1Tables) > 0) {
        $count = DB::table('legaldocument1')->count();
        echo "Total records in legaldocument1: $count\n";
        
        $firstRecord = DB::table('legaldocument1')->where('id', 1)->first();
        echo "Record with id=1 exists: " . ($firstRecord ? "YES" : "NO") . "\n";
        if ($firstRecord) {
            echo "Title: " . ($firstRecord->title ?? 'N/A') . "\n";
            echo "Has text_content: " . (!empty($firstRecord->text_content) ? "YES" : "NO") . "\n";
        }
    }
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
