/**
 * Section Reference Debug Tool
 * This script adds a debug panel to help troubleshoot section reference issues
 */

document.addEventListener('DOMContentLoaded', function() {
    // Create debug panel
    const debugPanel = document.createElement('div');
    debugPanel.id = 'section-debug-panel';
    debugPanel.style.cssText = 'position: fixed; bottom: 10px; right: 10px; width: 300px; max-height: 400px; overflow-y: auto; background-color: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); padding: 10px; font-size: 12px; z-index: 9999; font-family: monospace;';
    
    debugPanel.innerHTML = `
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 8px; border-bottom: 1px solid #ddd; padding-bottom: 5px;">
            <strong>Section Reference Debug</strong>
            <button id="clear-debug-log" style="background: none; border: none; cursor: pointer; font-size: 14px;">&times;</button>
        </div>
        <div id="section-debug-log" style="white-space: pre-wrap;"></div>
    `;
    
    document.body.appendChild(debugPanel);
    
    // Add clear button functionality
    document.getElementById('clear-debug-log').addEventListener('click', function() {
        document.getElementById('section-debug-log').innerHTML = '';
    });
    
    // Override console.log and other functions to also add to our debug panel
    const originalLog = console.log;
    const originalWarn = console.warn;
    const originalError = console.error;
    
    // Only log messages related to sections
    const shouldLog = (args) => {
        if (!args || args.length === 0) return false;
        
        const firstArg = String(args[0] || '');
        return firstArg.includes('section') || 
               firstArg.includes('Section') || 
               firstArg.includes('match') || 
               firstArg.includes('filter') ||
               firstArg.includes('exact');
    };
    
    const addToDebugLog = (level, args) => {
        if (!shouldLog(args)) return;
        
        const debugLog = document.getElementById('section-debug-log');
        if (!debugLog) return;
        
        const now = new Date();
        const timestamp = `${now.getHours().toString().padStart(2, '0')}:${now.getMinutes().toString().padStart(2, '0')}:${now.getSeconds().toString().padStart(2, '0')}.${now.getMilliseconds().toString().padStart(3, '0')}`;
        
        let message = `[${timestamp}] [${level}] `;
        
        Array.from(args).forEach((arg, i) => {
            if (typeof arg === 'object') {
                try {
                    message += JSON.stringify(arg, null, 2);
                } catch (e) {
                    message += String(arg);
                }
            } else {
                message += String(arg);
            }
            
            if (i < args.length - 1) {
                message += ' ';
            }
        });
        
        const div = document.createElement('div');
        div.textContent = message;
        
        switch (level) {
            case 'ERROR':
                div.style.color = '#dc3545';
                break;
            case 'WARN':
                div.style.color = '#ffc107';
                break;
            default:
                div.style.color = '#0d6efd';
        }
        
        debugLog.appendChild(div);
        debugLog.scrollTop = debugLog.scrollHeight;
    };
    
    // Override console methods
    console.log = function() {
        addToDebugLog('INFO', arguments);
        originalLog.apply(console, arguments);
    };
    
    console.warn = function() {
        addToDebugLog('WARN', arguments);
        originalWarn.apply(console, arguments);
    };
    
    console.error = function() {
        addToDebugLog('ERROR', arguments);
        originalError.apply(console, arguments);
    };
    
    // Add a global function for testing a specific section ID
    window.testSectionMatch = function(sectionId, tableId) {
        console.log(`Testing section match for ${sectionId} in table ${tableId}`);
        
        fetch(`/section-content/${tableId || 1}/${encodeURIComponent(sectionId)}?exact_match=true`, {
            headers: {
                'X-Exact-Section-Match': 'true',
                'X-Section-ID': sectionId
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log(`API response for section ${sectionId}:`, data);
            
            if (data.data && Array.isArray(data.data)) {
                console.log(`Response contains ${data.data.length} items`);
                
                // Test the filtering logic
                const exactData = data.data.filter(section => {
                    // For decimal section IDs like "10.3" - include section and all its subsections
                    if (/^\d+\.\d+$/.test(sectionId) && section.section) {
                        // Match the main section exactly (10.3) OR any subsection (10.3(1)) or paragraph (10.3(1)(a))
                        if (String(section.section) === String(sectionId)) {
                            console.log(`Comparing section: '${section.section}' with sectionId: '${sectionId}' -> MATCH (exact)`);
                            return true;
                        } else if (section.section_id && section.section_id.startsWith(sectionId + '(')) {
                            console.log(`Comparing section_id: '${section.section_id}' with sectionId: '${sectionId}' -> MATCH (subsection)`);
                            return true;
                        }
                        console.log(`Comparing section: '${section.section}' with sectionId: '${sectionId}' -> NO MATCH`);
                        return false;
                    }
                    // For numeric section IDs (e.g., "17")
                    else if (/^\d+$/.test(sectionId) && section.section) {
                        const isMatch = String(section.section) === String(sectionId);
                        console.log(`Comparing numeric section: '${section.section}' with sectionId: '${sectionId}' -> ${isMatch ? 'MATCH' : 'NO MATCH'}`);
                        return isMatch;
                    }
                    return false;
                });
                
                console.log(`Filtered to ${exactData.length} exact matches`);
                if (exactData.length > 0) {
                    console.log('Exact matches:', exactData);
                }
            }
        })
        .catch(error => {
            console.error('Error testing section match:', error);
        });
    };
    
    console.log('Section Reference Debug Tool loaded');
});
