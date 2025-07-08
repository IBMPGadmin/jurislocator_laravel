<?php

use Illuminate\Support\Facades\Route;

// Simple test route to verify API routing works
Route::get('/test-route', function () {
    return response()->json(['message' => 'Test route works!']);
});

// Check if our API routes are accessible
Route::get('/debug-routes', function () {
    $routes = [];
    foreach (Route::getRoutes() as $route) {
        if (str_starts_with($route->uri(), 'api/')) {
            $routes[] = [
                'method' => implode('|', $route->methods()),
                'uri' => $route->uri(),
                'name' => $route->getName(),
                'action' => $route->getActionName()
            ];
        }
    }
    
    return response()->json([
        'api_routes_found' => count($routes),
        'routes' => $routes
    ]);
});
