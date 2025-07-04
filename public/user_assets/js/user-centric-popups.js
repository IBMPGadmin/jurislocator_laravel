/**
 * User-centric popups management with database persistence
 */
let popupZIndex = 1000;

// Global variables for tracking current document context
let currentTableName = null;
let currentCategoryId = null;

// Function to set document context (simplified - no longer needed for popup persistence)
function setDocumentContext(tableName, categoryId) {
    currentTableName = tableName;
    currentCategoryId = categoryId;
    console.log('Document context set:', { tableName, categoryId });
    console.log('Note: Popups are now saved per user, not per document');
    
    // Auto-load saved popups when context is set (silent)
    loadSavedPopups(false);
}

// Function to get document context from page meta tags or URL
function getDocumentContext() {
    if (currentTableName && currentCategoryId) {
        return { tableName: currentTableName, categoryId: currentCategoryId };
    }
    
    // Try to get from meta tags
    const tableName = document.querySelector('meta[name="current-document-table"]')?.getAttribute('content');
    const categoryId = document.querySelector('meta[name="current-document-category-id"]')?.getAttribute('content');
    
    if (tableName && categoryId) {
        currentTableName = tableName;
        currentCategoryId = categoryId;
        return { tableName, categoryId };
    }
    
    // Try to get from URL parameters
    const urlParams = new URLSearchParams(window.location.search);
    const urlCategoryId = urlParams.get('category_id');
    const pathSegments = window.location.pathname.split('/');
    
    // Look for table name in URL path
    let urlTableName = null;
    const viewIndex = pathSegments.findIndex(segment => segment.includes('view-user-legal-table'));
    if (viewIndex !== -1 && viewIndex + 1 < pathSegments.length) {
        urlTableName = pathSegments[viewIndex + 1];
    }
    
    if (urlTableName && urlCategoryId) {
        currentTableName = urlTableName;
        currentCategoryId = urlCategoryId;
        return { tableName: urlTableName, categoryId: urlCategoryId };
    }
    
    console.warn('Could not determine document context');
    return null;
}

/**
 * User-centric popups management - Matches client-centric implementation
 */

