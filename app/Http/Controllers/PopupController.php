<?php

namespace App\Http\Controllers;

use App\Models\ClientSidebarData;
use App\Models\UserPersonalPopup;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class PopupController extends Controller
{
    /**
     * Save popups with user choice (user records vs client-specific)
     */
    public function savePopups(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $validator = Validator::make($request->all(), [
                'save_type' => 'required|string|in:user,client',
                'client_id' => 'nullable|integer|exists:client_table,id',
                'popups' => 'required|array',
                'popups.*.section_id' => 'required|string',
                'popups.*.category_id' => 'required|integer',
                'popups.*.part' => 'nullable|string',
                'popups.*.division' => 'nullable|string',
                'popups.*.popup_title' => 'nullable|string',
                'popups.*.popup_content' => 'nullable|string',
                'popups.*.section_title' => 'nullable|string',
                'popups.*.table_name' => 'nullable|string'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $saveType = $request->input('save_type');
            $clientId = $request->input('client_id');
            $popups = $request->input('popups', []);

            // Validate client ownership if saving as client-specific
            if ($saveType === 'client') {
                if (!$clientId) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Client ID is required when saving as client-specific'
                    ], 422);
                }

                // Verify client belongs to user
                $client = \App\Models\Client::where('id', $clientId)
                    ->where('user_id', $user->id)
                    ->first();
                
                if (!$client) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid client selection or access denied'
                    ], 403);
                }
            }

            if ($saveType === 'user') {
                // Save to user personal popups table
                $this->saveUserPersonalPopups($user->id, $popups);
                $message = 'Popups saved to your personal records successfully!';
            } else {
                // Save to client-specific popups table
                $this->saveClientSpecificPopups($user->id, $clientId, $popups);
                $message = 'Popups saved to client-specific records successfully!';
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            Log::error('Error saving popups: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to save popups. Please try again.'
            ], 500);
        }
    }

    /**
     * Save popups to user personal records
     */
    private function saveUserPersonalPopups($userId, $popups)
    {
        // Delete existing user personal popups for this user
        UserPersonalPopup::where('user_id', $userId)->delete();

        // Insert new popups
        foreach ($popups as $popup) {
            UserPersonalPopup::create([
                'user_id' => $userId,
                'section_id' => $popup['section_id'],
                'category_id' => $popup['category_id'],
                'part' => $popup['part'] ?? null,
                'division' => $popup['division'] ?? null,
                'popup_title' => $popup['popup_title'] ?? null,
                'popup_content' => $popup['popup_content'] ?? null,
                'section_title' => $popup['section_title'] ?? null,
                'table_name' => $popup['table_name'] ?? null,
                'pinned_at' => now()
            ]);
        }
    }

    /**
     * Save popups to client-specific records
     */
    private function saveClientSpecificPopups($userId, $clientId, $popups)
    {
        // Delete existing client-specific popups for this user and client
        ClientSidebarData::where('user_id', $userId)
            ->where('client_id', $clientId)
            ->delete();

        // Insert new popups
        foreach ($popups as $popup) {
            ClientSidebarData::create([
                'user_id' => $userId,
                'client_id' => $clientId,
                'section_id' => $popup['section_id'],
                'category_id' => $popup['category_id'],
                'part' => $popup['part'] ?? null,
                'division' => $popup['division'] ?? null,
                'popup_title' => $popup['popup_title'] ?? null,
                'popup_content' => $popup['popup_content'] ?? null,
                'section_title' => $popup['section_title'] ?? null,
                'table_name' => $popup['table_name'] ?? null,
                'pinned_at' => now()
            ]);
        }
    }

    /**
     * Get saved popups for user or client context
     */
    public function getSavedPopups(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $clientId = $request->input('client_id');
            
            if ($clientId) {
                // Get client-specific popups first, fallback to user personal
                $clientPopups = ClientSidebarData::where('user_id', $user->id)
                    ->where('client_id', $clientId)
                    ->orderBy('pinned_at', 'desc')
                    ->get();
                    
                if ($clientPopups->isNotEmpty()) {
                    return response()->json([
                        'success' => true,
                        'popups' => $clientPopups,
                        'type' => 'client'
                    ]);
                }
            }
            
            // Get user personal popups
            $userPopups = UserPersonalPopup::where('user_id', $user->id)
                ->orderBy('pinned_at', 'desc')
                ->get();
                
            return response()->json([
                'success' => true,
                'popups' => $userPopups,
                'type' => 'user'
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting saved popups: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to load saved popups.'
            ], 500);
        }
    }
}
