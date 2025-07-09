<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\UserApprovalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ClientSidebarController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\JurisUserTextController;
use App\Http\Controllers\GovernmentLinkController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return redirect()->route('login');
});

// Subscription routes
Route::get('/pricing', [\App\Http\Controllers\SubscriptionController::class, 'showPricing'])->name('subscription.pricing');
Route::get('/subscription/test-cards', [\App\Http\Controllers\SubscriptionController::class, 'testCards'])->name('subscription.test-cards');
Route::get('/subscription/test-checkout', [\App\Http\Controllers\StripeTestController::class, 'testStripeCheckout'])->name('subscription.test-checkout');
Route::get('/subscription/debug-stripe', [\App\Http\Controllers\StripeDebugController::class, 'checkConfig'])->name('subscription.debug-stripe');

Route::middleware(['auth'])->group(function () {
    Route::post('/subscription/{package}/purchase', [\App\Http\Controllers\SubscriptionController::class, 'purchase'])->name('subscription.purchase');
    Route::get('/subscription/success', [\App\Http\Controllers\SubscriptionController::class, 'success'])->name('subscription.success');
    Route::get('/subscription/cancel', [\App\Http\Controllers\SubscriptionController::class, 'cancel'])->name('subscription.cancel');
    
    // Template routes - moved to client routes section below
});

// Admin-only routes
Route::middleware([\App\Http\Middleware\Authenticate::class, 'verified', \App\Http\Middleware\AdminOnly::class])->group(function () {
    Route::get('/admin-dashboard', [\App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Admin: Add new user page and store
    Route::get('/admin/users/add', [UserController::class, 'create'])->name('admin.users.add');
    Route::post('/admin/users/add', [UserController::class, 'store'])->name('admin.users.store');

    // All users page
    Route::get('/admin/users', [UserController::class, 'index'])->name('admin.users.index');
    Route::get('/admin/users/{user}', [UserController::class, 'show'])->name('admin.users.show');
    Route::patch('/admin/users/{user}/toggle', [UserController::class, 'toggleStatus'])->name('admin.users.toggle');
    Route::delete('/admin/users/{user}', [UserController::class, 'destroy'])->name('admin.users.delete');

    // User Approvals
    Route::get('/admin/user-approvals', [UserApprovalController::class, 'index'])->name('admin.user-approvals.index');
    Route::get('/admin/user-approvals/{user}', [UserApprovalController::class, 'show'])->name('admin.user-approvals.show');
    Route::patch('/admin/user-approvals/{user}/approve', [UserApprovalController::class, 'approve'])->name('admin.user-approvals.approve');
    Route::patch('/admin/user-approvals/{user}/reject', [UserApprovalController::class, 'reject'])->name('admin.user-approvals.reject');

    // Payment Dashboard
    Route::get('/admin/payments', [\App\Http\Controllers\Admin\PaymentDetailsController::class, 'index'])->name('admin.payments.index');
    Route::get('/admin/payments/export', [\App\Http\Controllers\Admin\PaymentDetailsController::class, 'export'])->name('admin.payments.export');
    Route::get('/admin/payments/{subscription}', [\App\Http\Controllers\Admin\PaymentDetailsController::class, 'show'])->name('admin.payments.view');
    
    // Users Report
    Route::get('/admin/reports/users', [\App\Http\Controllers\Admin\UserReportController::class, 'index'])->name('admin.reports.users');
    Route::get('/admin/reports/users/export', [\App\Http\Controllers\Admin\UserReportController::class, 'export'])->name('admin.reports.users.export');

    // Government Links routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('government-links', \App\Http\Controllers\GovernmentLinkController::class);
        Route::resource('rcic-deadlines', \App\Http\Controllers\RCICDeadlineController::class);
        Route::resource('legal-key-terms', \App\Http\Controllers\LegalKeyTermController::class);
    });

    // Legal Documents routes
    Route::get('/admin/legal-documents/add/standard', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'standardUpload'])->name('admin.legal-documents.standard');
    Route::get('/admin/legal-documents/add/alternative', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'alternativeUpload'])->name('admin.legal-documents.alternative');
    Route::post('/admin/legal-documents/process-standard', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'processStandardUpload'])->name('admin.legal-documents.process-standard');
    Route::post('/admin/legal-documents/process-alternative', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'processAlternativeUpload'])->name('admin.legal-documents.process-alternative');
    
    // Legacy route for backward compatibility
    Route::get('/admin/legal-documents/add', function () {
        return redirect()->route('admin.legal-documents.standard');
    })->name('admin.legal-documents.add');

    // Legacy upload handler for backward compatibility
    Route::post('/admin/legal-documents/add', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'processStandardUpload'])->name('admin.legal-documents.store');
    
    // All Legal Documents page
    Route::get('/admin/legal-documents', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'index'])->name('admin.legal-documents.index');
    Route::get('/admin/legal-documents/{document}/edit', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'edit'])->name('admin.legal-documents.edit');
    Route::patch('/admin/legal-documents/{document}', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'update'])->name('admin.legal-documents.update');
    Route::delete('/admin/legal-documents/{document}', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'destroy'])->name('admin.legal-documents.destroy');
    Route::patch('/admin/legal-documents/{document}/toggle', [\App\Http\Controllers\Admin\LegalDocumentController::class, 'toggleStatus'])->name('admin.legal-documents.toggle');
});