// Create floating popup with exact client-centric styling
function createFloatingPopup(title, content) {
    const popup = document.createElement('div');
    popup.className = 'floating-popup';
    popup.style.position = 'fixed';
    popup.style.zIndex = ++popupZIndex;

    // Create popup structure exactly like client-centric
    popup.innerHTML = `
        <div class="popup-header">
            <div class="d-flex align-items-center flex-grow-1">
                <span class="section-path">${title}</span>
            </div>
            <div class="popup-actions">
                <button type="button" class="btn btn-sm popup-collapse-btn" title="Collapse/Expand content">
                    <i class="fas fa-chevron-up text-white"></i>
                </button>
                <button type="button" class="btn btn-sm popup-pin-btn" title="Pin this popup">
                    <i class="fas fa-thumbtack text-white"></i>
                </button>
                <button type="button" class="btn btn-sm popup-close-btn" title="Close popup">
                    <i class="fas fa-times text-white"></i>
                </button>
            </div>
        </div>
        <div class="popup-content">${content}</div>
    `;

    // Add event listeners
    popup.querySelector('.popup-close-btn').addEventListener('click', () => {
        popup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
        setTimeout(() => popup.remove(), 200);
    });

    popup.querySelector('.popup-collapse-btn').addEventListener('click', (e) => {
        const contentDiv = popup.querySelector('.popup-content');
        const icon = e.currentTarget.querySelector('i');
        
        if (contentDiv.style.display === 'none') {
            // Expand
            contentDiv.style.display = 'block';
            contentDiv.style.animation = 'popupContentExpand 0.2s ease-out forwards';
            icon.classList.remove('fa-chevron-down');
            icon.classList.add('fa-chevron-up');
        } else {
            // Collapse
            contentDiv.style.animation = 'popupContentCollapse 0.2s ease-in forwards';
            setTimeout(() => {
                contentDiv.style.display = 'none';
            }, 200);
            icon.classList.remove('fa-chevron-up');
            icon.classList.add('fa-chevron-down');
        }
    });

    popup.querySelector('.popup-pin-btn').addEventListener('click', () => {
        const droppableArea = document.querySelector('.nested-droppable');
        if (!droppableArea) return;

        // Create pinned version
        const pinnedPopup = popup.cloneNode(true);
        pinnedPopup.classList.remove('floating-popup');
        pinnedPopup.classList.add('pinned-popup', 'card');
        pinnedPopup.style.position = 'relative';
        pinnedPopup.style.top = 'auto';
        pinnedPopup.style.left = 'auto';
        pinnedPopup.style.width = '100%';

        // Change pin button to remove button for pinned version
        const pinBtn = pinnedPopup.querySelector('.popup-pin-btn');
        if (pinBtn) {
            pinBtn.innerHTML = '<i class="fas fa-trash text-white"></i>';
            pinBtn.classList.remove('popup-pin-btn');
            pinBtn.classList.add('popup-remove-btn');
            pinBtn.title = 'Remove popup';
        }

        // Re-add event listeners for pinned version
        const contentDiv = pinnedPopup.querySelector('.popup-content');
        pinnedPopup.querySelector('.popup-collapse-btn').addEventListener('click', (e) => {
            const icon = e.currentTarget.querySelector('i');
            if (contentDiv.style.display === 'none') {
                contentDiv.style.display = 'block';
                contentDiv.style.animation = 'popupContentExpand 0.2s ease-out forwards';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                contentDiv.style.animation = 'popupContentCollapse 0.2s ease-in forwards';
                setTimeout(() => {
                    contentDiv.style.display = 'none';
                }, 200);
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });

        pinnedPopup.querySelector('.popup-close-btn').addEventListener('click', () => {
            pinnedPopup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
            setTimeout(() => pinnedPopup.remove(), 200);
        });

        // Add remove functionality
        if (pinBtn) {
            pinBtn.addEventListener('click', () => {
                pinnedPopup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
                setTimeout(() => pinnedPopup.remove(), 200);
            });
        }

        // Add to droppable area
        droppableArea.insertBefore(pinnedPopup, droppableArea.firstChild);

        // Remove the original floating popup with animation
        popup.style.animation = 'popupFadeOut 0.2s ease-in forwards';
        setTimeout(() => popup.remove(), 200);
    });

    // Make draggable with exact client-centric settings
    $(popup).draggable({
        handle: '.popup-header',
        containment: false,
        scroll: false,
        create: function(event, ui) {
            $(this).css('position', 'fixed');
        },
        start: function(event, ui) {
            const offset = $(this).offset();
            const scrollTop = $(window).scrollTop();
            const scrollLeft = $(window).scrollLeft();
            $(this)
                .css('position', 'fixed')
                .css('top', offset.top - scrollTop)
                .css('left', offset.left - scrollLeft)
                .css('z-index', ++popupZIndex);
        }
    });

    // Smart positioning
    const windowWidth = window.innerWidth;
    const windowHeight = window.innerHeight;
    const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
    const scrollLeft = window.pageXOffset || document.documentElement.scrollLeft;
    
    let left = Math.max(scrollLeft + 10, Math.min(scrollLeft + (windowWidth - 520), scrollLeft + (windowWidth / 4)));
    let top = Math.max(scrollTop + 10, Math.min(scrollTop + (windowHeight - 450), scrollTop + (windowHeight / 4)));
    
    popup.style.top = top + 'px';
    popup.style.left = left + 'px';

    document.body.appendChild(popup);
    return popup;
}

// Load pinned popups from storage (deprecated - use loadSavedPopups instead)
function loadPinnedPopups() {
    console.log('loadPinnedPopups() is deprecated, use loadSavedPopups() instead');
    // Call the newer function
    loadSavedPopups();
}

// Save pinned popups to storage (deprecated - use savePopupDataToDatabase instead)
function savePinnedPopups() {
    console.log('savePinnedPopups() is deprecated, use savePopupDataToDatabase() instead');
    // Call the newer function
    savePopupDataToDatabase();
}

// Clear all pinned popups
function clearPinnedPopups() {
    const droppable = document.querySelector('.nested-droppable');
    if (droppable) {
        droppable.querySelectorAll('.pinned-popup').forEach(popup => {
            popup.style.animation = 'popupFadeOut 0.2s ease-out';
            setTimeout(() => popup.remove(), 200);
        });
    }
}

// Initialize popup functionality
// Initialize popup functionality
document.addEventListener('DOMContentLoaded', function() {
    // Load existing pinned popups
    loadPinnedPopups();

    // Setup droppable area with exact client-centric settings
    $(".nested-droppable").droppable({
        accept: ".floating-popup",
        hoverClass: "ui-droppable-hover",
        tolerance: "pointer",
        drop: function(event, ui) {
            const $droppable = $(this);
            const $popup = ui.draggable;

            if (!$popup.hasClass('pinned-popup')) {
                // Create pinned version
                const $pinnedPopup = $popup.clone();
                $pinnedPopup
                    .removeClass('floating-popup')
                    .addClass('pinned-popup card')
                    .css({
                        position: 'relative',
                        top: 'auto',
                        left: 'auto',
                        width: '100%',
                    });

                // Change pin button to remove button
                const $pinBtn = $pinnedPopup.find('.popup-pin-btn');
                if ($pinBtn.length) {
                    $pinBtn.html('<i class="fas fa-trash text-white"></i>');
                    $pinBtn.removeClass('popup-pin-btn').addClass('popup-remove-btn');
                    $pinBtn.attr('title', 'Remove popup');
                }

                // Re-add event listeners
                const contentDiv = $pinnedPopup.find('.popup-content')[0];
                $pinnedPopup.find('.popup-collapse-btn').on('click', function(e) {
                    const icon = $(this).find('i')[0];
                    if (contentDiv.style.display === 'none') {
                        contentDiv.style.display = 'block';
                        contentDiv.style.animation = 'popupContentExpand 0.2s ease-out forwards';
                        icon.classList.remove('fa-chevron-down');
                        icon.classList.add('fa-chevron-up');
                    } else {
                        contentDiv.style.animation = 'popupContentCollapse 0.2s ease-in forwards';
                        setTimeout(() => {
                            contentDiv.style.display = 'none';
                        }, 200);
                        icon.classList.remove('fa-chevron-up');
                        icon.classList.add('fa-chevron-down');
                    }
                });

                $pinnedPopup.find('.popup-close-btn, .popup-remove-btn').on('click', function() {
                    $pinnedPopup[0].style.animation = 'popupFadeOut 0.2s ease-in forwards';
                    setTimeout(() => $pinnedPopup.remove(), 200);
                });

                // Add to droppable area
                $droppable.prepend($pinnedPopup);

                // Remove original popup
                $popup[0].style.animation = 'popupFadeOut 0.2s ease-in forwards';
                setTimeout(() => $popup.remove(), 200);
            }
        }
    }).sortable({
        handle: '.popup-header',
        items: '.pinned-popup',
        opacity: 0.7,
        tolerance: "pointer",
        placeholder: "ui-state-highlight",
        scroll: true,
        update: function() {
            // Save the new order if needed
            savePinnedPopups();
        }
    });

    // Setup save button
    document.getElementById('save-pinned-popups')?.addEventListener('click', savePinnedPopups);

    // Setup fetch button  
    document.getElementById('fetch-pinned-popups')?.addEventListener('click', loadPinnedPopups);

    // Setup clear button
    document.getElementById('clear-pinned-popups')?.addEventListener('click', clearPinnedPopups);
});

// Function to save popup data to database (user-wide, not document-specific)
async function savePopupDataToDatabase(showNotifications = true) {
    try {
        // Collect all pinned popups
        const pinnedPopups = document.querySelectorAll('.nested-droppable .pinned-popup');
        const popupData = [];
        
        pinnedPopups.forEach((popup, index) => {
            const header = popup.querySelector('.popup-header .section-path');
            const content = popup.querySelector('.popup-content');
            
            if (header && content) {
                popupData.push({
                    title: header.textContent || header.innerText,
                    content: content.innerHTML,
                    order: index,
                    timestamp: Date.now()
                });
            }
        });
        
        const response = await fetch('/user/popups/save', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json'
            },
            credentials: 'same-origin',
            body: JSON.stringify({
                popups: popupData
            })
        });
        
        const result = await response.json();
        
        if (!result.success) {
            console.error('Failed to save popup data:', result.message);
            if (showNotifications) {
                showNotification('Failed to save popups: ' + (result.message || 'Unknown error'), 'error');
            }
        } else {
            console.log('Popup data saved successfully');
            if (showNotifications) {
                showNotification('Popups saved successfully!', 'success');
            }
        }
    } catch (error) {
        console.error('Error saving popup data:', error);
        if (showNotifications) {
            showNotification('Error saving popups: ' + error.message, 'error');
        }
    }
}

