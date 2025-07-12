<?php

namespace App\Http\Controllers;

use App\Helpers\LegalReferenceHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ViewLegalTableController extends Controller
{
    public function show(Request $request)
    {
        $tableName = $request->table;
        $categoryId = $request->category_id;
        $client_id = $request->client_id;
        
        // Get client information - allow null client for user-centric mode
        $client = null;
        if ($client_id) {
            $client = DB::table('client_table')->where('id', $client_id)->first();
            
            // Verify client belongs to current user
            if ($client && $client->user_id != Auth::id()) {
                return redirect()->back()->with('error', 'Access denied to this client.');
            }
        }
        
        // Get metadata about this legal table
        $metadata = null;
        $legalTable = null;
        try {
            $metadata = DB::table('legal_tables_master')
                ->where('id', $categoryId)
                ->first();
                
            // Also assign to legalTable for compatibility with the view
            $legalTable = $metadata;
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Unable to find legal table metadata.');
        }
        
        // Validate table name to prevent SQL injection
        if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
            return redirect()->back()->with('error', 'Invalid table name.');
        }
        
        // Check if table exists
        $tableData = [];
        $columns = [];
        $error = null;
        
        try {
            // Check if table exists
            $exists = Schema::hasTable($tableName);
            
            if ($exists) {
                // Get all columns from the table
                $columns = Schema::getColumnListing($tableName);
                
                // Execute the query to get all data with pagination
                $tableData = DB::table($tableName)->paginate(15); // 15 items per page
                
                // Get user's annotations if user is authenticated
                $annotations = [];
                if (Auth::check()) {
                    $userId = Auth::id();
                    $annotations = DB::table('juris_user_texts')
                        ->where('user_id', $userId)
                        ->where('category_id', $categoryId)
                        ->get()
                        ->keyBy('section_id');
                }
            } else {
                $error = "The table '$tableName' does not exist in the database.";
            }
        } catch (\Exception $e) {
            $error = "Error accessing the table: " . $e->getMessage();
        }
        
        return view('view-legal-table-data', compact(
            'client', 
            'metadata',
            'legalTable',
            'tableName', 
            'tableData', 
            'columns', 
            'error',
            'annotations',
            'categoryId'
        ));
    }
    
    /**
     * Get the lowest (most specific) identifier from a row
     * 
     * @param object $row The row to analyze
     * @return string|null The lowest identifier found
     */
    private function getLowestIdentifier($row)
    {
        if (!empty($row->sub_paragraph)) return $row->sub_paragraph;
        if (!empty($row->paragraph)) return $row->paragraph;
        if (!empty($row->sub_section)) return $row->sub_section;
        if (!empty($row->section)) return $row->section;
        if (!empty($row->sub_division)) return $row->sub_division;
        return null;
    }    /**
     * Get content for a specific section - updated implementation based on legacy logic
     */
    public function getSectionContent(Request $request, $tableId, $sectionRef)
    {
        try {
            // Log the request details including headers for exact matching
            $exactMatch = $request->query('exact_match') === 'true' || 
                         $request->header('X-Exact-Section-Match') === 'true';
            $exactSectionId = $request->header('X-Section-ID');
            
            Log::info("Section content request for tableId=$tableId, sectionRef=$sectionRef", [
                'exact_match' => $exactMatch ? 'true' : 'false',
                'exact_section_id' => $exactSectionId,
                'headers' => $request->headers->all(),
                'query_params' => $request->query()
            ]);
            
            // Get table info from legal_tables_master
            $tableInfo = DB::table('legal_tables_master')
                ->where('id', $tableId)
                ->first();
                
            if (!$tableInfo) {
                Log::warning("Table not found for ID: $tableId");                
                return $this->jsonResponse(['error' => true, 'message' => 'Table not found'], 404);
            }
            
            Log::info("Found table: " . $tableInfo->table_name);
            $currentTable = $tableInfo->table_name;
            $actNames = array_filter([
                $tableInfo->act_name_1 ?? null,
                $tableInfo->act_name_2 ?? null,
                $tableInfo->act_name_3 ?? null,
            ]);
            
            $sections = [];
            $categoryId = $tableId;
            $sectionId = $sectionRef;
            
            // Get the current document table name from the request (new parameter)
            $currentDocumentTable = $request->input('current_document_table', null);
            $currentDocumentCategoryId = $request->input('current_document_category_id', null);
            
            // Log if we have current document context
            if ($currentDocumentTable && $currentDocumentCategoryId) {
                Log::info("Received current document context: table=$currentDocumentTable, categoryId=$currentDocumentCategoryId");
            }
            
            // First check if the reference exists in the current document (if provided)
            if ($currentDocumentTable && $currentDocumentTable !== $currentTable && 
                $currentDocumentCategoryId && preg_match('/^[a-zA-Z0-9_]+$/', $currentDocumentTable)) {
                
                Log::info("Checking current document table first: $currentDocumentTable");
                
                // Build the search query for the current document table
                $currentDocQuery = $this->buildSectionSearchQuery(
                    $currentDocumentTable, 
                    $currentDocumentCategoryId, 
                    $sectionId, 
                    $request
                );
                
                // Execute the query
                $currentDocRows = $currentDocQuery->get();
                
                // If we found matching content in the current document
                if ($currentDocRows->isNotEmpty()) {
                    Log::info("Found " . count($currentDocRows) . " matching rows in current document");
                    
                    foreach ($currentDocRows as $row) {
                        // Add meta information
                        $row->lowest_identifier = $this->getLowestIdentifier($row);
                        $row->from_current_document = 1;
                        $row->source_table = $currentDocumentTable;
                        $row->category_id = $currentDocumentCategoryId;
                        
                        // Add a note that this is from current document
                        // $row->title = ($row->title ?? '') . ' [Current Document]'; // Remove this line
                        
                        // Process content to make references clickable
                        if (isset($row->text_content)) {
                            $row->text_content = LegalReferenceHelper::processContent(
                                $row->text_content, 
                                $currentDocumentCategoryId, 
                                $sectionId
                            );
                        }
                        
                        // Always use hierarchical title for popup
                        $row->title = $this->buildHierarchicalTitle($row);
                        
                        $sections[] = $row;
                    }
                    
                    // Return the results from current document
                    return $this->jsonResponse(['error' => false, 'data' => $sections]);
                }
                
                Log::info("No matches found in current document, continuing with normal search flow");
            }
            
            // Continue with the regular search logic...
            // Check if this is a cross-act reference (contains Act or Rules name in parentheses)
            if (preg_match('/^([^(]+)\(([^)]+(?:Act|Rules)[^)]*)\)$/i', $sectionId, $matches)) {
                $sectionIdPart = trim($matches[1]); // e.g., '2(1)'
                $actName = trim($matches[2]); // e.g., 'Immigration and Refugee Protection Act'
                
                // Search for act/rules name in legal_tables_master
                $actQuery = DB::table('legal_tables_master')
                    ->where(function($query) use ($actName) {
                        $query->where('act_name_1', 'like', "%$actName%")
                              ->orWhere('act_name_2', 'like', "%$actName%")
                              ->orWhere('act_name_3', 'like', "%$actName%");
                    })
                    ->where('id', '!=', $categoryId)
                    ->orderByRaw(
                        "CASE 
                            WHEN act_name_1 = ? THEN 1
                            WHEN act_name_2 = ? THEN 2
                            WHEN act_name_3 = ? THEN 3
                            WHEN act_name_1 LIKE ? THEN 4
                            WHEN act_name_2 LIKE ? THEN 5
                            WHEN act_name_3 LIKE ? THEN 6
                            ELSE 7
                        END", 
                        [$actName, $actName, $actName, "%$actName%", "%$actName%", "%$actName%"]
                    )
                    ->limit(1);
                
                $actRow = $actQuery->first();
                
                if ($actRow) {
                    // Found the referenced act, now search its table
                    $refTable = $actRow->table_name;
                    $actCategoryId = $actRow->id;
                    
                    // Validate table name to prevent SQL injection
                    if (!preg_match('/^[a-zA-Z0-9_]+$/', $refTable)) {
                        return $this->jsonResponse(['error' => true, 'message' => 'Invalid table name'], 400);
                    }
                    
                    // Check if table exists
                    if (!Schema::hasTable($refTable)) {
                        return $this->jsonResponse(['error' => true, 'message' => 'Referenced table does not exist'], 404);
                    }
                    
                    // Query the referenced table
                    $refQuery = DB::table($refTable)
                        ->where('category_id', $actCategoryId)
                        ->where(function($query) use ($sectionIdPart) {
                            $query->where('section_id', $sectionIdPart)
                                  ->orWhere('section_id', 'like', $sectionIdPart.'.%')
                                  ->orWhere('section_id', 'like', $sectionIdPart.'%');
                        })
                        ->orderByRaw(
                            "CASE 
                                WHEN section_id = ? THEN 1
                                WHEN section_id LIKE ? THEN 2
                                ELSE 3
                            END", 
                            [$sectionIdPart, $sectionIdPart.'.%']
                        )
                        ->limit(10);
                    
                    $refRows = $refQuery->get();
                    
                    foreach ($refRows as $row) {
                        // Add meta information
                        $row->lowest_identifier = $this->getLowestIdentifier($row);
                        $row->from_other_category = 1;
                        $row->source_table = $refTable;
                        
                        // Always use hierarchical title for popup
                        $row->title = $this->buildHierarchicalTitle($row);
                        
                        // Add the act name to the title
                        // $row->title = ($row->title ?? '') . ' [' . $actName . ']'; // Remove this line
                        
                        // Add the category ID explicitly
                        $row->category_id = $actCategoryId;
                        
                        // Process content to make references clickable if needed
                        if (isset($row->text_content)) {
                            $row->text_content = LegalReferenceHelper::processContent($row->text_content, $actCategoryId, $sectionIdPart);
                        }
                        
                        $sections[] = $row;
                    }
                    
                    if (!empty($sections)) {
                        // Found sections in the referenced act
                        return $this->jsonResponse(['error' => false, 'data' => $sections]);
                    } else {
                        // Act exists but section not found
                        return $this->jsonResponse([
                            'error' => false, 
                            'data' => [[
                                'act_reference_found' => true,
                                'act_id' => $actRow->id,
                                'table_name' => $actRow->table_name,
                                'act_name' => $actName,
                                'section_searched' => $sectionIdPart,
                                'act_names' => array_filter([
                                    $actRow->act_name_1,
                                    $actRow->act_name_2,
                                    $actRow->act_name_3
                                ]),
                                'title' => 'Reference to ' . $actName,
                                'text_content' => 'Section ' . $sectionIdPart . ' not found in ' . $actName . '. Click to browse this document.',
                                'section_id' => $sectionIdPart,
                                'category_id' => $actRow->id
                            ]]
                        ]);
                    }
                } else {
                    // Referenced act not found
                    return $this->jsonResponse([
                        'error' => false, 
                        'data' => [[
                            'error' => true,
                            'title' => 'Reference Not Found',
                            'text_content' => 'Could not find "' . $actName . '" in the legal database.',
                            'section_id' => $sectionId,
                            'category_id' => $categoryId
                        ]]
                    ]);
                }
            }
            
            // Regular search in current table (not a cross-act reference)
            // Validate table name to prevent SQL injection
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $currentTable)) {
                return $this->jsonResponse(['error' => true, 'message' => 'Invalid table name'], 400);
            }
            
            // Check if table exists
            if (!Schema::hasTable($currentTable)) {
                return $this->jsonResponse(['error' => true, 'message' => 'Table does not exist'], 404);
            }
            
            // Use our refactored method to build the search query
            $query = $this->buildSectionSearchQuery($currentTable, $categoryId, $sectionId, $request);
            
            // Log the SQL query for debugging
            $sql = $query->toSql();
            $bindings = $query->getBindings();
            Log::info("Executing query: $sql with bindings: " . json_encode($bindings));
            
            // Add raw SQL reconstruction for easier debugging
            $rawSql = str_replace(['?'], array_map(function($binding) {
                return is_numeric($binding) ? $binding : "'" . $binding . "'";
            }, $bindings), $sql);
            Log::info("Raw SQL equivalent: $rawSql");
              
            $rows = $query->get();
            Log::info("Found " . count($rows) . " rows");
            
            // If no rows found, return a clear error message
            if ($rows->isEmpty()) {
                Log::warning("No rows found for section reference: $sectionId");
                return $this->jsonResponse([
                    'error' => false,
                    'data' => [
                        [
                            'title' => 'No Content Found',
                            'text_content' => "No content found for reference: $sectionId. Please check the reference and try again.",
                            'section_id' => $sectionId,
                            'category_id' => $categoryId,
                            'debug_info' => [
                                'section_id' => $sectionId,
                                'query_type' => 'refactored'
                            ]
                        ]
                    ]
                ]);
            }
            
            foreach ($rows as $row) {
                // Add meta information
                $row->lowest_identifier = $this->getLowestIdentifier($row);
                $row->from_other_category = 0;
                $row->source_table = $currentTable;
                // Build hierarchical title for popup
                $row->title = $this->buildHierarchicalTitle($row);
                // Process content to make references clickable if needed
                if (isset($row->text_content)) {
                    $row->text_content = LegalReferenceHelper::processContent($row->text_content, $categoryId, $sectionId);
                }
                $sections[] = $row;
            }
            
            // Remove duplicates
            $uniqueSections = [];
            $seenCombinations = [];
            
            foreach ($sections as $section) {
                $key = ($section->section_id ?? '') . '_' . ($section->category_id ?? '');
                if (!in_array($key, $seenCombinations)) {
                    $seenCombinations[] = $key;
                    $uniqueSections[] = $section;
                }
            }
            
            // Ensure all required fields exist in each section (similar to your PHP code)
            foreach ($uniqueSections as &$section) {
                // Make sure these fields always exist, even if empty
                foreach (['title', 'text_content', 'section_id', 'category_id'] as $field) {
                    if (!property_exists($section, $field) || $section->$field === null) {
                        $section->$field = '';
                    }
                }
            }
            
            // Return results
            return $this->jsonResponse(['error' => false, 'data' => $uniqueSections]);
        } catch (\Exception $e) {
            Log::error("Error in getSectionContent: " . $e->getMessage());
            return $this->jsonResponse(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Save or update an annotation
     */
    public function saveAnnotation(Request $request)
    {
        if (!Auth::check()) {
            return $this->jsonResponse(['error' => 'User not authenticated'], 401);
        }
        
        $request->validate([
            'section_id' => 'required|string',
            'category_id' => 'required|integer',
            'note_text' => 'required|string',
        ]);
        
        $userId = Auth::id();
        $sectionId = $request->section_id;
        $categoryId = $request->category_id;
        $noteText = $request->note_text;
        
        try {
            // Check if annotation already exists
            $existing = DB::table('juris_user_texts')
                ->where('user_id', $userId)
                ->where('category_id', $categoryId)
                ->where('section_id', $sectionId)
                ->first();
                
            if ($existing) {
                // Update existing annotation
                DB::table('juris_user_texts')
                    ->where('id', $existing->id)
                    ->update([
                        'note_text' => $noteText,
                        'updated_at' => now()
                    ]);
                    
                return $this->jsonResponse([
                    'success' => true,
                    'message' => 'Annotation updated successfully',
                    'id' => $existing->id
                ]);
            } else {
                // Create new annotation
                $id = DB::table('juris_user_texts')->insertGetId([
                    'user_id' => $userId,
                    'category_id' => $categoryId,
                    'section_id' => $sectionId,
                    'note_text' => $noteText,
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
                
                return $this->jsonResponse([
                    'success' => true,
                    'message' => 'Annotation saved successfully',
                    'id' => $id
                ]);
            }
        } catch (\Exception $e) {
            return $this->jsonResponse([
                'success' => false,
                'message' => 'Error saving annotation: ' . $e->getMessage()
            ], 500);
        }
    }
    
    /**
     * Delete an annotation
     */
    public function deleteAnnotation(Request $request, $id)
    {
        if (!Auth::check()) {
            return $this->jsonResponse(['error' => 'User not authenticated'], 401);
        }
        
        $userId = Auth::id();
        
        try {
            // Verify the annotation belongs to the user
            $annotation = DB::table('juris_user_texts')
                ->where('id', $id)
                ->where('user_id', $userId)
                ->first();
                
            if (!$annotation) {
                return $this->jsonResponse(['error' => 'Annotation not found or access denied'], 404);
            }
            
            // Delete the annotation
            DB::table('juris_user_texts')
                ->where('id', $id)
                ->delete();
                
            return $this->jsonResponse([
                'success' => true,
                'message' => 'Annotation deleted successfully'
            ]);
        } catch (\Exception $e) {
            return $this->jsonResponse([
                'success' => false,
                'message' => 'Error deleting annotation: ' . $e->getMessage()
            ], 500);
        }
    }
      /**
     * Simplified method to fetch reference content by direct ID
     */
    public function fetchReferenceById($referenceId)
    {
        try {
            Log::info('Reference fetch request for ID: ' . $referenceId);
            
            // Parse the reference ID to extract table and row information
            // Format: table_id:row_id or just row_id (using default table)
            $parts = explode(':', $referenceId);
            
            if (count($parts) > 1) {
                $tableId = $parts[0];
                $rowId = $parts[1];
            } else {
                // If no table specified, use the row ID directly
                $rowId = $parts[0];
                // Get the active table from session or use a default
                $tableId = session('active_table_id', null);
            }
            
            Log::info("Parsed reference: tableId=$tableId, rowId=$rowId");
            
            if (!$tableId) {
                Log::warning('No table specified and no active table found');
                return $this->jsonResponse(['error' => true, 'message' => 'No table specified and no active table found'], 400);
            }
            
            // Get the table name from legal_tables_master
            $tableInfo = DB::table('legal_tables_master')
                ->where('id', $tableId)
                ->first();
                
            if (!$tableInfo) {
                Log::warning("Table not found for ID: $tableId");
                return $this->jsonResponse(['error' => true, 'message' => 'Table not found'], 404);
            }
            
            $tableName = $tableInfo->table_name;
            Log::info("Found table: $tableName");
            
            // Validate table name to prevent SQL injection
            if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
                Log::warning("Invalid table name: $tableName");
                return $this->jsonResponse(['error' => true, 'message' => 'Invalid table name'], 400);
            }
            
            // Direct lookup by row ID (much simpler than the complex search)
            $row = DB::table($tableName)
                ->where('id', $rowId)
                ->first();
                
            if (!$row) {
                Log::warning("Row not found: $rowId in table $tableName");
                return $this->jsonResponse(['error' => true, 'message' => 'Reference not found'], 404);
            }
            
            Log::info("Found row data: " . json_encode($row));
            
            // Process any references in the content
            if (isset($row->text_content)) {
                // Get the section ID for context when processing references
                $sectionId = $row->section_id ?? null;
                if (!$sectionId && isset($row->section)) {
                    // Build section ID from components if not directly available
                    $sectionId = $row->section;
                    if (!empty($row->sub_section)) {
                        $sectionId .= '(' . $row->sub_section . ')';
                    }
                    if (!empty($row->paragraph)) {
                        $sectionId .= '(' . $row->paragraph . ')';
                    }
                    if (!empty($row->sub_paragraph)) {
                        $sectionId .= '(' . $row->sub_paragraph . ')';
                    }
                }
                
                $row->text_content = LegalReferenceHelper::processContent($row->text_content, $tableId, $sectionId);
            }
            
            // Add metadata for display
            $row->source_table = $tableName;
            $row->table_id = $tableId;
            
            // Build a more complete title if possible
            $title = $this->buildHierarchicalTitle($row);
            
            // Get the content, with fallbacks for different column names
            $content = $row->text_content ?? ($row->section_text ?? ($row->content ?? 'No content available'));
            
            $response = [
                'error' => false, 
                'data' => [
                    'title' => $title,
                    'content' => $content,
                    'section_id' => $row->section_id ?? null,
                    'metadata' => [
                        'part' => $row->part ?? null,
                        'division' => $row->division ?? null,
                        'sub_division' => $row->sub_division ?? null,
                        'section' => $row->section ?? null,
                        'sub_section' => $row->sub_section ?? null,
                        'paragraph' => $row->paragraph ?? null,
                        'sub_paragraph' => $row->sub_paragraph ?? null
                    ]
                ]
            ];
            
            Log::info('Sending response: ' . json_encode($response));
            return $this->jsonResponse($response);
            
        } catch (\Exception $e) {
            Log::error('Error in fetchReferenceById: ' . $e->getMessage());
            return $this->jsonResponse(['error' => true, 'message' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Build query for searching sections
     * 
     * @param string $tableName The table name to search in
     * @param int $categoryId The category ID
     * @param string $sectionId The section ID reference
     * @param Request $request The request object for additional context
     * @return \Illuminate\Database\Query\Builder
     */
    private function buildSectionSearchQuery($tableName, $categoryId, $sectionId, Request $request)
    {
        // Check if exact matching is requested
        $exactMatch = $request->query('exact_match') === 'true' || 
                     $request->header('X-Exact-Section-Match') === 'true';
        
        Log::info("Building search query for section_id: $sectionId in table: $tableName", [
            'exact_match' => $exactMatch ? 'true' : 'false',
            'section_id' => $sectionId
        ]);
        
        if ($exactMatch) {
            // For exact matching, we need to be very precise
            if (is_numeric($sectionId)) {
                // For simple numeric sections like "17", ensure we don't match "170"
                Log::info("Exact match for numeric section: $sectionId");
                
                // Use a more direct approach to match only exact numbers
                $query = DB::table($tableName)
                    ->where('category_id', $categoryId)
                    ->where(function($q) use ($sectionId) {
                        // For MySQL we can use binary comparison to ensure exact match
                        $q->whereRaw("BINARY section = ?", [$sectionId])
                          ->orWhereRaw("BINARY section_id = ?", [$sectionId]);
                    });
            } 
            // For decimal section IDs like "10.3" - include section and all its subsections
            else if (preg_match('/^\d+\.\d+$/', $sectionId)) {
                Log::info("Exact match for decimal section: $sectionId (including subsections)");
                
                $query = DB::table($tableName)
                    ->where('category_id', $categoryId)
                    ->where(function($q) use ($sectionId) {
                        // Match the exact section
                        $q->whereRaw("BINARY section = ?", [$sectionId])
                          // Or match section_id exactly
                          ->orWhereRaw("BINARY section_id = ?", [$sectionId])
                          // Or match subsections that start with this section ID followed by a parenthesis
                          ->orWhere('section_id', 'like', $sectionId.'(%');
                    });
            }
            // For section IDs with subsections like "17(2)"
            else if (preg_match('/^(\d+)\((\d+)\)$/', $sectionId, $matches)) {
                $mainSection = $matches[1];
                $subSection = $matches[2];
                
                Log::info("Exact match for section with subsection: $mainSection($subSection)");
                
                $query = DB::table($tableName)
                    ->where('category_id', $categoryId)
                    ->where(function($q) use ($mainSection, $subSection, $sectionId) {
                        $q->where(function($sq) use ($mainSection, $subSection) {
                              $sq->whereRaw('CAST(section AS CHAR(255)) = ?', [$mainSection])
                                 ->where(function($ssq) use ($subSection) {
                                     $ssq->where('sub_section', $subSection)
                                         ->orWhere('sub_section', "($subSection)");
                                 });
                          })
                          ->orWhere('section_id', $sectionId);
                    });
            }
            // For complex section IDs
            else {
                Log::info("Exact match for complex section ID: $sectionId");
                $query = DB::table($tableName)
                    ->where('category_id', $categoryId)
                    ->where('section_id', $sectionId);
            }
        } 
        // Default behavior - partial matching for backward compatibility
        else {
            $query = DB::table($tableName)
                ->where('category_id', $categoryId)
                ->where(function($q) use ($sectionId) {
                    $q->where('section_id', $sectionId)
                      ->orWhere('section_id', 'like', $sectionId.'.%')
                      ->orWhere('section_id', 'like', $sectionId.'%');
                })
                ->orderByRaw(
                    "CASE 
                        WHEN section_id = ? THEN 1
                        WHEN section_id LIKE ? THEN 2
                        ELSE 3
                    END", 
                    [$sectionId, $sectionId.'.%']
                );
        }
        
        // Always add a limit to avoid too many results
        $query->limit(10);
        
        // Log the SQL query for debugging
        $sql = $query->toSql();
        $bindings = $query->getBindings();
        Log::info("Built query: $sql with bindings: " . json_encode($bindings));
        
        // Execute query and log results
        $results = $query->get();
        Log::info("Query returned " . count($results) . " results");
        
        if (count($results) > 0 && $exactMatch) {
            // For exact matching, log the section values of results for debugging
            $sections = $results->pluck('section')->toArray();
            Log::info("Returned section values: " . json_encode($sections));
        }
        
        return $query;
    }
    
    /**
     * Handle the request and ensure proper JSON response
     * 
     * This is a helper method to make sure all responses from controller actions
     * are properly formatted as JSON with correct headers
     * 
     * @param mixed $data The data to return
     * @param int $status HTTP status code
     * @return \Illuminate\Http\JsonResponse
     */
    private function jsonResponse($data, $status = 200)
    {
        // Ensure the data has the expected structure for errors
        if (!isset($data['error']) && $status >= 400) {
            $data = [
                'error' => true,
                'message' => is_string($data) ? $data : (isset($data['message']) ? $data['message'] : 'Unknown error'),
                'status' => $status
            ];
        }
        
        // Always include a request_id for debugging
        $data['request_id'] = uniqid();
        
        return response()->json($data, $status, [
            'Content-Type' => 'application/json',
            'Cache-Control' => 'no-cache, no-store, must-revalidate',
        ]);
    }
    
    /**
     * Build a hierarchical title for a section (e.g., Part 1 Division 1 Section 14.1(1))
     *
     * @param object $row
     * @return string
     */
    private function buildHierarchicalTitle($row)
    {
        $parts = [];
        if (!empty($row->part)) $parts[] = 'Part ' . $row->part;
        if (!empty($row->division)) $parts[] = 'Division ' . $row->division;
        if (!empty($row->sub_division)) $parts[] = 'Subdivision ' . $row->sub_division;
        if (!empty($row->section_id)) {
            $parts[] = 'Section ' . $row->section_id;
        } elseif (!empty($row->section)) {
            $section = 'Section ' . $row->section;
            if (!empty($row->sub_section)) $section .= '(' . $row->sub_section . ')';
            if (!empty($row->paragraph)) $section .= '(' . $row->paragraph . ')';
            if (!empty($row->sub_paragraph)) $section .= '(' . $row->sub_paragraph . ')';
            $parts[] = $section;
        }
        return implode(' ', $parts);
    }
}
