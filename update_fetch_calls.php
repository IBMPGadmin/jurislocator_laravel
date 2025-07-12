<?php
// Script to update all fetch calls in the view-legal-table-data.blade.php file

$filePath = __DIR__ . '/resources/views/view-legal-table-data.blade.php';
$fileContents = file_get_contents($filePath);

// Pattern to match the fetch calls
$pattern = '/fetch\(`\/section-content\/\$\{tableId\}\/\$\{encodeURIComponent\(sectionId\)\}\?exact_match=true`\)/';

// Replacement with headers
$replacement = 'fetch(`/section-content/${tableId}/${encodeURIComponent(sectionId)}?exact_match=true`, {
                        headers: {
                            \'X-Exact-Section-Match\': \'true\',
                            \'X-Section-ID\': sectionId
                        }
                    })';

// Replace all occurrences
$updatedContents = preg_replace($pattern, $replacement, $fileContents);

// Save the updated file
file_put_contents($filePath, $updatedContents);

echo "Updated " . substr_count($updatedContents, $replacement) . " fetch calls.\n";
?>