// Function to load saved popup data from database (user-wide, not document-specific)
async function loadSavedPopups(showNotifications = true) {
    try {
        const response = await fetch('/user/popups/fetch', {
            method: 'GET',
            headers: {
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || ''
            },
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (!result.success) {
            console.log('No saved popup data found or error:', result.message);
            return;
        }
        
        if (result.popups && Array.isArray(result.popups) && result.popups.length > 0) {
            console.log('Loading saved popups:', result.popups.length);
            
            // Clear existing pinned popups
            const droppableArea = document.querySelector('.nested-droppable');
            if (droppableArea) {
                const existingPopups = droppableArea.querySelectorAll('.pinned-popup');
                existingPopups.forEach(popup => popup.remove());
                
                // Sort by order and recreate popups
                const sortedData = result.popups.sort((a, b) => (a.order || 0) - (b.order || 0));
                
                sortedData.forEach(popupInfo => {
                    createPinnedPopup(popupInfo.title, popupInfo.content, droppableArea);
                });
                
                if (showNotifications) {
                    showNotification('Loaded ' + result.popups.length + ' saved popups', 'info');
                }
            }
        }
    } catch (error) {
        console.error('Error loading popup data:', error);
        if (showNotifications) {
            showNotification('Error loading popups: ' + error.message, 'error');
        }
    }
}

// Function to clear saved popup data from database (user-wide, not document-specific)
async function clearSavedPopups() {
    try {
        const response = await fetch('/user/popups/clear', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        });
        
        const result = await response.json();
        
        if (!result.success) {
            console.error('Failed to clear popup data:', result.message);
            showNotification('Failed to clear saved data: ' + (result.message || 'Unknown error'), 'error');
        } else {
            console.log('Popup data cleared successfully');
            showNotification('Saved popups cleared!', 'success');
        }
    } catch (error) {
        console.error('Error clearing popup data:', error);
        showNotification('Error clearing saved data: ' + error.message, 'error');
    }
}

// Notification debouncing to prevent repeated alerts
let lastNotificationMessage = '';
let lastNotificationTime = 0;

// Function to show notifications
function showNotification(message, type = 'info') {
    // Prevent duplicate notifications within 3 seconds
    const now = Date.now();
    if (message === lastNotificationMessage && (now - lastNotificationTime) < 3000) {
        console.log('Duplicate notification prevented:', message);
        return;
    }
    
    lastNotificationMessage = message;
    lastNotificationTime = now;
    
    // Create notification element
    const notification = document.createElement('div');
    notification.className = `alert alert-${type === 'error' ? 'danger' : type === 'success' ? 'success' : 'info'} notification-popup`;
    notification.style.cssText = `
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
        max-width: 400px;
        border-radius: 5px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        animation: slideInRight 0.3s ease-out;
    `;
    notification.innerHTML = `
        <div class="d-flex align-items-center">
            <i class="fas fa-${type === 'error' ? 'exclamation-triangle' : type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
            ${message}
            <button type="button" class="btn-close ms-auto" aria-label="Close"></button>
        </div>
    `;
    
    // Add to page
    document.body.appendChild(notification);
    
    // Auto remove after 5 seconds
    setTimeout(() => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    }, 5000);
    
    // Manual close button
    notification.querySelector('.btn-close').addEventListener('click', () => {
        notification.style.animation = 'slideOutRight 0.3s ease-in';
        setTimeout(() => notification.remove(), 300);
    });
}

