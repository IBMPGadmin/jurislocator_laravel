/**
 * Last Resort Section Filter
 * This script applies filtering at the DOM level to ensure only exact section matches are displayed
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 Last Resort Section Filter loaded');
    
    // Create MutationObserver to watch for popups being added to the DOM
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList' && mutation.addedNodes.length > 0) {
                // Look for added popups
                mutation.addedNodes.forEach(function(node) {
                    if (node.nodeType === Node.ELEMENT_NODE) {
                        // Check if this is a popup or contains popups
                        const popups = node.classList && node.classList.contains('reference-popup') ? 
                            [node] : node.querySelectorAll('.reference-popup');
                        
                        if (popups.length > 0) {
                            popups.forEach(filterPopupContent);
                        }
                    }
                });
            }
        });
    });
    
    // Start observing the body for added popups
    observer.observe(document.body, {
        childList: true,
        subtree: true
    });
    
    /**
     * Filter popup content to only show sections that exactly match the requested section
     */
    function filterPopupContent(popup) {
        // Skip already processed popups
        if (popup.dataset.exactMatchApplied) return;
        
        // Get the requested section ID from the popup
        const sectionIdElement = popup.querySelector('.section-id') || 
                                popup.querySelector('[data-section-id]');
        
        if (!sectionIdElement) {
            console.log('🔍 Could not find section ID in popup');
            return;
        }
        
        // Get the section ID
        const sectionId = sectionIdElement.textContent?.trim() || 
                        sectionIdElement.dataset?.sectionId;
        
        if (!sectionId) {
            console.log('🔍 No section ID found in element:', sectionIdElement);
            return;
        }
        
        console.log(`🔍 Filtering popup content for section ${sectionId}`);
        
        // Find all section items in the popup
        const sectionItems = popup.querySelectorAll('.section-item');
        
        if (sectionItems.length === 0) {
            console.log('🔍 No section items found in popup');
            return;
        }
        
        console.log(`🔍 Found ${sectionItems.length} section items in popup`);
        
        // Track which items should be kept
        const keepItems = [];
        
        // For decimal section IDs like "10.3" - include section and all its subsections
        if (/^\d+\.\d+$/.test(sectionId)) {
            console.log(`🔍 Detected decimal section ${sectionId}, including subsections`);
            
            // First pass - check each section item 
            sectionItems.forEach(function(item, index) {
                const titleElem = item.querySelector('.section-title, h3, h4, h5');
                if (!titleElem) {
                    console.log(`🔍 No title element found in section item ${index}`);
                    return;
                }
                
                const title = titleElem.textContent.trim();
                console.log(`🔍 Section item ${index} title: "${title}"`);
                
                // Check for exact match to "Section X.Y" (with word boundary)
                if (new RegExp(`\\bSection\\s+${sectionId}\\b`, 'i').test(title)) {
                    console.log(`🔍 Exact match found for section ${sectionId} in item ${index}`);
                    keepItems.push(item);
                }
                // Check for subsections like "Section 10.3(1)" when looking for "Section 10.3"
                else if (new RegExp(`\\bSection\\s+${sectionId}\\(`, 'i').test(title)) {
                    console.log(`🔍 Subsection match found for section ${sectionId} in item ${index}`);
                    keepItems.push(item);
                }
                // Check for a non-related section (e.g., "Section 10.30" when looking for "Section 10.3")
                else if (new RegExp(`\\bSection\\s+${sectionId}\\d+\\b`, 'i').test(title)) {
                    console.log(`🔍 Non-exact match found, hiding item ${index} with title "${title}"`);
                    item.style.display = 'none';
                }
            });
        }
        // For numeric section IDs, we need to be extremely strict
        else if (/^\d+$/.test(sectionId)) {
            // First pass - check each section item and mark those that exactly match
            sectionItems.forEach(function(item, index) {
                const titleElem = item.querySelector('.section-title, h3, h4, h5');
                if (!titleElem) {
                    console.log(`🔍 No title element found in section item ${index}`);
                    return;
                }
                
                const title = titleElem.textContent.trim();
                console.log(`🔍 Section item ${index} title: "${title}"`);
                
                // Check for exact match to "Section X" (with word boundary)
                if (new RegExp(`\\bSection\\s+${sectionId}\\b`, 'i').test(title)) {
                    console.log(`🔍 Exact match found for section ${sectionId} in item ${index}`);
                    keepItems.push(item);
                }
                // Check for a non-exact match like "Section 170" when looking for "Section 17"
                else if (new RegExp(`\\bSection\\s+${sectionId}\\d+\\b`, 'i').test(title)) {
                    console.log(`🔍 Non-exact match found, hiding item ${index} with title "${title}"`);
                    item.style.display = 'none';
                }
            });
            
            // If we found exact matches, hide everything else
            if (keepItems.length > 0) {
                console.log(`🔍 Found ${keepItems.length} exact matches, hiding all others`);
                
                // Hide all items that aren't in our keep list
                sectionItems.forEach(function(item) {
                    if (!keepItems.includes(item)) {
                        item.style.display = 'none';
                    }
                });
            }
        }
        
        // Mark as processed to avoid reprocessing
        popup.dataset.exactMatchApplied = 'true';
    }
    
    console.log('🔍 Last Resort Section Filter initialized');
});
