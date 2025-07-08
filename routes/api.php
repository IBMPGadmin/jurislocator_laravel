<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserPopupController;
use App\Http\Controllers\ClientController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User popup data routes - require web authentication (session-based)
Route::middleware(['web', 'auth'])->group(function () {
    Route::post('/user/popup-data/save', [UserPopupController::class, 'savePopupData']);
    Route::get('/user/popup-data/get', [UserPopupController::class, 'getPopupData']);
    Route::get('/user/popup-data/all', [UserPopupController::class, 'getAllUserPopupData']);
    Route::delete('/user/popup-data/delete', [UserPopupController::class, 'deletePopupData']);
    
    // Client management API routes
    Route::get('/clients', [ClientController::class, 'getClients']);
    Route::post('/clients', [ClientController::class, 'storeApi']);
});
