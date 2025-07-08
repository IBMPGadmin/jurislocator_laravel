/**
 * Sidebar Persistence JavaScript
 * Handles saving, fetching, and clearing pinned popups in the nested-droppable area
 */

$(document).ready(function() {
    // Initialize sidebar persistence functionality
    initializeSidebarPersistence();
});

function initializeSidebarPersistence() {
    // Save Popups Button
    $('#save-pinned-popups').on('click', function() {
        savePinnedPopups();
    });

    // Fetch Popups Button
    $('#fetch-pinned-popups').on('click', function() {
        fetchPinnedPopups();
    });

    // Clear Popups Button
    $('#clear-pinned-popups').on('click', function() {
        clearPinnedPopups();
    });

    // Add Test Popup Button
    $('#add-test-popup').on('click', function() {
        addTestPopup();
    });

    // Auto-fetch popups on page load
    setTimeout(function() {
        // Check if this is a user-centric page
        const isUserCentric = window.location.pathname.includes('/user/') || 
                             window.location.pathname.includes('view-user-legal-table') ||
                             document.querySelector('meta[name="current-user-id"]');
        
        if (isUserCentric) {
            console.log('User-centric page detected, skipping sidebar-persistence auto-fetch');
            // The user-centric-popups.js will handle auto-loading
        } else {
            fetchPinnedPopups();
        }
    }, 1000);
    
    // Convert any existing legacy pinned popups that might be in the DOM
    setTimeout(convertLegacyPinnedPopups, 1500);
}

/**
 * Save pinned popups to the database
 */
async function savePinnedPopups() {
    const $button = $('#save-pinned-popups');
    const originalText = $button.html();
    
    // Show loading state
    $button.html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);

    try {
        // Get all pinned popups from the nested-droppable area
        const popups = collectPinnedPopups();
        
        if (popups.length === 0) {
            showNotification('No popups to save', 'warning');
            $button.html(originalText).prop('disabled', false);
            return;
        }

        // Get client ID from meta tag or global variable
        const clientId = getClientId();
        
        // Check if this is a user-centric page
        const isUserCentric = clientId === null;
        
        // Removed 'Client ID not found' notification as requested
        // if (!isUserCentric && !clientId) {
        //     showNotification('Client ID not found', 'error');
        //     $button.html(originalText).prop('disabled', false);
        //     return;
        // }
        
        // For user-centric pages, delegate to user-centric popup system
        if (isUserCentric) {
            console.log('Delegating to user-centric popup system');
            if (typeof savePopupDataToDatabase === 'function') {
                await savePopupDataToDatabase(true);
            } else {
                showNotification('User popup system not available', 'error');
            }
            $button.html(originalText).prop('disabled', false);
            return;
        }

        // Prepare data for API call
        const requestData = {
            client_id: clientId,
            popups: popups,
            _token: $('meta[name="csrf-token"]').attr('content')
        };

        console.log('Saving popups data:', requestData);

        // Make API call to save popups
        $.ajax({
            url: '/sidebar/popups/save',
            method: 'POST',
            data: JSON.stringify(requestData),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                console.log('Save popups response:', response);
                
                if (response.success) {
                    const message = window.getTranslation ? 
                        window.getTranslation('save_popups_success', {count: response.saved_count}) :
                        `Successfully saved ${response.saved_count} popup(s)`;
                    showNotification(message, 'success');
                } else {
                    const message = window.getTranslation ? 
                        window.getTranslation('save_popups_failed') :
                        (response.message || 'Failed to save popups');
                    showNotification(message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error saving popups:', xhr.responseJSON || error);
                let errorMessage = window.getTranslation ? 
                    window.getTranslation('save_popups_failed') :
                    'Failed to save popups';
                
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    errorMessage = xhr.responseJSON.message;
                } else if (xhr.status === 422 && xhr.responseJSON && xhr.responseJSON.errors) {
                    errorMessage = 'Validation errors: ' + Object.values(xhr.responseJSON.errors).flat().join(', ');
                }
                
                showNotification(errorMessage, 'error');
            },
            complete: function() {
                // Restore button state
                $button.html(originalText).prop('disabled', false);
            }
        });

    } catch (error) {
        console.error('Error in savePinnedPopups:', error);
        showNotification('Error collecting popup data', 'error');
        $button.html(originalText).prop('disabled', false);
    }
}

