/**
 * Fix for exact section matching in API calls
 * This patch enhances the fetchAndDisplayPopup function to add strict section matching
 */

// Find the fetchAndDisplayPopup function
const originalScript = document.querySelector('script[src*="script.js"]');
if (originalScript) {
  // Create a new script element to fix the issue
  const fixScript = document.createElement('script');
  fixScript.type = 'text/javascript';
  fixScript.innerHTML = `
    // Override the fetchAndDisplayPopup function with a fixed version
    function fetchAndDisplayPopup(sectionId, categoryId, mouseX, mouseY, actName) {
      // Skip if no section ID
      if (!sectionId) {
        console.error("No section ID provided");
        return;
      }

      // Create a unique key for this popup
      const popupKey = categoryId + '-' + sectionId;
      
      // Check if this popup is already open
      if (openedPopups.has(popupKey)) {
        console.log("Popup already open for", popupKey);
        return; // Skip if already open
      }

      // Add to tracking set
      openedPopups.add(popupKey);

      // Add strict matching parameters
      const url = BASE_URL + '/api/section-content/' + categoryId + '/' + encodeURIComponent(sectionId) + '?exact_match=true';
      
      console.log("Fetching with strict matching:", url);

      $.ajax({
        url: url,
        method: "GET",
        dataType: "json",
        headers: {
          'X-Exact-Section-Match': 'true',
          'X-Section-ID': sectionId
        },
        success: function (response) {
          try {
            if (response.error) {
              console.error("Server Error:", response.error);
              // Fallback to unmatched reference if regular fetch fails
              if (typeof fetchUnmatchedReference === 'function') {
                fetchUnmatchedReference(sectionId, mouseX, mouseY);
              } else {
                console.error("fetchUnmatchedReference is not defined");
              }
              return;
            }
            
            // Client-side exact filtering
            let exactData = [];
            
            if (response.data && Array.isArray(response.data) && response.data.length > 0) {
              console.log("Filtering server response for exact match to section:", sectionId);
              
              // Filter for exact match by section
              exactData = response.data.filter(section => {
                // For numeric section IDs
                if (/^\\d+$/.test(sectionId) && section.section) {
                  const isMatch = String(section.section) === String(sectionId);
                  console.log(\`Comparing numeric section: '\${section.section}' with sectionId: '\${sectionId}' -> \${isMatch}\`);
                  return isMatch;
                }
                // For section IDs with subsections like "17(2)"
                else if (/^(\\d+)\\((\\d+)\\)$/.test(sectionId) && section.section) {
                  const parts = sectionId.match(/^(\\d+)\\((\\d+)\\)$/);
                  const isMatch = String(section.section) === String(parts[1]) && 
                         (String(section.sub_section) === String(parts[2]) || 
                          String(section.sub_section) === "(" + parts[2] + ")");
                  console.log(\`Comparing complex section: \${section.section}(\${section.sub_section}) with sectionId: \${sectionId} -> \${isMatch}\`);
                  return isMatch;
                }
                // For section_id exact match
                else if (section.section_id) {
                  const isMatch = section.section_id === sectionId;
                  console.log(\`Comparing section_id: '\${section.section_id}' with sectionId: '\${sectionId}' -> \${isMatch}\`);
                  return isMatch;
                }
                
                return false;
              });
              
              console.log(\`Filtered \${response.data.length} results to \${exactData.length} exact matches\`);
            }
            
            // Only process exactly matching sections
            if (exactData.length > 0) {
              const section = exactData[0];
              const title = section.title || "Section " + sectionId;
              const content = section.text_content || section.content || "No content available";
              
              if (typeof createSectionPopup === 'function') {
                createSectionPopup(title, content, section, mouseX, mouseY, sectionId, categoryId);
              } else {
                console.error("createSectionPopup is not defined");
                // Try to show some content anyway
                createBasicPopup(title, content, mouseX, mouseY);
              }
            } else {
              console.warn("No exact matches found for section", sectionId);
              // If no exact matches, fallback to unmatched reference
              if (typeof fetchUnmatchedReference === 'function') {
                fetchUnmatchedReference(sectionId, mouseX, mouseY);
              } else {
                console.error("fetchUnmatchedReference is not defined");
                createBasicPopup("Section " + sectionId, "No exact match found for this reference.", mouseX, mouseY);
              }
            }
          } catch (e) {
            console.error("Error processing response:", e);
            if (typeof fetchUnmatchedReference === 'function') {
              fetchUnmatchedReference(sectionId, mouseX, mouseY);
            } else {
              console.error("fetchUnmatchedReference is not defined");
            }
          }
        },
        error: function (xhr, status, error) {
          console.error("AJAX Error:", status, error);
          
          // Check authentication errors
          if (xhr.status === 401) {
            createBasicPopup("Authentication Required", "You need to be logged in to view this content.", mouseX, mouseY);
          } else {
            // Other errors
            if (typeof fetchUnmatchedReference === 'function') {
              fetchUnmatchedReference(sectionId, mouseX, mouseY);
            } else {
              console.error("fetchUnmatchedReference is not defined");
              createBasicPopup("Error", "Could not fetch the section content: " + error, mouseX, mouseY);
            }
          }
        }
      });
    }
    
    // Basic popup function as fallback
    function createBasicPopup(title, content, mouseX, mouseY) {
      // Create a unique ID for this popup
      const popupId = 'popup-' + Date.now();
      
      // Create popup HTML
      const popupHtml = \`
        <div id="\${popupId}" class="reference-popup" style="position: absolute; top: \${mouseY}px; left: \${mouseX}px; z-index: 1050; width: 450px; max-height: 400px; overflow-y: auto; background-color: white; border: 1px solid #ccc; border-radius: 4px; box-shadow: 0 2px 10px rgba(0,0,0,0.2); padding: 10px;">
          <div class="popup-header" style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid #eee; padding-bottom: 8px; margin-bottom: 10px;">
            <h5 style="margin: 0; font-size: 16px;">\${title}</h5>
            <button type="button" class="popup-close-btn" style="background: none; border: none; font-size: 20px; cursor: pointer;">&times;</button>
          </div>
          <div class="popup-content">
            \${content}
          </div>
        </div>
      \`;
      
      // Append to body
      $('body').append(popupHtml);
      
      // Add close handler
      $('#' + popupId + ' .popup-close-btn').on('click', function() {
        $('#' + popupId).remove();
      });
      
      // Make draggable
      $('#' + popupId).draggable({
        handle: '.popup-header',
        containment: 'window'
      });
    }
  `;
  
  // Insert the fix script after the original
  originalScript.parentNode.insertBefore(fixScript, originalScript.nextSibling);
}
