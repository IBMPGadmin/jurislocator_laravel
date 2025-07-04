<?php
// Simple test script to verify AJAX pagination fix
echo "Testing User-Centric Pagination AJAX Fix\n";
echo "==========================================\n\n";

// Test 1: Check if UserPersonalDocumentController exists and has required methods
echo "1. Checking UserPersonalDocumentController...\n";
if (file_exists('app/Http/Controllers/UserPersonalDocumentController.php')) {
    $content = file_get_contents('app/Http/Controllers/UserPersonalDocumentController.php');
    
    // Check for AJAX detection
    if (strpos($content, 'X-Requested-With') !== false) {
        echo "   ✓ AJAX detection code found\n";
    } else {
        echo "   ✗ AJAX detection code missing\n";
    }
    
    // Check for request->ajax() method
    if (strpos($content, 'request->ajax()') !== false || strpos($content, '$request->ajax()') !== false) {
        echo "   ✓ Laravel AJAX detection method found\n";
    } else {
        echo "   ✗ Laravel AJAX detection method missing\n";
    }
    
    // Check for view rendering in AJAX response
    if (strpos($content, '->render()') !== false) {
        echo "   ✓ View rendering for AJAX response found\n";
    } else {
        echo "   ✗ View rendering for AJAX response missing\n";
    }
} else {
    echo "   ✗ UserPersonalDocumentController not found\n";
}

echo "\n";

// Test 2: Check route registration
echo "2. Checking route registration...\n";
if (file_exists('routes/web.php')) {
    $routes = file_get_contents('routes/web.php');
    
    if (strpos($routes, 'user.personal.document.view') !== false) {
        echo "   ✓ User personal document route found\n";
    } else {
        echo "   ✗ User personal document route missing\n";
    }
    
    if (strpos($routes, 'UserPersonalDocumentController') !== false) {
        echo "   ✓ Controller reference in routes found\n";
    } else {
        echo "   ✗ Controller reference in routes missing\n";
    }
} else {
    echo "   ✗ Routes file not found\n";
}

echo "\n";

// Test 3: Check JavaScript pagination setup
echo "3. Checking JavaScript pagination setup...\n";
if (file_exists('resources/views/view-legal-table-data-personal.blade.php')) {
    $view = file_get_contents('resources/views/view-legal-table-data-personal.blade.php');
    
    if (strpos($view, 'X-Requested-With') !== false && strpos($view, 'XMLHttpRequest') !== false) {
        echo "   ✓ AJAX headers properly set in JavaScript\n";
    } else {
        echo "   ✗ AJAX headers missing or incorrect\n";
    }
    
    if (strpos($view, 'changePage') !== false) {
        echo "   ✓ changePage function found\n";
    } else {
        echo "   ✗ changePage function missing\n";
    }
    
    if (strpos($view, 'currentPage') !== false && strpos($view, 'totalPages') !== false) {
        echo "   ✓ Pagination variables found\n";
    } else {
        echo "   ✗ Pagination variables missing\n";
    }
    
    if (strpos($view, 'pagination-btn') !== false) {
        echo "   ✓ Pagination button class found (theme conflict avoided)\n";
    } else {
        echo "   ✗ Pagination button class missing\n";
    }
} else {
    echo "   ✗ User-centric view file not found\n";
}

echo "\n";

// Test 4: Check for differences between client-centric and user-centric
echo "4. Comparing client-centric vs user-centric implementations...\n";
$clientView = file_exists('resources/views/view-legal-table-data.blade.php') 
    ? file_get_contents('resources/views/view-legal-table-data.blade.php') 
    : '';
$userView = file_exists('resources/views/view-legal-table-data-personal.blade.php') 
    ? file_get_contents('resources/views/view-legal-table-data-personal.blade.php') 
    : '';

if ($clientView && $userView) {
    // Check if both have pagination controls
    $clientHasPagination = strpos($clientView, 'pagination-controls') !== false;
    $userHasPagination = strpos($userView, 'pagination-controls') !== false;
    
    if ($clientHasPagination && $userHasPagination) {
        echo "   ✓ Both views have pagination controls\n";
    } else {
        echo "   ✗ Pagination controls missing in one or both views\n";
    }
    
    // Check for changePage function in both
    $clientHasChangePage = strpos($clientView, 'function changePage') !== false;
    $userHasChangePage = strpos($userView, 'function changePage') !== false;
    
    if ($clientHasChangePage && $userHasChangePage) {
        echo "   ✓ Both views have changePage function\n";
    } else {
        echo "   ✗ changePage function missing in one or both views\n";
    }
} else {
    echo "   ✗ Could not compare views (one or both missing)\n";
}

echo "\n";

echo "Summary:\n";
echo "The fix adds AJAX request detection to UserPersonalDocumentController\n";
echo "which was missing compared to how client-centric pagination works.\n";
echo "This should resolve the pagination issue in the user-centric process.\n\n";

echo "To test:\n";
echo "1. Access a user-centric legal document page\n";
echo "2. Try clicking prev/next buttons or changing page selection\n";
echo "3. Check browser developer console for AJAX requests\n";
echo "4. Check Laravel logs for AJAX detection messages\n";
?>
