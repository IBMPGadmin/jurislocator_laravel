<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UserLegalTableController extends Controller
{    public function show(Request $request, $clientId)
    {
        // Increase execution time limit for this specific operation
        set_time_limit(120);
        
        $client = DB::table('client_table')->where('id', $clientId)->first();        
        
        // Add a message to inform the user about the database tables
        $message = "";
        try {
            // Check if the legal_tables_master table exists
            $hasTable = DB::select("SHOW TABLES LIKE 'legal_tables_master'");
            
            if (empty($hasTable)) {
                $results = collect([]);
                $message = "The legal tables have not been set up yet. Please run the necessary migrations.";
            } else {
                // Optimized query with limit and better performance
                $query = DB::table('legal_tables_master')
                    ->select('id', 'table_name', 'act_name', 'act_id', 'law_id', 'jurisdiction_id', 'language_id', 'created_at');
                
                // Only add where clause if the column exists
                try {
                    $columns = DB::select("SHOW COLUMNS FROM legal_tables_master");
                    $columnNames = array_column($columns, 'Field');
                    
                    // Apply status filter first if available
                    if (in_array('status', $columnNames)) {
                        $query->where('status', 'active');
                    }
                    
                    // Apply filters efficiently
                    if ($request->filled('search') && in_array('act_name', $columnNames)) {
                        $query->where('act_name', 'like', '%' . $request->search . '%');
                    }
                    
                    if ($request->filled('act_id') && in_array('act_id', $columnNames)) {
                        $query->where('act_id', $request->act_id);
                    }
                    
                    if ($request->filled('law_id') && in_array('law_id', $columnNames)) {
                        $query->where('law_id', $request->law_id);
                    }
                    
                    if ($request->filled('jurisdiction_id') && in_array('jurisdiction_id', $columnNames)) {
                        $query->where('jurisdiction_id', $request->jurisdiction_id);
                    }
                    
                    // Optimized language_id filter
                    if ($request->filled('language_id') && in_array('language_id', $columnNames)) {
                        $query->where('language_id', $request->language_id);
                    }
                    
                    // Order and limit results for better performance
                    if (in_array('id', $columnNames)) {
                        $query->orderBy('id', 'desc'); // Changed to DESC for newer records first
                    }
                    
                    // Add limit to prevent timeout on large datasets
                    $query->limit(100);
                    
                } catch (\Exception $e) {
                    // If error occurs with columns, just get limited records
                    $query->limit(50);
                }

                $results = $query->get();
                $message = "Loaded " . $results->count() . " records successfully.";
            }
        } catch (\Exception $e) {
            // If any error occurs, return empty collection
            $results = collect([]);
            $message = "Error accessing the database: " . $e->getMessage();
        }        // Get reference data for mapping IDs to names
        $jurisdictions = $this->getJurisdictionMappings();
        $lawSubjects = $this->getLawSubjectMappings();
        $acts = $this->getActMappings();
        $languages = $this->getLanguageMappings();

        return view('user-legal-tables', compact('client', 'results', 'message', 'jurisdictions', 'lawSubjects', 'acts', 'languages'));
    }

    /**
     * Get jurisdiction ID to name mappings
     */
    private function getJurisdictionMappings()
    {
        try {
            return DB::table('jurisdiction')
                ->pluck('jurisdiction_name', 'jurisdiction_id')
                ->toArray();
        } catch (\Exception $e) {
            // Fallback to hardcoded values if table doesn't exist
            return [
                1 => 'Federal',
                2 => 'Alberta',
                3 => 'British Columbia',
                4 => 'Manitoba',
                5 => 'New Brunswick',
                6 => 'Newfoundland & Labrador',
                7 => 'Nova Scotia',
                8 => 'Ontario',
                9 => 'Prince Edward Island',
                10 => 'Quebec',
                11 => 'Saskatchewan',
                12 => 'Northwest Territories',
                13 => 'Nunavut',
                14 => 'Yukon'
            ];
        }
    }

    /**
     * Get law subject ID to name mappings
     */
    private function getLawSubjectMappings()
    {
        try {
            return DB::table('law_subject')
                ->pluck('law_name', 'law_id')
                ->toArray();
        } catch (\Exception $e) {
            // Fallback to hardcoded values if table doesn't exist
            return [
                1 => 'Immigration',
                2 => 'Citizenship',
                3 => 'Criminal'
            ];
        }
    }

    /**
     * Get act ID to name mappings
     */
    private function getActMappings()
    {
        try {
            return DB::table('acts')
                ->pluck('act_name', 'act_id')
                ->toArray();
        } catch (\Exception $e) {
            // Fallback to hardcoded values if table doesn't exist
            return [
                1 => 'Acts',
                2 => 'Appeal & Review Processes',
                3 => 'CaseLaw',
                4 => 'Codes',
                5 => 'Enforcement',
                6 => 'Forms',
                7 => 'Guidelines',
                8 => 'Agreements',
                9 => 'Ministerial Instructions',
                10 => 'Operational Bulletins',
                11 => 'Policies',
                12 => 'Procedures',
                13 => 'Regulations'
            ];
        }
    }

    /**
     * Get language ID to name mappings
     */
    private function getLanguageMappings()
    {
        return [
            1 => 'English',
            2 => 'French',
            3 => 'Bilingual'
        ];
    }

    /**
     * Show a legal document for user-centric session (without client association)
     */
    public function showUserDocument(Request $request, $table_name)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $category_id = $request->get('category_id');
        
        // Validate table name to prevent SQL injection
        if (!$this->isValidTableName($table_name)) {
            abort(404, 'Invalid table name');
        }
        
        // Check if table exists
        if (!DB::getSchemaBuilder()->hasTable($table_name)) {
            abort(404, 'Table not found');
        }
        
        // Get the document
        $document = DB::table($table_name)->where('id', $category_id)->first();
        
        if (!$document) {
            abort(404, 'Document not found');
        }
        
        // Get user's personal text data for this document (no client association)
        $existingTexts = \App\Models\UserTextData::where('user_id', $user->id)
            ->where('document_id', $category_id)
            ->where('table_name', $table_name)
            ->whereNull('client_id') // Personal user data
            ->get();
        
        // Get user's personal popup data for this document (no client association)
        $existingPopups = \App\Models\UserPopupData::where('user_id', $user->id)
            ->where('document_id', $category_id)
            ->where('table_name', $table_name)
            ->whereNull('client_id') // Personal user data
            ->get();
        
        return view('view-user-legal-table', compact(
            'document', 
            'table_name', 
            'category_id', 
            'existingTexts', 
            'existingPopups'
        ));
    }
    
    /**
     * Show a French legal document for user-centric session
     */
    public function showUserDocumentFrench(Request $request, $table_name)
    {
        $user = \Illuminate\Support\Facades\Auth::user();
        $category_id = $request->get('category_id');
        
        // Validate table name to prevent SQL injection
        if (!$this->isValidTableName($table_name)) {
            abort(404, 'Invalid table name');
        }
        
        // Check if table exists
        if (!DB::getSchemaBuilder()->hasTable($table_name)) {
            abort(404, 'Table not found');
        }
        
        // Get the document
        $document = DB::table($table_name)->where('id', $category_id)->first();
        
        if (!$document) {
            abort(404, 'Document not found');
        }
        
        // Get user's personal text data for this document (no client association)
        $existingTexts = \App\Models\UserTextData::where('user_id', $user->id)
            ->where('document_id', $category_id)
            ->where('table_name', $table_name)
            ->whereNull('client_id') // Personal user data
            ->get();
        
        // Get user's personal popup data for this document (no client association)
        $existingPopups = \App\Models\UserPopupData::where('user_id', $user->id)
            ->where('document_id', $category_id)
            ->where('table_name', $table_name)
            ->whereNull('client_id') // Personal user data
            ->get();
        
        return view('view-user-legal-table-french', compact(
            'document', 
            'table_name', 
            'category_id', 
            'existingTexts', 
            'existingPopups'
        ));
    }
    
    /**
     * Validate table name to prevent SQL injection
     */
    private function isValidTableName($tableName)
    {
        $allowedTables = [
            'immigration_acts', 'immigration_appeal_review_processes', 'immigration_case_laws',
            'immigration_codes', 'immigration_enforcements', 'immigration_forms',
            'immigration_guidelines', 'immigration_agreements', 'immigration_ministerial_instructions',
            'immigration_operational_bulletins', 'immigration_policies', 'immigration_procedures',
            'immigration_regulations', 'citizenship_acts', 'citizenship_appeal_review_processes',
            'citizenship_case_laws', 'citizenship_codes', 'citizenship_enforcements',
            'citizenship_forms', 'citizenship_guidelines', 'citizenship_agreements',
            'citizenship_ministerial_instructions', 'citizenship_operational_bulletins',
            'citizenship_policies', 'citizenship_procedures', 'citizenship_regulations',
            'criminal_acts', 'criminal_appeal_review_processes', 'criminal_case_laws',
            'criminal_codes', 'criminal_enforcements', 'criminal_forms',
            'criminal_guidelines', 'criminal_agreements', 'criminal_ministerial_instructions',
            'criminal_operational_bulletins', 'criminal_policies', 'criminal_procedures',
            'criminal_regulations'
        ];
        
        return in_array($tableName, $allowedTables);
    }
}