// User-only routes
Route::middleware([\App\Http\Middleware\Authenticate::class, 'verified', \App\Http\Middleware\UserOnly::class, \App\Http\Middleware\CheckSubscription::class])->group(function () {
    Route::get('/user-dashboard', function () {
        // Always show the home dashboard with tiles
        return view('home-dashboard');
    })->name('user.dashboard');

    // RCIC Deadlines for users
    Route::get('/rcic-deadlines', [App\Http\Controllers\User\RCICDeadlineController::class, 'index'])->name('user.rcic-deadlines.index');
    
    // Legal Key Terms for users
    Route::get('/legal-key-terms', [App\Http\Controllers\User\LegalKeyTermController::class, 'index'])->name('user.legal-key-terms.index');

    // Tools routes
    Route::get('/tools', [App\Http\Controllers\User\ToolsController::class, 'index'])->name('user.tools');
    Route::get('/tools/date-to-date', [App\Http\Controllers\User\ToolsController::class, 'dateToDate'])->name('user.tools.date-to-date');
    Route::get('/tools/add-subtract-date', [App\Http\Controllers\User\ToolsController::class, 'addSubtractDate'])->name('user.tools.add-subtract-date');
    Route::get('/tools/age-calculator', [App\Http\Controllers\User\ToolsController::class, 'ageCalculator'])->name('user.tools.age-calculator');
    Route::get('/tools/time-zones', [App\Http\Controllers\User\ToolsController::class, 'timeZones'])->name('user.tools.time-zones');
    Route::get('/tools/currency-converter', [App\Http\Controllers\User\ToolsController::class, 'currencyConverter'])->name('user.tools.currency-converter');
    
    // Tool API endpoints
    Route::post('/tools/debug-test', [App\Http\Controllers\User\ToolsController::class, 'debugTest'])->name('tools.debug-test');
    Route::post('/tools/calculate-date-difference', [App\Http\Controllers\User\ToolsController::class, 'calculateDateDifference'])->name('tools.calculate-date-difference');
    Route::post('/tools/add-subtract-from-date', [App\Http\Controllers\User\ToolsController::class, 'addSubtractFromDate'])->name('tools.add-subtract-from-date');
    Route::post('/tools/calculate-age', [App\Http\Controllers\User\ToolsController::class, 'calculateAge'])->name('tools.calculate-age');
    Route::post('/tools/exchange-rates', [App\Http\Controllers\User\ToolsController::class, 'getExchangeRates'])->name('tools.exchange-rates');
    Route::get('/tools/all-rates', [App\Http\Controllers\User\ToolsController::class, 'getAllRates'])->name('tools.all-rates');
    
    // Client routes
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::post('/select-client', [ClientController::class, 'selectClient'])->name('clients.select');
    Route::get('/home', [ClientController::class, 'home'])->name('home');
    Route::get('/templates', [ClientController::class, 'selectClientForTemplate'])->name('templates.select-client');
    Route::get('/templates/{client_id}', [ClientController::class, 'viewTemplates'])->name('templates.index');
    
    Route::get('/templates/{client_id}/edit/{template_id}', function ($client_id, $template_id) {
        $client = \App\Models\Client::find($client_id);
        
        // Ensure the client belongs to the current user
        if (!$client || $client->user_id != \Illuminate\Support\Facades\Auth::id()) {
            return redirect()->route('templates.select-client')
                ->with('error', 'Invalid client selection. Please try again.');
        }
        
        // Update last accessed
        $client->last_accessed = now();
        $client->save();
        
        $templateId = $template_id;
        $templateTitles = [
            1 => 'Client Introduction Letter',
            2 => 'Case Status Update Letter',
            3 => 'Application Submission Letter'
        ];
        $templateTitle = $templateTitles[$template_id] ?? 'Document Template';
        return view('edit-template', compact('client', 'templateId', 'templateTitle'));
    })->name('templates.edit');
    
    Route::post('/templates/{client_id}/save/{template_id}', function ($client_id, $template_id) {
        $client = \App\Models\Client::find($client_id);
        
        // Ensure the client belongs to the current user
        if (!$client || $client->user_id != \Illuminate\Support\Facades\Auth::id()) {
            return redirect()->route('templates.select-client')
                ->with('error', 'Invalid client selection. Please try again.');
        }
        
        // Update last accessed
        $client->last_accessed = now();
        $client->save();
        
        // Here you would save the template content from the request
        // e.g., Store in database or as a file
        // $content = request('content');
        // $subject = request('subject');
        
        // For now, just acknowledge the save
        return redirect()->back()->with('success', 'Template saved successfully!');
    })->name('templates.save');
    Route::get('/legal-tables/{id}', [ClientController::class, 'viewLegalTable'])->name('client.legalTables.view');
    
    // Government Links routes for users
    Route::get('/government-links', [App\Http\Controllers\UserGovernmentLinksController::class, 'index'])->name('user.government-links');
    Route::get('/government-links/{category}', [App\Http\Controllers\UserGovernmentLinksController::class, 'showCategory'])->name('user.government-links.category');
    
    // Legal table view and annotation routes
    Route::get('/view-legal-table', [App\Http\Controllers\ViewLegalTableController::class, 'show'])->name('view-legal-table');
    Route::get('/section-content/{tableId}/{sectionRef}', [App\Http\Controllers\ViewLegalTableController::class, 'getSectionContent'])->name('section-content');
    Route::get('/reference/{referenceId}', [App\Http\Controllers\ViewLegalTableController::class, 'fetchReferenceById'])->name('reference.fetch');
    Route::post('/annotations', [App\Http\Controllers\ViewLegalTableController::class, 'saveAnnotation'])->name('annotations.save');
    Route::delete('/annotations/{id}', [App\Http\Controllers\ViewLegalTableController::class, 'deleteAnnotation'])->name('annotations.delete');
    
    // French Legal table view and annotation routes
    Route::get('/view-legal-table-french/{table}', [App\Http\Controllers\ViewLegalTableFrenchController::class, 'show'])->name('french.legalTables.view');
    Route::get('/section-content-french/{tableId}/{sectionRef}', [App\Http\Controllers\ViewLegalTableFrenchController::class, 'getSectionContent'])->name('section-content-french');
    Route::get('/reference-french/{referenceId}', [App\Http\Controllers\ViewLegalTableFrenchController::class, 'fetchReferenceById'])->name('reference-french.fetch');
    Route::post('/annotations-french', [App\Http\Controllers\ViewLegalTableFrenchController::class, 'saveAnnotation'])->name('annotations-french.save');
    Route::delete('/annotations-french/{id}', [App\Http\Controllers\ViewLegalTableFrenchController::class, 'deleteAnnotation'])->name('annotations-french.delete');
    
    // Document routes
    Route::get('/documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('/documents/search', [DocumentController::class, 'search'])->name('documents.search');
    Route::get('/documents/{id}', [DocumentController::class, 'show'])->name('documents.show');
    Route::get('/documents/{id}/download', [DocumentController::class, 'download'])->name('documents.download');
    
    // User text annotations routes
    Route::post('/annotations', [JurisUserTextController::class, 'store'])->name('annotations.store');
    Route::get('/annotations/section', [JurisUserTextController::class, 'getForSection'])->name('annotations.section');
    Route::patch('/annotations/{id}', [JurisUserTextController::class, 'update'])->name('annotations.update');
    Route::delete('/annotations/{id}', [JurisUserTextController::class, 'destroy'])->name('annotations.destroy');

    // Sidebar popup persistence routes
    Route::post('/sidebar/popups/save', [ClientSidebarController::class, 'savePinnedPopups'])->name('sidebar.popups.save');
    Route::get('/sidebar/popups/fetch', [ClientSidebarController::class, 'fetchPinnedPopups'])->name('sidebar.popups.fetch');
    Route::delete('/sidebar/popups/clear', [ClientSidebarController::class, 'clearPinnedPopups'])->name('sidebar.popups.clear');
    
    // Legal tables route (Client-centric)
    Route::get('/user/client/{client}/legal-tables', [App\Http\Controllers\UserLegalTableController::class, 'show'])
        ->name('user.client.legal-tables');
    
    // Client management routes (updated workflow)
    Route::get('/client-management', [ClientController::class, 'legalTables'])->name('client.management');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::post('/select-client', [ClientController::class, 'selectClient'])->name('clients.select');
    
    // Test route for client API debugging
    Route::get('/test-client-api', function() {
        try {
            $controller = new \App\Http\Controllers\ClientController();
            $request = new \Illuminate\Http\Request();
            $response = $controller->getClients($request);
            
            $currentUser = \Illuminate\Support\Facades\Auth::user();
            $totalClients = \App\Models\Client::count();
            $userClients = \App\Models\Client::where('user_id', \Illuminate\Support\Facades\Auth::id())->count();
            $allClientsWithUsers = \App\Models\Client::with('user')->get();
            
            return response()->json([
                'test_result' => 'success',
                'response_content' => json_decode($response->getContent(), true),
                'current_user' => $currentUser ? [
                    'id' => $currentUser->id,
                    'name' => $currentUser->name,
                    'email' => $currentUser->email
                ] : null,
                'database_stats' => [
                    'total_clients_in_db' => $totalClients,
                    'user_clients_in_db' => $userClients,
                    'all_clients_sample' => $allClientsWithUsers->take(5)->map(function($client) {
                        return [
                            'id' => $client->id,
                            'client_name' => $client->client_name,
                            'client_email' => $client->client_email,
                            'user_id' => $client->user_id,
                            'user_name' => $client->user ? $client->user->name : 'No user found'
                        ];
                    })
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'test_result' => 'error',
                'error_message' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString(),
                'current_user' => \Illuminate\Support\Facades\Auth::user(),
                'auth_check' => \Illuminate\Support\Facades\Auth::check()
            ]);
        }
    })->name('test.client.api');
    
    // Test route for client creation
    Route::post('/test-client-create', function(\Illuminate\Http\Request $request) {
        try {
            $controller = new \App\Http\Controllers\ClientController();
            $response = $controller->storeApi($request);
            
            return response()->json([
                'test_result' => 'success',
                'create_response' => json_decode($response->getContent(), true),
                'request_data' => $request->all(),
                'current_user' => \Illuminate\Support\Facades\Auth::user()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'test_result' => 'error',
                'error_message' => $e->getMessage(),
                'error_trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'current_user' => \Illuminate\Support\Facades\Auth::user()
            ]);
        }
    })->name('test.client.create');
    
    // Debug route to check what routes are loaded
    Route::get('/debug-api-routes', function() {
        $routes = [];
        foreach (\Illuminate\Support\Facades\Route::getRoutes() as $route) {
            if (str_contains($route->uri(), 'api') || str_contains($route->uri(), 'client')) {
                $routes[] = [
                    'method' => implode('|', $route->methods()),
                    'uri' => $route->uri(),
                    'name' => $route->getName(),
                    'action' => $route->getActionName()
                ];
            }
        }
        
        return response()->json([
            'total_routes' => count(\Illuminate\Support\Facades\Route::getRoutes()),
            'api_client_routes' => $routes,
            'api_routes_file_exists' => file_exists(base_path('routes/api.php')),
            'bootstrap_app_content' => file_get_contents(base_path('bootstrap/app.php'))
        ]);
    })->name('debug.api.routes');
    
    // Web-based client API routes (fallback for when API routes don't work)
    Route::get('/web-api/clients', [ClientController::class, 'getClients'])->name('web.api.clients.get');
    Route::post('/web-api/clients', [ClientController::class, 'storeApi'])->name('web.api.clients.store');
    
    // Content saving route for client management
    Route::post('/save-content', [App\Http\Controllers\ContentController::class, 'saveContent'])->name('save.content');
    
    // Popup saving routes with user choice
    Route::post('/save-popups', [App\Http\Controllers\PopupController::class, 'savePopups'])->name('save.popups');
    Route::get('/get-saved-popups', [App\Http\Controllers\PopupController::class, 'getSavedPopups'])->name('get.saved.popups');
    Route::delete('/delete-popups', [App\Http\Controllers\PopupController::class, 'deletePopups'])->name('delete.popups');
    
    // User-centric legal tables routes
    Route::get('/user/legal-tables', [App\Http\Controllers\UserLegalTableController::class, 'index'])
        ->name('user.legal-tables');
    
    // User-centric document viewing routes with user_id (like client-centric structure)
    Route::get('/user/{user}/view-legal-table/{tableName}', [App\Http\Controllers\UserPersonalDocumentController::class, 'show'])
        ->name('user.personal.document.view');
    Route::get('/user/{user}/view-legal-table-french/{tableName}', [App\Http\Controllers\UserPersonalDocumentController::class, 'showFrench'])
        ->name('user.personal.document.view.french');
    
    // User-specific text and popup data routes
    Route::post('/user/annotations', [App\Http\Controllers\UserAnnotationController::class, 'store'])
        ->name('user.annotations.store');
    Route::get('/user/annotations/section', [App\Http\Controllers\UserAnnotationController::class, 'getForSection'])
        ->name('user.annotations.section');
    Route::patch('/user/annotations/{id}', [App\Http\Controllers\UserAnnotationController::class, 'update'])
        ->name('user.annotations.update');
    Route::delete('/user/annotations/{id}', [App\Http\Controllers\UserAnnotationController::class, 'destroy'])
        ->name('user.annotations.destroy');
    
    // User-specific popup routes
    Route::post('/user/popups/save', [App\Http\Controllers\UserPopupController::class, 'save'])
        ->name('user.popups.save');
    Route::get('/user/popups/fetch', [App\Http\Controllers\UserPopupController::class, 'fetch'])
        ->name('user.popups.fetch');
    Route::delete('/user/popups/clear', [App\Http\Controllers\UserPopupController::class, 'clear'])
        ->name('user.popups.clear');
    
    // User template routes
    Route::get('/user/templates', [App\Http\Controllers\UserTemplateController::class, 'index'])
        ->name('user.templates.index');
    Route::post('/user/templates', [App\Http\Controllers\UserTemplateController::class, 'store'])
        ->name('user.templates.store');
    Route::patch('/user/templates/{id}', [App\Http\Controllers\UserTemplateController::class, 'update'])
        ->name('user.templates.update');
    Route::delete('/user/templates/{id}', [App\Http\Controllers\UserTemplateController::class, 'destroy'])
        ->name('user.templates.destroy');
    
    // Payment Details routes
    Route::get('/payment/details', [App\Http\Controllers\PaymentDetailsController::class, 'index'])->name('payment.details');
    Route::post('/payment/subscription/{id}/cancel', [App\Http\Controllers\PaymentDetailsController::class, 'cancelSubscription'])->name('payment.subscription.cancel');
    Route::get('/payment/subscription/activate/{packageId}', [App\Http\Controllers\PaymentDetailsController::class, 'activateNewPackage'])->name('payment.subscription.activate');
});

// Notes routes with minimal middleware for AJAX requests
Route::middleware(['auth'])->group(function () {
    Route::post('/save-notes', [App\Http\Controllers\NotesController::class, 'saveNotes'])->name('save.notes');
    Route::get('/get-saved-notes', [App\Http\Controllers\NotesController::class, 'getSavedNotes'])->name('get.saved.notes');
    Route::delete('/delete-notes', [App\Http\Controllers\NotesController::class, 'deleteNotes'])->name('delete.notes');
});

Route::middleware(\App\Http\Middleware\Authenticate::class)->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Add an alias route for backward compatibility
// Route::get('/legal-tables/{id}', [ClientController::class, 'viewLegalTable'])->name('client.legalTables');
Route::get('/view-legal-table/{table}', [App\Http\Controllers\ViewLegalTableController::class, 'show'])
    ->name('view.legal.table');

// API routes for legal table content - no redirect, always return JSON
Route::group(['middleware' => ['api'], 'prefix' => 'api'], function () {
    Route::get('/section-content/{tableId}/{sectionRef}', [App\Http\Controllers\ViewLegalTableController::class, 'getSectionContent'])
        ->name('api.section-content')
        ->middleware('App\Http\Middleware\JsonAuthenticate')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
        
    Route::get('/reference/{referenceId}', [App\Http\Controllers\ViewLegalTableController::class, 'fetchReferenceById'])
        ->name('api.reference.fetch')
        ->middleware('App\Http\Middleware\JsonAuthenticate')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
        
    Route::post('/annotations', [App\Http\Controllers\ViewLegalTableController::class, 'saveAnnotation'])
        ->name('api.annotations.save')
        ->middleware('App\Http\Middleware\JsonAuthenticate')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
        
    Route::delete('/annotations/{id}', [App\Http\Controllers\ViewLegalTableController::class, 'deleteAnnotation'])
        ->name('api.annotations.delete')
        ->middleware('App\Http\Middleware\JsonAuthenticate')
        ->withoutMiddleware([\App\Http\Middleware\VerifyCsrfToken::class]);
});

// Editor routes
Route::post('/editor/save', [App\Http\Controllers\EditorController::class, 'save'])->name('editor.save');
Route::get('/editor/load', [App\Http\Controllers\EditorController::class, 'load'])->name('editor.load');

require __DIR__.'/auth.php';



use Illuminate\Support\Facades\Artisan;

Route::get('/clear-config', function () {
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    return '✅ Config cache cleared. You can now delete this route.';
});
