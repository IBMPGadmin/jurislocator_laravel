<?php
// Script to add comprehensive debug logging to the frontend

$filePath = __DIR__ . '/resources/views/view-legal-table-data.blade.php';
$fileContents = file_get_contents($filePath);

// Add debug logging at the beginning of the fetch response processing
$pattern = 'fetch\(`/section-content/\${tableId}/\${encodeURIComponent\(sectionId\)}\?exact_match=true`, \{
                        headers: \{
                            \'X-Exact-Section-Match\': \'true\',
                            \'X-Section-ID\': sectionId
                        \}
                    \}\)
                        .then\(response => response.json\(\)\)
                        .then\(data => \{';

$replacement = 'fetch(`/section-content/${tableId}/${encodeURIComponent(sectionId)}?exact_match=true`, {
                        headers: {
                            \'X-Exact-Section-Match\': \'true\',
                            \'X-Section-ID\': sectionId
                        }
                    })
                        .then(response => response.json())
                        .then(data => {
                            console.group(`Section Popup Debug: ${sectionId}`);
                            console.log(`API Response for section ${sectionId}:`, data);
                            console.log(`Response contains ${data.data ? data.data.length : 0} items`);';

// After filtering, add a log for filtered results
$filterPattern = 'console.log\(`Filtered \${data.data.length\} results to \${exactData.length\} exact matches for section \${sectionId\}`\);';

$filterReplacement = 'console.log(`Filtered ${data.data.length} results to ${exactData.length} exact matches for section ${sectionId}`);
                                
                                // Detailed logging of filtered results
                                if (exactData.length > 0) {
                                    console.log(`Filtered results:`, exactData);
                                } else {
                                    console.warn(`No exact matches found for section ${sectionId}`);
                                }
                                console.groupEnd();';

// Replace in the file content
$updatedContents = str_replace($pattern, $replacement, $fileContents);
$updatedContents = str_replace($filterPattern, $filterReplacement, $updatedContents);

// Save the updated file
file_put_contents($filePath, $updatedContents);

echo "Added comprehensive debug logging.\n";
?>
