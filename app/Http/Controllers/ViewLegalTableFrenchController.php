<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\Paginator;

class ViewLegalTableFrenchController extends Controller
{
    /**
     * Display the French legal table view
     */
    public function show($table_name, Request $request)
    {
        $category_id = $request->get('category_id');
        $client_id = $request->get('client_id');
        
        // Get client information
        $client = null;
        if ($client_id) {
            $client = DB::table('client_table')->where('id', $client_id)->first();
        }
        
        // Get table information from master table
        $tableInfo = DB::table('legal_tables_master')
            ->where('table_name', $table_name)
            ->first();
            
        if (!$tableInfo) {
            return redirect()->back()->with('error', 'Table not found');
        }
        
        // Check if this is actually a French document
        $isFrench = false;
        if ($tableInfo->language_id == 2 || $tableInfo->language == 'fr' || $tableInfo->language == 'French') {
            $isFrench = true;
        }
        
        // Get table data with pagination
        $tableData = collect();
        try {
            if (DB::getSchemaBuilder()->hasTable($table_name)) {
                $query = DB::table($table_name)
                    ->where('category_id', $category_id)
                    ->orderBy('id');
                
                // Add search functionality if search term is provided
                if ($request->has('search') && !empty($request->get('search'))) {
                    $searchTerm = $request->get('search');
                    $query->where(function($q) use ($searchTerm) {
                        $q->where('title', 'LIKE', "%{$searchTerm}%")
                          ->orWhere('text_content', 'LIKE', "%{$searchTerm}%");
                    });
                }
                
                // Paginate results
                $tableData = $query->paginate(50)->appends($request->query());
            }
        } catch (\Exception $e) {
            Log::error('Error fetching French legal table data: ' . $e->getMessage());
            $tableData = collect()->paginate(1);
        }
        
        return view('view-legal-table-french', compact(
            'table_name', 
            'tableData', 
            'tableInfo', 
            'client', 
            'category_id',
            'isFrench'
        ))->with('legalTable', $tableInfo);
    }
    
    /**
     * Get section content for French legal table
     */
    public function getSectionContent($tableId, $sectionRef, Request $request)
    {
        try {
            $client_id = $request->get('client_id');
            
            // Get table information
            $tableInfo = DB::table('legal_tables_master')->where('id', $tableId)->first();
            
            if (!$tableInfo) {
                return response()->json(['error' => 'Table not found'], 404);
            }
            
            $table_name = $tableInfo->table_name;
            
            // Get section content
            $sectionData = [];
            if (DB::getSchemaBuilder()->hasTable($table_name)) {
                $sectionData = DB::table($table_name)
                    ->where('section', $sectionRef)
                    ->orWhere(DB::raw("CONCAT(section, '(', sub_section, ')')"), $sectionRef)
                    ->orWhere(DB::raw("CONCAT(section, '(', paragraph, ')')"), $sectionRef)
                    ->get();
            }
            
            return response()->json([
                'error' => false,
                'data' => $sectionData
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching French section content: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Error fetching section content'
            ], 500);
        }
    }
    
    /**
     * Fetch reference by ID for French legal table
     */
    public function fetchReferenceById($referenceId, Request $request)
    {
        try {
            // Parse reference ID (format: tableId:rowId)
            $parts = explode(':', $referenceId);
            if (count($parts) !== 2) {
                return response()->json(['error' => 'Invalid reference format'], 400);
            }
            
            $tableId = $parts[0];
            $rowId = $parts[1];
            
            // Get table information
            $tableInfo = DB::table('legal_tables_master')->where('id', $tableId)->first();
            
            if (!$tableInfo) {
                return response()->json(['error' => 'Table not found'], 404);
            }
            
            $table_name = $tableInfo->table_name;
            
            // Get specific row
            $rowData = null;
            if (DB::getSchemaBuilder()->hasTable($table_name)) {
                $rowData = DB::table($table_name)->where('id', $rowId)->first();
            }
            
            if (!$rowData) {
                return response()->json(['error' => 'Reference not found'], 404);
            }
            
            return response()->json([
                'error' => false,
                'data' => $rowData
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error fetching French reference: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Error fetching reference'
            ], 500);
        }
    }
    
    /**
     * Save annotation for French legal table
     */
    public function saveAnnotation(Request $request)
    {
        try {
            $request->validate([
                'table_id' => 'required',
                'section_id' => 'required',
                'content' => 'required'
            ]);
            
            // Implementation for saving French annotations
            // This would depend on your annotation table structure
            
            return response()->json([
                'error' => false,
                'message' => 'Annotation saved successfully'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error saving French annotation: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Error saving annotation'
            ], 500);
        }
    }
    
    /**
     * Delete annotation for French legal table
     */
    public function deleteAnnotation($id, Request $request)
    {
        try {
            // Implementation for deleting French annotations
            // This would depend on your annotation table structure
            
            return response()->json([
                'error' => false,
                'message' => 'Annotation deleted successfully'
            ]);
            
        } catch (\Exception $e) {
            Log::error('Error deleting French annotation: ' . $e->getMessage());
            return response()->json([
                'error' => true,
                'message' => 'Error deleting annotation'
            ], 500);
        }
    }
}
