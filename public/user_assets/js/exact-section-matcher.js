/**
 * Exact Section Matcher - Direct Fix 
 * This script implements a direct fix for section reference matching
 * by hijacking the section content request and applying strict filtering
 */

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔍 Exact Section Matcher - Direct Fix loaded');
    
    // Store the original fetch function
    const originalFetch = window.fetch;
    
    // Override the fetch function to intercept section-content requests
    window.fetch = function(url, options) {
        // Only intercept section-content requests
        if (typeof url === 'string' && url.includes('/section-content/')) {
            console.log('🔍 Intercepting section content request:', url);
            
            // Extract the section ID from the URL
            const urlParts = url.split('/');
            const sectionId = decodeURIComponent(urlParts[urlParts.length - 1].split('?')[0]);
            
            console.log(`🔍 Section ID from URL: ${sectionId}`);
            
            // Make sure options exist
            options = options || {};
            options.headers = options.headers || {};
            
            // Add exact matching headers
            options.headers['X-Exact-Section-Match'] = 'true';
            options.headers['X-Section-ID'] = sectionId;
            
            // Make the original request
            return originalFetch(url, options)
                .then(response => response.clone().json().catch(() => null)
                    .then(json => {
                        // If it's not JSON or there's no data, return original response
                        if (!json || !json.data || !Array.isArray(json.data)) {
                            return response;
                        }
                        
                        console.log(`🔍 Received ${json.data.length} sections, applying exact filtering for "${sectionId}"`);
                        
                        // Filter the data for exact section matches
                        const exactData = json.data.filter(section => {
                            // For decimal section IDs like "10.3" - include section and all its subsections
                            if (/^\d+\.\d+$/.test(sectionId) && section.section) {
                                // Match the main section exactly (10.3) OR any subsection (10.3(1)) or paragraph (10.3(1)(a))
                                if (String(section.section) === String(sectionId)) {
                                    console.log(`🔍 Comparing section: '${section.section}' with '${sectionId}' -> ✅ MATCH (exact)`);
                                    return true;
                                } else if (section.section_id && section.section_id.startsWith(sectionId + '(')) {
                                    console.log(`🔍 Comparing section_id: '${section.section_id}' with '${sectionId}' -> ✅ MATCH (subsection)`);
                                    return true;
                                }
                                console.log(`🔍 Comparing section: '${section.section}' with '${sectionId}' -> ❌ NO MATCH`);
                                return false;
                            }
                            // For numeric section IDs (e.g., "17")
                            else if (/^\d+$/.test(sectionId) && section.section) {
                                const isMatch = String(section.section) === String(sectionId);
                                console.log(`🔍 Comparing numeric section: '${section.section}' with '${sectionId}' -> ${isMatch ? '✅ MATCH' : '❌ NO MATCH'}`);
                                return isMatch;
                            }
                            // For section IDs with subsections (e.g., "17(2)")
                            else if (/^(\d+)\((\d+)\)$/.test(sectionId) && section.section) {
                                const parts = sectionId.match(/^(\d+)\((\d+)\)$/);
                                const mainSection = parts[1];
                                const subSection = parts[2];
                                
                                const isMatch = String(section.section) === String(mainSection) && 
                                             (String(section.sub_section) === String(subSection) || 
                                              String(section.sub_section) === "(" + subSection + ")");
                                console.log(`🔍 Comparing complex section: ${section.section}(${section.sub_section}) with ${mainSection}(${subSection}) -> ${isMatch ? '✅ MATCH' : '❌ NO MATCH'}`);
                                return isMatch;
                            }
                            // For exact section_id matches
                            else if (section.section_id) {
                                const isMatch = section.section_id === sectionId;
                                console.log(`🔍 Comparing section_id: '${section.section_id}' with '${sectionId}' -> ${isMatch ? '✅ MATCH' : '❌ NO MATCH'}`);
                                return isMatch;
                            }
                            
                            console.log(`🔍 No matching criteria for section:`, section);
                            return false;
                        });
                        
                        console.log(`🔍 Filtered ${json.data.length} results to ${exactData.length} exact matches`);
                        
                        // Create a new Response with the filtered data
                        const filteredJson = {
                            ...json,
                            data: exactData,
                            filtered: true,
                            original_count: json.data.length
                        };
                        
                        const filteredResponse = new Response(JSON.stringify(filteredJson), {
                            status: response.status,
                            statusText: response.statusText,
                            headers: response.headers
                        });
                        
                        return filteredResponse;
                    })
                    .catch(err => {
                        console.error('Error in section matcher:', err);
                        return response;
                    })
                );
        }
        
        // For all other requests, use the original fetch
        return originalFetch(url, options);
    };
    
    // Also add a direct fix to forcibly apply exact matching
    const forceSectionExactMatching = function() {
        // Intercept popup creation after data is fetched
        setInterval(() => {
            // Find all popups that have section 170 content when they shouldn't
            const popups = document.querySelectorAll('.reference-popup');
            
            popups.forEach(popup => {
                // Skip already processed popups
                if (popup.dataset.exactMatchApplied) return;
                
                // Mark as processed
                popup.dataset.exactMatchApplied = 'true';
                
                // Find the section reference that triggered this popup
                const refElem = popup.querySelector('.section-id');
                if (!refElem) return;
                
                const sectionId = refElem.textContent.trim();
                
                // Only apply for numeric sections
                if (!/^\d+$/.test(sectionId)) return;
                
                console.log(`🔍 Checking popup content for section ${sectionId}`);
                
                // Find all section items in the popup
                const sectionItems = popup.querySelectorAll('.section-item');
                
                sectionItems.forEach(item => {
                    // Find the title element to get the section number
                    const titleElem = item.querySelector('.section-title, h5, h4, h3');
                    if (!titleElem) return;
                    
                    const title = titleElem.textContent.trim();
                    
                    // Check if this item is for section 170 when we want section 17
                    if (sectionId === '17' && title.includes('Section 170')) {
                        console.log(`🔍 Removing incorrect section 170 from section 17 popup`);
                        item.style.display = 'none';
                    }
                    // Similar checks for other sections
                    else if (/^\d+$/.test(sectionId) && !title.includes(`Section ${sectionId}`) && title.includes(`Section ${sectionId}0`)) {
                        console.log(`🔍 Removing incorrect section ${sectionId}0 from section ${sectionId} popup`);
                        item.style.display = 'none';
                    }
                });
            });
        }, 500); // Check every 500ms
    };
    
    // Start the fix
    forceSectionExactMatching();
    
    console.log('🔍 Exact Section Matcher - Direct Fix initialization complete');
});
