<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserTextData;
use App\Models\UserPopupData;
use App\Models\User;

class TestUserDocumentController extends Controller
{
    /**
     * Test the user document logic without authentication
     */
    public function testShow(Request $request, $user, $tableName)
    {
        // Convert to integer if it's a string ID
        $userId = is_numeric($user) ? (int)$user : $user;
        
        $categoryId = $request->query('category_id', 1);
        $searchQuery = $request->query('search');
        
        // Verify user exists in users table (not client table)
        $userModel = User::find($userId);
        if (!$userModel) {
            return response()->json(['error' => 'User not found', 'user_id' => $userId]);
        }
        
        try {
            // Check if the legal document table exists
            $tableExists = DB::select("SHOW TABLES LIKE '{$tableName}'");
            
            if (empty($tableExists)) {
                return response()->json(['error' => 'Table not found', 'table' => $tableName]);
            }

            // Get the specific legal document content
            $query = DB::table($tableName);
            
            if ($categoryId) {
                $query->where('id', $categoryId);
            }
            
            $documents = $query->paginate(15);

            if ($documents->isEmpty() && $categoryId) {
                return response()->json(['error' => 'Document not found', 'category_id' => $categoryId, 'table' => $tableName]);
            }

            // For single document view, get the first document
            $document = $categoryId ? $documents->first() : null;

            // Get legal table metadata
            $legalTable = DB::table('legal_tables_master')
                ->where('id', $categoryId)
                ->first();

            return response()->json([
                'success' => true,
                'user_id' => $userId,
                'table_name' => $tableName,
                'category_id' => $categoryId,
                'document_found' => !is_null($document),
                'legal_table_found' => !is_null($legalTable),
                'documents_count' => $documents->count(),
                'document_title' => $document->title ?? 'N/A'
            ]);

        } catch (\Exception $e) {
            return response()->json(['error' => 'Exception: ' . $e->getMessage()]);
        }
    }
}
