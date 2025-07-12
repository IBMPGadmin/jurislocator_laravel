<?php
// Fix for exact section matching in ViewLegalTableController

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class SectionMatchingFix
{
    /**
     * Apply the fix to ensure exact matching for numeric section IDs
     * 
     * @param string $tableName The database table name
     * @param int $categoryId The category ID
     * @param string $sectionId The section ID to match
     * @param Request $request The HTTP request
     * @return \Illuminate\Database\Query\Builder
     */
    public static function buildExactSectionQuery($tableName, $categoryId, $sectionId, Request $request)
    {
        // Simple numeric sections like "17" need special handling
        if (is_numeric($sectionId)) {
            Log::info("Using super exact match for numeric section: $sectionId");
            
            // Use a stricter query for numeric sections - using a direct equality comparison
            return DB::table($tableName)
                ->where('category_id', $categoryId)
                ->where(function($q) use ($sectionId) {
                    // This ensures that section "17" does not match "170", "171", etc.
                    $q->where('section', $sectionId)
                      ->orWhere('section_id', $sectionId);
                });
        }
        
        return null; // Return null if no special handling needed
    }
}
