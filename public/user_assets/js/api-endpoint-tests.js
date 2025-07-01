/**
 * Test API Endpoints for JSON Responses
 * 
 * This function tests all API endpoints to verify they return proper JSON responses
 * and properly handle authentication
 */
function testApiEndpoints() {
    const resultsDiv = document.getElementById('api-test-results');
    resultsDiv.style.display = 'block';
    resultsDiv.innerHTML = '<h5>Testing API Endpoints...</h5><div class="spinner-border spinner-border-sm text-primary" role="status"></div>';
    
    // Get the current table ID and a sample section
    const currentTable = document.querySelector('meta[name="current-document-table"]')?.content;
    const currentCategoryId = document.querySelector('meta[name="current-document-category-id"]')?.content;
    
    if (!currentTable || !currentCategoryId) {
        resultsDiv.innerHTML = '<div class="alert alert-danger">Missing current document context. Make sure meta tags are set.</div>';
        return;
    }
    
    // Test each API endpoint
    const testResults = [];
    let completedTests = 0;
    const totalTests = 2; // Adjust based on number of tests
    
    // Function to update results as tests complete
    function updateResults() {
        completedTests++;
        if (completedTests === totalTests) {
            let resultsHtml = '<h5>API Test Results:</h5>';
            resultsHtml += '<table class="table table-sm table-bordered">';
            resultsHtml += '<thead><tr><th>Endpoint</th><th>Status</th><th>Content-Type</th><th>Result</th></tr></thead>';
            resultsHtml += '<tbody>';
            
            testResults.forEach(test => {
                const statusClass = test.success ? 'table-success' : 'table-danger';
                resultsHtml += `<tr class="${statusClass}">`;
                resultsHtml += `<td>${test.endpoint}</td>`;
                resultsHtml += `<td>${test.status}</td>`;
                resultsHtml += `<td>${test.contentType || 'Unknown'}</td>`;
                resultsHtml += `<td>${test.message}</td>`;
                resultsHtml += '</tr>';
            });
            
            resultsHtml += '</tbody></table>';
            
            // Add summary
            const successCount = testResults.filter(t => t.success).length;
            resultsHtml += `<div class="alert ${successCount === totalTests ? 'alert-success' : 'alert-warning'}">`;
            resultsHtml += `${successCount} of ${totalTests} tests passed.`;
            resultsHtml += '</div>';
            
            // Add notice if we didn't test annotations
            resultsHtml += '<div class="small text-muted mt-2">Note: Annotation endpoints not tested as they require additional data.</div>';
            
            resultsDiv.innerHTML = resultsHtml;
        }
    }
    
    // Test 1: Section Content API
    const sampleSection = "1"; // Try a simple section that likely exists
    fetch(`/api/section-content/${currentCategoryId}/${sampleSection}`)
        .then(response => {
            const test = {
                endpoint: `/api/section-content/${currentCategoryId}/${sampleSection}`,
                status: response.status,
                contentType: response.headers.get('content-type'),
                success: false,
                message: ''
            };
            
            if (response.ok) {
                test.success = true;
                test.message = 'Success! Proper response received.';
                
                // Check content type
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    test.success = false;
                    test.message = `Warning: Content-Type is not JSON: ${contentType}`;
                }
                
                // Try to parse JSON to confirm it's valid
                return response.json().then(data => {
                    test.message += ' JSON parsed successfully.';
                    testResults.push(test);
                    updateResults();
                }).catch(error => {
                    test.success = false;
                    test.message = `Error parsing JSON: ${error.message}`;
                    testResults.push(test);
                    updateResults();
                });
            } else {
                test.message = `Error: ${response.status} status code`;
                // Try to get error details if possible
                return response.text().then(text => {
                    try {
                        const errorData = JSON.parse(text);
                        test.message += ` - ${errorData.message || 'Unknown error'}`;
                        test.success = response.status === 401; // 401 is OK for auth failures
                    } catch (e) {
                        test.message += ` - Non-JSON response: ${text.substring(0, 100)}...`;
                        test.success = false;
                    }
                    testResults.push(test);
                    updateResults();
                }).catch(error => {
                    test.message += ` - Failed to get error details: ${error.message}`;
                    testResults.push(test);
                    updateResults();
                });
            }
        })
        .catch(error => {
            testResults.push({
                endpoint: `/api/section-content/${currentCategoryId}/${sampleSection}`,
                status: 'Network Error',
                contentType: 'Unknown',
                success: false,
                message: `Network error: ${error.message}`
            });
            updateResults();
        });
    
    // Test 2: Reference Fetch API (with a dummy ID)
    const sampleReferenceId = `${currentCategoryId}:1`;
    fetch(`/api/reference/${sampleReferenceId}`)
        .then(response => {
            const test = {
                endpoint: `/api/reference/${sampleReferenceId}`,
                status: response.status,
                contentType: response.headers.get('content-type'),
                success: false,
                message: ''
            };
            
            if (response.ok) {
                test.success = true;
                test.message = 'Success! Proper response received.';
                
                // Check content type
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    test.success = false;
                    test.message = `Warning: Content-Type is not JSON: ${contentType}`;
                }
                
                // Try to parse JSON to confirm it's valid
                return response.json().then(data => {
                    test.message += ' JSON parsed successfully.';
                    testResults.push(test);
                    updateResults();
                }).catch(error => {
                    test.success = false;
                    test.message = `Error parsing JSON: ${error.message}`;
                    testResults.push(test);
                    updateResults();
                });
            } else {
                test.message = `Error: ${response.status} status code`;
                // Try to get error details if possible
                return response.text().then(text => {
                    try {
                        const errorData = JSON.parse(text);
                        test.message += ` - ${errorData.message || 'Unknown error'}`;
                        test.success = response.status === 401; // 401 is OK for auth failures
                    } catch (e) {
                        test.message += ` - Non-JSON response: ${text.substring(0, 100)}...`;
                        test.success = false;
                    }
                    testResults.push(test);
                    updateResults();
                }).catch(error => {
                    test.message += ` - Failed to get error details: ${error.message}`;
                    testResults.push(test);
                    updateResults();
                });
            }
        })
        .catch(error => {
            testResults.push({
                endpoint: `/api/reference/${sampleReferenceId}`,
                status: 'Network Error',
                contentType: 'Unknown',
                success: false,
                message: `Network error: ${error.message}`
            });
            updateResults();
        });
}