/**
 * Fetch pinned popups from the database and restore them
 */
async function fetchPinnedPopups() {
    const $button = $('#fetch-pinned-popups');
    const originalText = $button.html();
    
    // Show loading state
    $button.html('<i class="fas fa-spinner fa-spin"></i> Loading...').prop('disabled', true);

    try {
        const clientId = getClientId();
        
        // Check if this is a user-centric page
        const isUserCentric = clientId === null;
        
        // Removed 'Client ID not found' notification as requested
        // if (!isUserCentric && !clientId) {
        //     showNotification('Client ID not found', 'error');
        //     $button.html(originalText).prop('disabled', false);
        //     return;
        // }
        
        // For user-centric pages, delegate to user-centric popup system
        if (isUserCentric) {
            console.log('Delegating to user-centric popup system for fetch');
            if (typeof loadSavedPopups === 'function') {
                await loadSavedPopups(true); // Show notifications for manual fetch
            } else {
                showNotification('User popup system not available', 'error');
            }
            $button.html(originalText).prop('disabled', false);
            return;
        }

        // Make API call to fetch popups
        $.ajax({
            url: '/sidebar/popups/fetch',
            method: 'GET',
            data: { client_id: clientId },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                console.log('Fetch popups response:', response);
                
                if (response.success) {
                    restorePinnedPopups(response.popups);
                    const message = window.getTranslation ? 
                        window.getTranslation('fetch_popups_success', {count: response.popups.length}) :
                        `Loaded ${response.popups.length} saved popup(s)`;
                    showNotification(message, 'success');
                } else {
                    const message = window.getTranslation ? 
                        window.getTranslation('fetch_popups_failed') :
                        (response.message || 'Failed to fetch popups');
                    showNotification(message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching popups:', xhr.responseJSON || error);
                // Removed error notification for failed to load saved popups as requested
            },
            complete: function() {
                // Restore button state
                $button.html(originalText).prop('disabled', false);
            }
        });

    } catch (error) {
        console.error('Error in fetchPinnedPopups:', error);
        showNotification('Error fetching popups', 'error');
        $button.html(originalText).prop('disabled', false);
    }
}

/**
 * Clear all pinned popups
 */
async function clearPinnedPopups() {
    if (!confirm('Are you sure you want to clear all pinned popups?')) {
        return;
    }

    const $button = $('#clear-pinned-popups');
    const originalText = $button.html();
    
    // Show loading state
    $button.html('<i class="fas fa-spinner fa-spin"></i> Clearing...').prop('disabled', true);

    try {
        const clientId = getClientId();
        
        // Check if this is a user-centric page
        const isUserCentric = clientId === null;
        
        // Removed 'Client ID not found' notification as requested
        // if (!isUserCentric && !clientId) {
        //     showNotification('Client ID not found', 'error');
        //     $button.html(originalText).prop('disabled', false);
        //     return;
        // }
        
        // For user-centric pages, delegate to user-centric popup system
        if (isUserCentric) {
            console.log('Delegating to user-centric popup system for clear');
            // Clear from UI first
            $('.nested-droppable .pinned-popup').each(function() {
                $(this)[0].style.animation = 'popupFadeOut 0.3s ease-in forwards';
                setTimeout(() => $(this).remove(), 300);
            });
            
            // Clear from database
            if (typeof clearSavedPopups === 'function') {
                await clearSavedPopups();
            } else {
                showNotification('User popup system not available', 'error');
            }
            $button.html(originalText).prop('disabled', false);
            return;
        }

        // Make API call to clear popups
        $.ajax({
            url: '/sidebar/popups/clear',
            method: 'DELETE',
            data: JSON.stringify({ client_id: clientId }),
            contentType: 'application/json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                'Accept': 'application/json'
            },
            success: function(response) {
                console.log('Clear popups response:', response);
                
                if (response.success) {
                    // Clear the UI
                    $('.nested-droppable .pinned-popup').remove();
                    const message = window.getTranslation ? 
                        window.getTranslation('clear_popups_success', {count: response.deleted_count || 0}) :
                        `Cleared ${response.deleted_count || 0} popup(s)`;
                    showNotification(message, 'success');
                } else {
                    const message = window.getTranslation ? 
                        window.getTranslation('clear_popups_failed') :
                        (response.message || 'Failed to clear popups');
                    showNotification(message, 'error');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error clearing popups:', xhr.responseJSON || error);
                const message = window.getTranslation ? 
                    window.getTranslation('clear_popups_failed') :
                    'Failed to clear popups';
                showNotification(message, 'error');
            },
            complete: function() {
                // Restore button state
                $button.html(originalText).prop('disabled', false);
            }
        });

    } catch (error) {
        console.error('Error in clearPinnedPopups:', error);
        showNotification('Error clearing popups', 'error');
        $button.html(originalText).prop('disabled', false);
    }
}

/**
 * Collect all pinned popups from the nested-droppable area
 */
function collectPinnedPopups() {
    const popups = [];
    
    // Look for pinned popups in the nested-droppable area
    $('.nested-droppable .pinned-popup, .nested-droppable .floating-popup, .nested-droppable .card').each(function() {
        const $popup = $(this);
        
        // Try to extract section_id from various possible sources
        let sectionId = $popup.data('section-id') || 
                       $popup.find('[data-section-id]').first().data('section-id') ||
                       $popup.find('.ref').first().data('section-id');
        
        // Try to extract category_id (table_id) from various possible sources  
        let categoryId = $popup.data('category-id') || 
                        $popup.data('table-id') ||
                        $popup.find('[data-category-id]').first().data('category-id') ||
                        $popup.find('[data-table-id]').first().data('table-id') ||
                        $('meta[name="current-document-category-id"]').attr('content');
        
        // Convert to integer if needed
        if (categoryId) {
            categoryId = parseInt(categoryId);
        }
        
        // Extract title and content
        const title = $popup.find('.modal-title, .card-title, .popup-header h6, h5, h6').first().text().trim() || 
                      $popup.data('title') || 
                      'Pinned Content';
                      
        const content = $popup.find('.modal-body, .card-body, .popup-content').first().html() || 
                       $popup.html();
        
        // Extract part and division if available (these might come from legal references)
        const part = $popup.data('part') || null;
        const division = $popup.data('division') || null;

        const popupData = {
            section_id: sectionId ? String(sectionId) : null,
            category_id: categoryId || null,
            part: part,
            division: division,
            popup_title: title,
            popup_content: content
        };

        // Validate required fields (matching your PHP validation)
        if (popupData.section_id && popupData.category_id) {
            popups.push(popupData);
            console.log('Collected popup:', popupData);
        } else {
            console.warn('Skipping popup with missing required data:', {
                element: $popup[0],
                found_section_id: sectionId,
                found_category_id: categoryId,
                popupData: popupData
            });
        }
    });

    console.log(`Collected ${popups.length} valid popups out of ${$('.nested-droppable .pinned-popup, .nested-droppable .floating-popup, .nested-droppable .card').length} elements`);
    return popups;
}

/**
 * Restore pinned popups to the nested-droppable area
 */
function restorePinnedPopups(popups) {
    // Clear existing popups first
    $('.nested-droppable .pinned-popup').remove();

    // Add each popup to the droppable area
    popups.forEach(function(popup) {
        const popupHtml = createPinnedPopupElement(popup);
        $('.nested-droppable').append(popupHtml);
    });

    // Reinitialize any event handlers for the restored popups
    initializePinnedPopupHandlers();
    
    // Convert any legacy format popups that might have come from the server
    setTimeout(convertLegacyPinnedPopups, 100);
}

/**
 * Create HTML element for a pinned popup
 */
function createPinnedPopupElement(popup) {
    const popupId = 'popup-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
    
    return `
        <div class="pinned-popup card mb-2" 
             data-section-id="${popup.section_id}" 
             data-category-id="${popup.category_id}"
             data-part="${popup.part || ''}"
             data-division="${popup.division || ''}"
             id="${popupId}">
            <div class="popup-header" style="background-color: var(--primary-color); color: #fff;">
                <div class="d-flex align-items-center flex-grow-1">
                    <span class="section-path me-2">${popup.popup_title || 'Pinned Content'}</span>
                </div>
                <div class="popup-actions">
                    <button type="button" class="btn btn-sm popup-collapse-btn" title="Collapse/Expand content">
                        <i class="fas fa-chevron-up text-white"></i>
                    </button>
                    <button type="button" class="btn btn-sm remove-pinned-btn" title="Remove popup" data-popup-id="${popupId}">
                        <i class="fas fa-trash text-white"></i>
                    </button>
                </div>
            </div>
            <div class="popup-content">
                ${popup.popup_content || '<p>No content available</p>'}
            </div>
        </div>
    `;
}

/**
 * Initialize event handlers for pinned popups
 */
function initializePinnedPopupHandlers() {
    // Remove popup handler
    $(document).off('click', '.remove-pinned-btn, .remove-pinned-popup').on('click', '.remove-pinned-btn, .remove-pinned-popup', function() {
        const $popup = $(this).closest('.pinned-popup');
        $popup.fadeOut(300, function() {
            $(this).remove();
        });
    });

    // Collapse button functionality
    $(document).off('click', '.popup-collapse-btn').on('click', '.popup-collapse-btn', function(e) {
        const $contentDiv = $(this).closest('.pinned-popup').find('.popup-content');
        const $icon = $(this).find('i');
        
        if ($contentDiv.css('display') === 'none') {
            // Expand
            $contentDiv.css('display', 'block');
            $contentDiv.css('animation', 'popupContentExpand 0.2s ease-out forwards');
            $icon.removeClass('fa-chevron-down').addClass('fa-chevron-up');
        } else {
            // Collapse
            $contentDiv.css('animation', 'popupContentCollapse 0.2s ease-in forwards');
            setTimeout(function() {
                $contentDiv.css('display', 'none');
            }, 200);
            $icon.removeClass('fa-chevron-up').addClass('fa-chevron-down');
        }
    });
}

/**
 * Get client ID from various sources (or return null for user-centric pages)
 */
function getClientId() {
    // Check if this is a user-centric page (no client context required)
    const isUserCentric = window.location.pathname.includes('/user/') || 
                         window.location.pathname.includes('view-user-legal-table') ||
                         document.querySelector('meta[name="current-user-id"]');
    
    if (isUserCentric) {
        console.log('User-centric page detected, no client ID required');
        return null; // Return null but don't treat as error
    }
    
    // Try to get from URL parameter
    const urlParams = new URLSearchParams(window.location.search);
    let clientId = urlParams.get('client_id');
    
    // Try to get from meta tag
    if (!clientId) {
        clientId = $('meta[name="current-client-id"]').attr('content');
    }
    
    // Try to get from global variable
    if (!clientId && typeof currentClientId !== 'undefined') {
        clientId = currentClientId;
    }
    
    // Try to get from hidden input
    if (!clientId) {
        clientId = $('input[name="client_id"]').val();
    }
    
    console.log('Client ID found:', clientId);
    return clientId;
}

/**
 * Show notification to user
 */
function showNotification(message, type = 'info') {
    // Create notification element
    const notificationClass = {
        'success': 'alert-success',
        'error': 'alert-danger',
        'warning': 'alert-warning',
        'info': 'alert-info'
    }[type] || 'alert-info';

    const notification = $(`
        <div class="alert ${notificationClass} alert-dismissible fade show popup-notification" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    `);

    // Add to page
    $('body').append(notification);

    // Auto-remove after 5 seconds
    setTimeout(function() {
        notification.alert('close');
    }, 5000);
}

// Initialize handlers when document is ready
$(document).ready(function() {
    initializePinnedPopupHandlers();
});

/**
 * Add a test popup for debugging purposes
 */
function addTestPopup() {
    const popupId = 'popup-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
    const testPopupHtml = `
        <div class="pinned-popup card mb-2" 
             data-section-id="test-section-1" 
             data-category-id="${$('meta[name="current-document-category-id"]').attr('content') || '1'}"
             data-part=""
             data-division=""
             id="${popupId}">
            <div class="popup-header" style="background-color: var(--primary-color); color: #fff;">
                <div class="d-flex align-items-center flex-grow-1">
                    <span class="section-path me-2">Test Section 1</span>
                </div>
                <div class="popup-actions">
                    <button type="button" class="btn btn-sm popup-collapse-btn" title="Collapse/Expand content">
                        <i class="fas fa-chevron-up text-white"></i>
                    </button>
                    <button type="button" class="btn btn-sm remove-pinned-btn" title="Remove popup" data-popup-id="${popupId}">
                        <i class="fas fa-trash text-white"></i>
                    </button>
                </div>
            </div>
            <div class="popup-content">
                <p>This is a test popup for debugging the save/fetch functionality.</p>
                <p><strong>Section ID:</strong> test-section-1</p>
                <p><strong>Category ID:</strong> ${$('meta[name="current-document-category-id"]').attr('content') || '1'}</p>
            </div>
        </div>
    `;
    
    $('.nested-droppable').append(testPopupHtml);
    
    // Initialize handlers for the new popup
    initializePinnedPopupHandlers();
    
    showNotification('Test popup added to sidebar', 'success');
}

/**
 * Convert legacy pinned popups to the new format
 */
function convertLegacyPinnedPopups() {
    $('.nested-droppable .pinned-popup').each(function() {
        const $popup = $(this);
        
        // Check if it's already in the new format (has popup-header)
        if ($popup.find('.popup-header').length === 0) {
            // Get content from old structure
            const title = $popup.find('.modal-title, .card-title, h6').first().text().trim() || 'Pinned Content';
            const content = $popup.find('.modal-body, .card-body').first().html() || $popup.html();
            const popupId = $popup.attr('id') || 'popup-' + Date.now() + '-' + Math.random().toString(36).substr(2, 9);
            
            // Create new structure
            const newPopupHtml = `
                <div class="popup-header" style="background-color: var(--primary-color); color: #fff;">
                    <div class="d-flex align-items-center flex-grow-1">
                        <span class="section-path me-2">${title}</span>
                    </div>
                    <div class="popup-actions">
                        <button type="button" class="btn btn-sm popup-collapse-btn" title="Collapse/Expand content">
                            <i class="fas fa-chevron-up text-white"></i>
                        </button>
                        <button type="button" class="btn btn-sm remove-pinned-btn" title="Remove popup" data-popup-id="${popupId}">
                            <i class="fas fa-trash text-white"></i>
                        </button>
                    </div>
                </div>
                <div class="popup-content">
                    ${content}
                </div>
            `;
            
            // Empty the popup and add new structure
            $popup.empty().append(newPopupHtml);
            $popup.attr('id', popupId);
        }
    });
    
    // Re-initialize handlers
    initializePinnedPopupHandlers();
}

// Call conversion on document ready
$(document).ready(function() {
    // Convert any legacy pinned popups that may be in the DOM
    setTimeout(convertLegacyPinnedPopups, 500);
});