// Add CSS animations for notifications
if (!document.querySelector('#notification-animations')) {
    const style = document.createElement('style');
    style.id = 'notification-animations';
    style.textContent = `
        @keyframes slideInRight {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        @keyframes slideOutRight {
            from { transform: translateX(0); opacity: 1; }
            to { transform: translateX(100%); opacity: 0; }
        }
    `;
    document.head.appendChild(style);
}

// Function to create a pinned popup directly (for loading from database)
function createPinnedPopup(title, content, droppableArea) {
    const pinnedPopup = document.createElement('div');
    pinnedPopup.className = 'pinned-popup';
    
    pinnedPopup.innerHTML = `
        <div class="popup-header">
            <div class="d-flex align-items-center flex-grow-1">
                <span class="section-path">${title}</span>
            </div>
            <div class="popup-actions">
                <button type="button" class="btn btn-sm popup-collapse-btn" title="Collapse/Expand content">
                    <i class="fas fa-chevron-up text-white"></i>
                </button>
                <button type="button" class="btn btn-sm remove-pinned-btn" title="Remove">
                    <i class="fas fa-trash text-white"></i>
                </button>
            </div>
        </div>
        <div class="popup-content">${content}</div>
    `;

    // Add collapse functionality
    const collapseBtn = pinnedPopup.querySelector('.popup-collapse-btn');
    if (collapseBtn) {
        collapseBtn.addEventListener('click', (e) => {
            const contentDiv = pinnedPopup.querySelector('.popup-content');
            const icon = e.currentTarget.querySelector('i');
            
            if (contentDiv.style.display === 'none') {
                // Expand
                contentDiv.style.display = 'block';
                contentDiv.style.animation = 'popupContentExpand 0.2s ease-out forwards';
                icon.classList.remove('fa-chevron-down');
                icon.classList.add('fa-chevron-up');
            } else {
                // Collapse
                contentDiv.style.animation = 'popupContentCollapse 0.2s ease-in forwards';
                setTimeout(() => {
                    contentDiv.style.display = 'none';
                }, 200);
                icon.classList.remove('fa-chevron-up');
                icon.classList.add('fa-chevron-down');
            }
        });
    }

    // Add remove functionality
    const removeBtn = pinnedPopup.querySelector('.remove-pinned-btn');
    if (removeBtn) {
        removeBtn.addEventListener('click', () => {
            pinnedPopup.style.animation = 'popupFadeOut 0.3s ease-in forwards';
            setTimeout(() => pinnedPopup.remove(), 300);
        });
    }

    // Add to droppable area
    if (!droppableArea) {
        droppableArea = document.querySelector('.nested-droppable');
    }
    
    if (droppableArea) {
        droppableArea.appendChild(pinnedPopup);
    }
    
    return pinnedPopup;
}

// Auto-save popups when changes are made
function setupAutoSave() {
    const droppableArea = document.querySelector('.nested-droppable');
    if (!droppableArea) return;
    
    // Create a mutation observer to watch for changes
    const observer = new MutationObserver(() => {
        // Debounce auto-save to avoid too frequent saves
        clearTimeout(observer.saveTimeout);
        observer.saveTimeout = setTimeout(() => {
            console.log('Auto-saving popup changes...');
            savePopupDataToDatabase(false); // Silent save (no notifications)
        }, 2000); // Save 2 seconds after last change
    });
    
    observer.observe(droppableArea, {
        childList: true,
        subtree: true
    });
}

// Initialize auto-save
document.addEventListener('DOMContentLoaded', setupAutoSave);
