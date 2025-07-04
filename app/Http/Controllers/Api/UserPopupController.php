<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\UserPopupData;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class UserPopupController extends Controller
{
    /**
     * Save user popup data for a specific document
     */
    public function savePopupData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'table_name' => 'required|string',
                'category_id' => 'required|string',
                'popup_data' => 'required|array'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Save or update popup data
            $popupData = UserPopupData::updateOrCreate(
                [
                    'user_id' => $user->id,
                    'table_name' => $request->table_name,
                    'category_id' => $request->category_id,
                ],
                [
                    'popup_data' => $request->popup_data
                ]
            );

            Log::info('User popup data saved', [
                'user_id' => $user->id,
                'table_name' => $request->table_name,
                'category_id' => $request->category_id,
                'popup_count' => count($request->popup_data)
            ]);

            return response()->json([
                'error' => false,
                'message' => 'Popup data saved successfully',
                'data' => $popupData
            ]);

        } catch (\Exception $e) {
            Log::error('Error saving user popup data: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to save popup data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Fetch user popup data for a specific document
     */
    public function getPopupData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'table_name' => 'required|string',
                'category_id' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not authenticated'
                ], 401);
            }

            // Get popup data for the specific document
            $popupData = UserPopupData::forUser($user->id)
                ->forDocument($request->table_name, $request->category_id)
                ->first();

            if (!$popupData) {
                return response()->json([
                    'error' => false,
                    'message' => 'No popup data found',
                    'data' => []
                ]);
            }

            return response()->json([
                'error' => false,
                'message' => 'Popup data retrieved successfully',
                'data' => $popupData->popup_data
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching user popup data: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to fetch popup data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get all popup data for the current user across all documents
     */
    public function getAllUserPopupData()
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $allPopupData = UserPopupData::forUser($user->id)
                ->orderBy('updated_at', 'desc')
                ->get();

            return response()->json([
                'error' => false,
                'message' => 'All popup data retrieved successfully',
                'data' => $allPopupData
            ]);

        } catch (\Exception $e) {
            Log::error('Error fetching all user popup data: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to fetch popup data: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete popup data for a specific document
     */
    public function deletePopupData(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'table_name' => 'required|string',
                'category_id' => 'required|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'error' => true,
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 400);
            }

            $user = Auth::user();
            if (!$user) {
                return response()->json([
                    'error' => true,
                    'message' => 'User not authenticated'
                ], 401);
            }

            $deleted = UserPopupData::forUser($user->id)
                ->forDocument($request->table_name, $request->category_id)
                ->delete();

            if ($deleted) {
                return response()->json([
                    'error' => false,
                    'message' => 'Popup data deleted successfully'
                ]);
            } else {
                return response()->json([
                    'error' => false,
                    'message' => 'No popup data found to delete'
                ]);
            }

        } catch (\Exception $e) {
            Log::error('Error deleting user popup data: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);

            return response()->json([
                'error' => true,
                'message' => 'Failed to delete popup data: ' . $e->getMessage()
            ], 500);
        }
    }
}
