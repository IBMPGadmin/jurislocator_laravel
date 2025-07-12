<?php
// Fix script to update the section matching query in ViewLegalTableController.php

// Load the controller file
$controllerPath = __DIR__ . '/app/Http/Controllers/ViewLegalTableController.php';
$content = file_get_contents($controllerPath);

// Find the buildSectionSearchQuery method
$pattern = '/private function buildSectionSearchQuery\(\$tableName, \$categoryId, \$sectionId, Request \$request\).*?if \(is_numeric\(\$sectionId\)\) \{.*?return DB::table\(\$tableName\)/s';

// Replace with updated code that uses exact string comparison
$replacement = 'private function buildSectionSearchQuery($tableName, $categoryId, $sectionId, Request $request)
    {
        // Check if exact matching is requested
        $exactMatch = $request->query(\'exact_match\') === \'true\' || 
                     $request->header(\'X-Exact-Section-Match\') === \'true\';
        
        Log::info("Building search query for section_id: $sectionId in table: $tableName", [
            \'exact_match\' => $exactMatch ? \'true\' : \'false\',
            \'section_id\' => $sectionId
        ]);
        
        if ($exactMatch) {
            // For exact matching, we need to be very precise
            if (is_numeric($sectionId)) {
                // For simple numeric sections like "17", ensure we don\'t match "170"
                Log::info("Exact match for numeric section: $sectionId");
                
                // Use a direct exact string match
                $query = DB::table($tableName)';

// Apply the replacement
$updatedContent = preg_replace($pattern, $replacement, $content);

// Save the updated file
file_put_contents($controllerPath, $updatedContent);

echo "Controller file updated with exact matching fix.\n";
?>
