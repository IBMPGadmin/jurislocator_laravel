<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UpdateLegalTablesWithLanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            // Check if the legal_tables_master table exists
            $hasTable = DB::select("SHOW TABLES LIKE 'legal_tables_master'");
            
            if (empty($hasTable)) {
                Log::info('legal_tables_master table does not exist');
                return;
            }
            
            // Check if language_id column exists
            $columns = DB::select("SHOW COLUMNS FROM legal_tables_master");
            $columnNames = array_column($columns, 'Field');
            
            if (!in_array('language_id', $columnNames)) {
                Log::info('language_id column does not exist in legal_tables_master table');
                return;
            }
            
            // Count total records
            $totalRecords = DB::table('legal_tables_master')->count();
            Log::info("Total records in legal_tables_master: {$totalRecords}");
            
            // Update records with different language values
            $records = DB::table('legal_tables_master')->get();
            $count = 1;
            
            foreach ($records as $record) {
                $languageId = ($count % 3) + 1; // Alternating between 1, 2, and 3
                
                DB::table('legal_tables_master')
                    ->where('id', $record->id)
                    ->update(['language_id' => (string)$languageId]);
                
                $count++;
            }
            
            Log::info('Updated language_id values for all records in legal_tables_master');
        } catch (\Exception $e) {
            Log::error('Error updating language_id values: ' . $e->getMessage());
        }
    }
}
