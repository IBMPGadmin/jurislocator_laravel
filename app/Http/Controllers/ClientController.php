<?php

namespace App\Http\Controllers;
use App\Models\Client;

use App\Models\LegalDocument;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

class ClientController extends Controller
{    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_status' => 'required|in:Active,Inactive',
        ]);        try {
            // Create a new client
            $client = Client::create([
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'client_status' => $request->client_status,
                'user_id' => Auth::id(),
                'last_accessed' => now(),
            ]);

            return redirect()->route('user.dashboard')
                ->with('success', 'Client added successfully!');
        } catch (\Exception $e) {
            // Log the error
            \Illuminate\Support\Facades\Log::error('Error adding client: ' . $e->getMessage());
            
            return redirect()->route('user.dashboard')
                ->with('error', 'Failed to add client. Please try again.');
        }
    }

    public function selectClient(Request $request)
    {
        $request->validate([
            'client_id' => 'required|exists:client_table,id'
        ]);

        $client = Client::where('id', $request->client_id)
                       ->where('user_id', Auth::id())
                       ->first();

        if (!$client) {
            return redirect()->route('client.management')
                ->with('error', 'Client not found or access denied.');
        }

        // Update last accessed time
        $client->update(['last_accessed' => now()]);

        // Set client session for client-centric mode
        session(['selected_client_id' => $request->client_id]);

        // Redirect to client-centric legal tables
        return redirect()->route('user.client.legal-tables', $client->id);
    }

    public function home()
    {
        // Always redirect to user dashboard for home
        return redirect()->route('user.dashboard');
        
        // Default to client-centric mode - show client selection
        return view('home');
    }

    public function selectClientForTemplate()
    {
        $user_id = Auth::id();
        $clients = Client::where('user_id', $user_id)
                        ->orderBy('last_accessed', 'desc')
                        ->get();
        
        return view('select-client-template', compact('clients'));
    }

    // Existing viewTemplates method
    public function viewTemplates($client_id = null)
    {
        // If no client_id provided, redirect to client selection page
        if (!$client_id) {
            return redirect()->route('templates.select-client');
        }
        
        // Find the client
        $client = Client::find($client_id);
        
        // If client not found or doesn't belong to current user
        if (!$client || $client->user_id != Auth::id()) {
            return redirect()->route('templates.select-client')
                ->with('error', 'Invalid client selection. Please try again.');
        }
        
        // Update last accessed
        $client->last_accessed = now();
        $client->save();
        
        return view('templates', compact('client'));
    }

    public function viewLegalTable($id, Request $request)
    {
        $legalTable = LegalDocument::findOrFail($id);
        
        // Get client info if client_id provided
        $client = null;
        if ($request->has('client_id')) {
            $client = Client::find($request->client_id);
        }
        
        // Get the table data with pagination
        $query = \Illuminate\Support\Facades\DB::table($legalTable->table_name);
        
        // Apply search filter if provided
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function($q) use ($searchTerm) {
                $q->where('text_content', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('title', 'LIKE', "%{$searchTerm}%")
                  ->orWhere('section', 'LIKE', "%{$searchTerm}%");
            });
        }
        
        // Get column info
        $columns = \Illuminate\Support\Facades\Schema::getColumnListing($legalTable->table_name);
        $tableData = $query->paginate(50);
        
        // Process the content to make references clickable
        $tableData->getCollection()->transform(function ($item) {
            if (isset($item->text_content)) {
                $item->text_content = $this->makeReferencesClickable($item->text_content);
            }
            return $item;
        });
        
        return view('view-legal-table-data', compact('legalTable', 'tableData', 'columns', 'client'));
    }

    public function getSectionContent($tableId, $sectionRef)
    {
        try {
            // Find the legal table
            $legalTable = LegalDocument::findOrFail($tableId);
            $tableName = $legalTable->table_name;
            
            // Decode the section reference
            $sectionRef = urldecode($sectionRef);
            
            // Query the table for the section
            $query = \Illuminate\Support\Facades\DB::table($tableName);
            
            // Check if section reference is a simple section number or complex reference
            if (preg_match('/^\d+(\.\d+)?$/', $sectionRef)) {
                // Simple section number
                $query->where('section', $sectionRef);
            } else if (preg_match('/^(\d+(\.\d+)?)\(([^)]+)\)/', $sectionRef, $matches)) {
                // Section with subsection like 123(4)
                $query->where('section', $matches[1])
                      ->where('sub_section', $matches[3]);
            } else {
                // Try to match the exact reference
                $query->where(function($q) use ($sectionRef) {
                    $q->where('section', $sectionRef)
                      ->orWhere('text_content', 'LIKE', "%{$sectionRef}%");
                });
            }
            
            $results = $query->get();
            
            if ($results->isEmpty()) {
                return response()->json(['content' => null]);
            }
            
            // Build the content from results
            $content = "<div class='section-reference-content'>";
            foreach ($results as $row) {
                if (!empty($row->title)) {
                    $content .= "<h5 class='mt-3'>{$row->title}</h5>";
                }
                
                if (!empty($row->text_content)) {
                    $processedContent = $this->makeReferencesClickable($row->text_content);
                    $content .= "<div class='text-content'>{$processedContent}</div>";
                }
                
                if (!empty($row->footnote)) {
                    $content .= "<div class='footnote mt-2'><em>{$row->footnote}</em></div>";
                }
                
                $content .= "<hr>";
            }
            $content .= "</div>";
            
            return response()->json(['content' => $content]);
        } catch (\Exception $e) {
            return response()->json([
                'content' => "<div class='alert alert-danger'>Error: {$e->getMessage()}</div>"
            ]);
        }
    }

    private function makeReferencesClickable($text)
    {
        if (empty($text)) {
            return $text;
        }
        
        // Pattern 1: Simple section references like "section 123"
        $text = preg_replace(
            '/\b(section|sections)\s+(\d+(?:\.\d+)?)\b/i',
            '<span class="ref" data-section-id="$2">$1 $2</span>',
            $text
        );
        
        // Pattern 2: References with parentheses like "paragraph (a)" or "subsection (2)"
        $text = preg_replace_callback(
            '/\b(paragraph|paragraphs|subsection|subsections)\s+\(([a-z0-9\.]+)\)(?:\s+or\s+\(([a-z0-9\.]+)\))?/i',
            function($matches) {
                $result = '<span class="ref" data-section-id="(' . $matches[2] . ')">'. $matches[1] . ' (' . $matches[2] . ')</span>';
                
                if (isset($matches[3])) {
                    $result .= ' or <span class="ref" data-section-id="(' . $matches[3] . ')">(' . $matches[3] . ')</span>';
                }
                
                return $result;
            },
            $text
        );
        
        // Pattern 3: Complex section references like "123(4)" or "123.4(5)(a)"
        $text = preg_replace(
            '/\b(\d+(?:\.\d+)?(?:\([^)]+\)){1,4})\b(?!\s*\([a-z](?:\.\d+)?\))(?![^<>]*<\/span>)/i',
            '<span class="ref" data-section-id="$1">$1</span>',
            $text
        );
        
        return $text;
    }

    // Client management page - Updated to support legal tables with optional client selection
    public function legalTables(Request $request)
    {
        // Increase execution time limit for this specific operation
        set_time_limit(120);
        
        $user = Auth::user();
        $client = null;
        
        // Get all clients for dropdown selection
        $allClients = Client::where('user_id', $user->id)->orderBy('last_accessed', 'desc')->get();
        
        // Check if a client_id is provided in the request
        if ($request->has('client_id') && $request->client_id) {
            $client = Client::where('id', $request->client_id)
                           ->where('user_id', $user->id)
                           ->first();
            
            if ($client) {
                // Update last accessed time
                $client->update(['last_accessed' => now()]);
                // Store client session for client-centric mode
                session(['selected_client_id' => $client->id, 'session_mode' => 'client']);
            }
        } else {
            // Clear any existing client session when no client is selected
            session()->forget(['selected_client_id', 'session_mode']);
        }
        
        // Get search parameters
        $search = $request->input('search');
        $language_id = $request->input('language_id');
        $jurisdiction_id = $request->input('jurisdiction_id');
        $law_id = $request->input('law_id');
        $act_id = $request->input('act_id');
        
        // Initialize results and message
        $results = collect([]);
        $message = "";
        
        try {
            // Check if the legal_tables_master table exists
            $hasTable = DB::select("SHOW TABLES LIKE 'legal_tables_master'");
            
            if (empty($hasTable)) {
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
                    
                    // Apply search filters
                    if ($search && in_array('act_name', $columnNames)) {
                        $query->where('act_name', 'like', '%' . $search . '%');
                    }
                    
                    if ($act_id && in_array('act_id', $columnNames)) {
                        $query->where('act_id', $act_id);
                    }
                    
                    if ($law_id && in_array('law_id', $columnNames)) {
                        $query->where('law_id', $law_id);
                    }
                    
                    if ($jurisdiction_id && in_array('jurisdiction_id', $columnNames)) {
                        $query->where('jurisdiction_id', $jurisdiction_id);
                    }
                    
                    if ($language_id && in_array('language_id', $columnNames)) {
                        $query->where('language_id', $language_id);
                    }
                    
                    // Order and limit results for better performance
                    if (in_array('id', $columnNames)) {
                        $query->orderBy('id', 'desc');
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
            $message = "Error accessing the database: " . $e->getMessage();
        }
        
        // Get reference data for mapping IDs to names
        $jurisdictions = $this->getJurisdictionMappings();
        $lawSubjects = $this->getLawSubjectMappings();
        $acts = $this->getActMappings();
        $languages = $this->getLanguageMappings();

        // Load saved content based on context
        $savedContent = null;
        if ($client) {
            // Try to load client-specific content first, fallback to user content
            $savedContent = \App\Models\Content::where('user_id', $user->id)
                ->where('client_id', $client->id)
                ->where('context', 'client')
                ->latest()
                ->first();
            
            // If no client-specific content found, load user content as fallback
            if (!$savedContent) {
                $savedContent = \App\Models\Content::where('user_id', $user->id)
                    ->where('context', 'user')
                    ->whereNull('client_id')
                    ->latest()
                    ->first();
            }
        } else {
            // Load user-specific content only
            $savedContent = \App\Models\Content::where('user_id', $user->id)
                ->where('context', 'user')
                ->whereNull('client_id')
                ->latest()
                ->first();
        }

        return view('user-legal-tables', compact('client', 'allClients', 'results', 'message', 'jurisdictions', 'lawSubjects', 'acts', 'languages', 'savedContent'));
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

    // Client management page
    public function index()
    {
        return view('client-management');
    }
    
    // API method to get user's clients
    public function getClients(Request $request)
    {
        try {
            $clients = Client::where('user_id', Auth::id())
                ->orderBy('last_accessed', 'desc')
                ->orderBy('created_at', 'desc')
                ->get();

            return response()->json([
                'success' => true,
                'clients' => $clients
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching clients: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Error fetching clients'
            ], 500);
        }
    }
    
    // API method to create a client (for AJAX requests)
    public function storeApi(Request $request)
    {
        // Validate the request
        $request->validate([
            'client_name' => 'required|string|max:255',
            'client_email' => 'required|email|max:255',
            'client_status' => 'required|in:Active,Inactive',
        ]);

        try {
            // Create a new client
            $client = Client::create([
                'client_name' => $request->client_name,
                'client_email' => $request->client_email,
                'client_status' => $request->client_status,
                'user_id' => Auth::id(),
                'last_accessed' => now(),
            ]);

            return response()->json([
                'success' => true,
                'message' => 'Client created successfully!',
                'client' => $client
            ]);
        } catch (\Exception $e) {
            Log::error('Error creating client via API: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to create client. Please try again.'
            ], 500);
        }
    }
}
