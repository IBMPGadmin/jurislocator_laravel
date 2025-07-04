<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserPopupController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// User popup data routes - require authentication
Route::middleware(['auth'])->group(function () {
    Route::post('/user/popup-data/save', [UserPopupController::class, 'savePopupData']);
    Route::get('/user/popup-data/get', [UserPopupController::class, 'getPopupData']);
    Route::get('/user/popup-data/all', [UserPopupController::class, 'getAllUserPopupData']);
    Route::delete('/user/popup-data/delete', [UserPopupController::class, 'deletePopupData']);
});
