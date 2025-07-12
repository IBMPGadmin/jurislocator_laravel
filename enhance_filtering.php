<?php
// Script to enhance the client-side filtering in the view-legal-table-data.blade.php file

$filePath = __DIR__ . '/resources/views/view-legal-table-data.blade.php';
$fileContents = file_get_contents($filePath);

// Define the pattern for the current filtering code section
$filterPattern = '\/\/ Filter to ensure we only get exact section matches
                                const exactData = data.data.filter\(section => \{
                                    \/\/ For simple section numbers without subsections
                                    if \(sectionId.match\(\/\^\\\d\+\$\/\) && section.section\) \{
                                        \/\/ Only include exact matches \(17 should not match 170\)
                                        return section.section === sectionId;
                                    \}
                                    \/\/ For subsections like "17\(2\)"
                                    else if \(sectionId.match\(\/\^\(\\\d\+\)\\\\\(\(\\\d\+\)\\\\\)\$\/\) && section.section\) \{
                                        const parts = sectionId.match\(\/\^\(\\\d\+\)\\\\\(\(\\\d\+\)\\\\\)\$\/\);
                                        return section.section === parts\[1\] && 
                                               \(section.sub_section === parts\[2\] \|\| section.sub_section === "\(" \+ parts\[2\] \+ "\)"\);
                                    \}
                                    \/\/ For complex patterns, keep all results
                                    return true;';

// Define the enhanced filtering logic
$enhancedFilteringCode = '// Filter to ensure we only get exact section matches
                                const exactData = data.data.filter(section => {
                                    console.log(`Filtering section:`, section, `against sectionId: ${sectionId}`);
                                    
                                    // For simple section numbers without subsections
                                    if (/^\\d+$/.test(sectionId) && section.section) {
                                        // Strict equality check - convert both to strings to avoid type mismatches
                                        const isMatch = String(section.section) === String(sectionId);
                                        console.log(`Numeric section comparison: ${section.section} === ${sectionId} -> ${isMatch}`);
                                        return isMatch;
                                    }
                                    // For subsections like "17(2)"
                                    else if (/^(\\d+)\\((\\d+)\\)$/.test(sectionId) && section.section) {
                                        const parts = sectionId.match(/^(\\d+)\\((\\d+)\\)$/);
                                        const mainSection = String(parts[1]);
                                        const subSection = String(parts[2]);
                                        
                                        // Compare with both possible subsection formats
                                        const isMatch = String(section.section) === mainSection && 
                                               (String(section.sub_section) === subSection || 
                                                String(section.sub_section) === "(" + subSection + ")");
                                                
                                        console.log(`Complex section comparison: ${section.section}(${section.sub_section}) vs ${mainSection}(${subSection}) -> ${isMatch}`);
                                        return isMatch;
                                    }
                                    // For section_id field (if available)
                                    else if (section.section_id) {
                                        const isMatch = section.section_id === sectionId;
                                        console.log(`Section ID comparison: ${section.section_id} === ${sectionId} -> ${isMatch}`);
                                        return isMatch;
                                    }
                                    
                                    console.log(`No match criteria for section:`, section);
                                    return false; // No matching criteria, reject by default';

// Replace the filtering code
$updatedContents = str_replace($filterPattern, $enhancedFilteringCode, $fileContents);

// Save the updated file
file_put_contents($filePath, $updatedContents);

echo "Updated client-side filtering logic.\n";
?>
