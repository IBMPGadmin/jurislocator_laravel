<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\UserTextData;
use App\Models\UserPopupData;

class UserDocumentController extends Controller
{
    /**
     * Show legal document for user-centric mode (English)
     */
    public function show(Request $request, $tableName)
    {
        // User-centric mode - no session check needed anymore
        $categoryId = $request->query('category_id');
        
        try {
            // Check if the table exists
            $tableExists = DB::select("SHOW TABLES LIKE ?", [$tableName]);
            
            if (empty($tableExists)) {
                return redirect()->route('user.legal-tables')->with('error', 'Document table not found.');
            }

            // Get document content
            $documents = DB::table($tableName)
                ->where('id', $categoryId)
                ->get();

            if ($documents->isEmpty()) {
                return redirect()->route('user.legal-tables')->with('error', 'Document not found.');
            }

            $document = $documents->first();

            // Get user-specific text data
            $userTextData = UserTextData::getOrCreateForUser(
                auth()->id(),
                $tableName,
                $categoryId
            );

            // Get user-specific popup data
            $userPopupData = UserPopupData::getOrCreateForUser(
                auth()->id(),
                $tableName,
                $categoryId
            );

            // Get document structure (columns)
            $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
            $columnNames = array_column($columns, 'Field');

            return view('view-legal-table-data', compact(
                'document',
                'tableName',
                'categoryId',
                'columnNames',
                'userTextData',
                'userPopupData'
            ));

        } catch (\Exception $e) {
            return redirect()->route('user.legal-tables')->with('error', 'Error loading document: ' . $e->getMessage());
        }
    }

    /**
     * Show legal document for user-centric mode (French)
     */
    public function showFrench(Request $request, $tableName)
    {
        // User-centric mode - no session check needed anymore
        $categoryId = $request->query('category_id');
        
        try {
            // Check if the table exists
            $tableExists = DB::select("SHOW TABLES LIKE ?", [$tableName]);
            
            if (empty($tableExists)) {
                return redirect()->route('user.legal-tables')->with('error', 'Document table not found.');
            }

            // Get document content
            $documents = DB::table($tableName)
                ->where('id', $categoryId)
                ->get();

            if ($documents->isEmpty()) {
                return redirect()->route('user.legal-tables')->with('error', 'Document not found.');
            }

            $document = $documents->first();

            // Get user-specific text data
            $userTextData = UserTextData::getOrCreateForUser(
                auth()->id(),
                $tableName,
                $categoryId
            );

            // Get user-specific popup data
            $userPopupData = UserPopupData::getOrCreateForUser(
                auth()->id(),
                $tableName,
                $categoryId
            );

            // Get document structure (columns)
            $columns = DB::select("SHOW COLUMNS FROM {$tableName}");
            $columnNames = array_column($columns, 'Field');

            return view('view-legal-table-french', compact(
                'document',
                'tableName',
                'categoryId',
                'columnNames',
                'userTextData',
                'userPopupData'
            ));

        } catch (\Exception $e) {
            return redirect()->route('user.legal-tables')->with('error', 'Error loading document: ' . $e->getMessage());
        }
    }
}
