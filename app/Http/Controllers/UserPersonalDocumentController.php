<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\UserTextData;
use App\Models\UserPopupData;
use App\Models\User;

class UserPersonalDocumentController extends Controller
{
    /**
     * Show legal document for personal research (user-centric only)
     * Checks user_id from users table, NOT client_id
     */
    public function show(Request $request, $user, $tableName)
    {
        // Convert to integer if it's a string ID
        $userId = is_numeric($user) ? (int)$user : $user;
        
        // Check authorization - user can only view their own documents
        if (auth()->id() != $userId) {
            \Log::warning('Unauthorized access attempt', [
                'auth_id' => auth()->id(),
                'requested_user_id' => $userId
            ]);
            abort(403, 'Unauthorized access');
        }

        // Log AJAX request detection
        $isAjax = $request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest';
        \Log::info('UserPersonalDocumentController Request', [
            'is_ajax' => $isAjax,
            'headers' => $request->headers->all(),
            'method' => $request->method(),
            'url' => $request->url(),
            'query_params' => $request->query->all()
        ]);

        $categoryId = $request->query('category_id');
        $searchQuery = $request->query('search');
        
        // Verify user exists in users table (not client table)
        $userModel = User::find($userId);
        if (!$userModel) {
            return redirect()->route('user.legal-tables')->with('error', 'User not found.');
        }
        
        try {
            // Check if the legal document table exists
            $tableExists = DB::select("SHOW TABLES LIKE '{$tableName}'");
            
            if (empty($tableExists)) {
                return redirect()->route('user.legal-tables')
                    ->with('error', 'Legal document table not found.');
            }

            // Get the legal document content - similar to client-centric approach
            $query = DB::table($tableName);
            
            \Log::info('User Personal Document Query Debug', [
                'table_name' => $tableName,
                'category_id' => $categoryId,
                'user_id' => $userId,
                'table_exists' => !empty($tableExists)
            ]);
            
            // Apply search filter if provided
            if (!empty($searchQuery)) {
                $query->where(function($q) use ($searchQuery) {
                    $q->where('text_content', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('title', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('section', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('section_reference', 'LIKE', "%{$searchQuery}%");
                });
            }
            
            // Get all data with pagination - just like the client-centric version
            $documents = $query->paginate(15);
            
            // Check if this is an AJAX request for pagination
            if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                // For AJAX requests, prepare all variables needed by the view
                $tableData = $documents; // The view expects 'tableData'
                
                // Get user-specific text data (NO client_id, only user_id)
                $userTextData = UserTextData::getOrCreateForUser(
                    $userId, 
                    $tableName, 
                    $categoryId ?? 0  // Use 0 as fallback if no category
                );

                // Get user-specific popup data (NO client_id, only user_id)
                $userPopupData = UserPopupData::getOrCreateForUser(
                    $userId, 
                    $tableName, 
                    $categoryId ?? 0  // Use 0 as fallback if no category
                );

                // Get document table structure
                $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
                $columnNames = array_column($columns, 'Field');

                // Get legal table metadata for compatibility with view
                $legalTable = null;
                $metadata = null;
                try {
                    $legalTable = DB::table('legal_tables_master')
                        ->where('id', $categoryId)
                        ->first();
                    $metadata = $legalTable; // Alias for compatibility
                } catch (\Exception $e) {
                    \Log::warning('Could not load legal table metadata: ' . $e->getMessage());
                }

                $annotations = []; // User annotations (empty for now)
                
                $html = view('view-legal-table-data-personal', compact(
                    'documents', // For search results  
                    'tableData', // Renamed for view compatibility
                    'tableName',
                    'categoryId',
                    'columnNames',
                    'columns',
                    'userTextData',
                    'userPopupData',
                    'userId',
                    'searchQuery',
                    'legalTable', // Required by view
                    'metadata', // Required by view
                    'annotations' // Required by view
                ) + ['user' => $userModel])->render();
                
                return response($html);
            }
            
            \Log::info('User Personal Document Results', [
                'documents_count' => $documents->count(),
                'total' => $documents->total(),
                'current_page' => $documents->currentPage(),
                'has_data' => !$documents->isEmpty()
            ]);

            if ($documents->isEmpty()) {
                // Only show error if we were searching but found nothing
                if (!empty($searchQuery)) {
                    return redirect()->route('user.personal.document.view', ['user' => $userId, 'tableName' => $tableName])
                        ->with('error', 'No documents found matching your search criteria.');
                }
                // If no search and no documents, this might be an empty table
            }

            // For single document view, get the first document (if any)
            $document = $documents->first();

            // Get user-specific text data (NO client_id, only user_id)
            $userTextData = null;
            $userPopupData = null;
            
            // For compatibility, we can provide these even without categoryId
            $userTextData = UserTextData::getOrCreateForUser(
                $userId, 
                $tableName, 
                $categoryId ?? 0  // Use 0 as fallback if no category
            );

            // Get user-specific popup data (NO client_id, only user_id)
            $userPopupData = UserPopupData::getOrCreateForUser(
                $userId, 
                $tableName, 
                $categoryId ?? 0  // Use 0 as fallback if no category
            );

            // Get document table structure
            $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
            $columnNames = array_column($columns, 'Field');

            // Get legal table metadata for compatibility with view
            $legalTable = null;
            $metadata = null;
            try {
                $legalTable = DB::table('legal_tables_master')
                    ->where('id', $categoryId)
                    ->first();
                $metadata = $legalTable; // Alias for compatibility
            } catch (\Exception $e) {
                \Log::warning('Could not load legal table metadata: ' . $e->getMessage());
            }

            // For compatibility with the view, rename variables
            $tableData = $documents; // The view expects 'tableData'
            $annotations = []; // User annotations (empty for now)

            // Return the correct personal view file
            return view('view-legal-table-data-personal', compact(
                'document',
                'documents', // For search results  
                'tableData', // Renamed for view compatibility
                'tableName',
                'categoryId',
                'columnNames',
                'columns',
                'userTextData',
                'userPopupData',
                'userId',
                'searchQuery',
                'legalTable', // Required by view
                'metadata', // Required by view
                'annotations' // Required by view
            ) + ['user' => $userModel]);

        } catch (\Exception $e) {
            \Log::error('User Personal Document Error: ' . $e->getMessage());
            return redirect()->route('user.legal-tables')
                ->with('error', 'Error loading document: ' . $e->getMessage());
        }
    }

    /**
     * Show French legal document for personal research (user-centric only)
     */
    public function showFrench(Request $request, $user, $tableName)
    {
        // Convert to integer if it's a string ID
        $userId = is_numeric($user) ? (int)$user : $user;
        
        // Verify user access (user can only view their own documents)
        if (auth()->id() != $userId) {
            abort(403, 'Unauthorized access');
        }

        $categoryId = $request->query('category_id');
        $searchQuery = $request->query('search');
        
        // Verify user exists in users table (not client table)
        $userModel = User::find($userId);
        if (!$userModel) {
            return redirect()->route('login')->with('error', 'User not found.');
        }
        
        try {
            // Check if the legal document table exists
            $tableExists = DB::select("SHOW TABLES LIKE '{$tableName}'");
            
            if (empty($tableExists)) {
                return redirect()->route('user.legal-tables')
                    ->with('error', 'Legal document table not found.');
            }

            // Get the legal document content - similar to client-centric approach
            $query = DB::table($tableName);
            
            // Apply search filter if provided
            if (!empty($searchQuery)) {
                $query->where(function($q) use ($searchQuery) {
                    $q->where('text_content', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('title', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('section', 'LIKE', "%{$searchQuery}%")
                      ->orWhere('section_reference', 'LIKE', "%{$searchQuery}%");
                });
            }
            
            // Get all data with pagination - just like the client-centric version
            $documents = $query->paginate(15);

            // Check if this is an AJAX request for pagination
            if ($request->ajax() || $request->wantsJson() || $request->header('X-Requested-With') === 'XMLHttpRequest') {
                // For AJAX requests, prepare all variables needed by the view
                $tableData = $documents; // The view expects 'tableData'
                
                // Get user-specific text data (NO client_id, only user_id)
                $userTextData = null;
                $userPopupData = null;
                
                if ($categoryId) {
                    $userTextData = UserTextData::getOrCreateForUser(
                        $userId, 
                        $tableName, 
                        $categoryId
                    );

                    // Get user-specific popup data (NO client_id, only user_id)
                    $userPopupData = UserPopupData::getOrCreateForUser(
                        $userId, 
                        $tableName, 
                        $categoryId
                    );
                }

                // Get document table structure
                $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
                $columnNames = array_column($columns, 'Field');

                // Get legal table metadata for compatibility with view
                $legalTable = null;
                $metadata = null;
                try {
                    $legalTable = DB::table('legal_tables_master')
                        ->where('id', $categoryId)
                        ->first();
                    $metadata = $legalTable; // Alias for compatibility
                } catch (\Exception $e) {
                    \Log::warning('Could not load legal table metadata: ' . $e->getMessage());
                }

                $annotations = []; // User annotations (empty for now)
                $document = $categoryId ? $documents->first() : null;
                
                $html = view('view-legal-table-data-personal', compact(
                    'document',
                    'documents', // For search results
                    'tableData', // Renamed for view compatibility
                    'tableName',
                    'categoryId',
                    'columnNames',
                    'columns',
                    'userTextData',
                    'userPopupData',
                    'userId',
                    'searchQuery',
                    'legalTable', // Required by view
                    'metadata', // Required by view
                    'annotations' // Required by view
                ) + ['user' => $userModel])->render();
                
                return response($html);
            }

            if ($documents->isEmpty() && $categoryId) {
                return redirect()->route('user.legal-tables')
                    ->with('error', 'Legal document not found.');
            }

            // For single document view, get the first document
            $document = $categoryId ? $documents->first() : null;

            // Get user-specific text data (NO client_id, only user_id)
            $userTextData = null;
            $userPopupData = null;
            
            if ($categoryId) {
                $userTextData = UserTextData::getOrCreateForUser(
                    $userId, 
                    $tableName, 
                    $categoryId
                );

                // Get user-specific popup data (NO client_id, only user_id)
                $userPopupData = UserPopupData::getOrCreateForUser(
                    $userId, 
                    $tableName, 
                    $categoryId
                );
            }

            // Get document table structure
            $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
            $columnNames = array_column($columns, 'Field');

            // Get legal table metadata for compatibility with view
            $legalTable = null;
            $metadata = null;
            try {
                $legalTable = DB::table('legal_tables_master')
                    ->where('id', $categoryId)
                    ->first();
                $metadata = $legalTable; // Alias for compatibility
            } catch (\Exception $e) {
                \Log::warning('Could not load legal table metadata: ' . $e->getMessage());
            }

            // For compatibility with the view, rename variables
            $tableData = $documents; // The view expects 'tableData'
            $annotations = []; // User annotations (empty for now)

            // Return the same personal view file as English (supports both languages)
            return view('view-legal-table-data-personal', compact(
                'document',
                'documents', // For search results
                'tableData', // Renamed for view compatibility
                'tableName',
                'categoryId',
                'columnNames',
                'columns',
                'userTextData',
                'userPopupData',
                'userId',
                'searchQuery',
                'legalTable', // Required by view
                'metadata', // Required by view
                'annotations' // Required by view
            ) + ['user' => $userModel]);

        } catch (\Exception $e) {
            \Log::error('User Personal Document French Error: ' . $e->getMessage());
            return redirect()->route('user.legal-tables')
                ->with('error', 'Error loading French document: ' . $e->getMessage());
        }
    }

    /**
     * Get document content for AJAX requests (user-centric)
     */
    public function getDocumentContent(Request $request, $tableName, $sectionRef)
    {
        $userId = Auth::id();
        
        try {
            // Verify user exists
            $user = User::find($userId);
            if (!$user) {
                return response()->json(['error' => 'User not found'], 401);
            }

            // Get section content from the legal document table
            $content = DB::table($tableName)
                ->where('section_reference', $sectionRef)
                ->first();

            if (!$content) {
                return response()->json(['error' => 'Section not found'], 404);
            }

            return response()->json([
                'success' => true,
                'content' => $content,
                'user_id' => $userId
            ]);

        } catch (\Exception $e) {
            \Log::error('Get Document Content Error: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to load content'], 500);
        }
    }
}
