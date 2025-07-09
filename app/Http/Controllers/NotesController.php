<?php

namespace App\Http\Controllers;

use App\Models\ClientNote;
use App\Models\UserPersonalNote;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class NotesController extends Controller
{
    /**
     * Save notes with user choice (user records vs client-specific)
     */
    public function saveNotes(Request $request): JsonResponse
    {
        try {
            // Set content type header to ensure JSON response
            $response = response()->json(['temp' => 'init']);
            $response->header('Content-Type', 'application/json');

            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $validator = Validator::make($request->all(), [
                'save_type' => 'required|string|in:user,client',
                'client_id' => 'nullable|integer|exists:client_table,id',
                'note_title' => 'nullable|string|max:255',
                'note_content' => 'required|string',
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
            $noteTitle = $request->input('note_title');
            $noteContent = $request->input('note_content');

            // Log the request for debugging
            Log::info('Notes save request', [
                'user_id' => $user->id,
                'save_type' => $saveType,
                'client_id' => $clientId,
                'note_title' => $noteTitle,
                'note_content_length' => strlen($noteContent)
            ]);

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
                // Save to user personal notes table
                $this->saveUserPersonalNote($user->id, $noteTitle, $noteContent);
                $message = 'Note saved to your personal records successfully!';
            } else {
                // Save to client-specific notes table
                $this->saveClientSpecificNote($user->id, $clientId, $noteTitle, $noteContent);
                $message = 'Note saved to client-specific records successfully!';
            }

            return response()->json([
                'success' => true,
                'message' => $message
            ]);

        } catch (\Exception $e) {
            Log::error('Error saving note: ' . $e->getMessage(), [
                'user_id' => Auth::id(),
                'request_data' => $request->all(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to save note. Please try again.',
                'debug' => [
                    'error' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine()
                ]
            ], 500);
        }
    }

    /**
     * Save note to user personal records
     */
    private function saveUserPersonalNote($userId, $noteTitle, $noteContent)
    {
        UserPersonalNote::create([
            'user_id' => $userId,
            'note_title' => $noteTitle,
            'note_content' => $noteContent,
            'saved_at' => now()
        ]);
    }

    /**
     * Save note to client-specific records
     */
    private function saveClientSpecificNote($userId, $clientId, $noteTitle, $noteContent)
    {
        ClientNote::create([
            'user_id' => $userId,
            'client_id' => $clientId,
            'note_title' => $noteTitle,
            'note_content' => $noteContent,
            'saved_at' => now()
        ]);
    }

    /**
     * Get saved notes for user or client context
     */
    public function getSavedNotes(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $fetchType = $request->input('fetch_type', 'user');
            $clientId = $request->input('client_id');
            
            if ($fetchType === 'client' && $clientId) {
                // Get client-specific notes
                $clientNotes = ClientNote::where('user_id', $user->id)
                    ->where('client_id', $clientId)
                    ->orderBy('saved_at', 'desc')
                    ->get();
                    
                return response()->json([
                    'success' => true,
                    'notes' => $clientNotes,
                    'type' => 'client'
                ]);
            }
            
            // Get user personal notes
            $userNotes = UserPersonalNote::where('user_id', $user->id)
                ->orderBy('saved_at', 'desc')
                ->get();
                
            return response()->json([
                'success' => true,
                'notes' => $userNotes,
                'type' => 'user'
            ]);

        } catch (\Exception $e) {
            Log::error('Error getting saved notes: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to fetch notes. Please try again.'
            ], 500);
        }
    }

    /**
     * Delete notes permanently from database
     */
    public function deleteNotes(Request $request): JsonResponse
    {
        try {
            $user = Auth::user();
            if (!$user) {
                return response()->json(['success' => false, 'message' => 'User not authenticated'], 401);
            }

            $validator = Validator::make($request->all(), [
                'delete_type' => 'required|string|in:user,client',
                'client_id' => 'nullable|integer|exists:client_table,id',
                'note_id' => 'nullable|integer'
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'success' => false, 
                    'message' => 'Validation failed',
                    'errors' => $validator->errors()
                ], 422);
            }

            $deleteType = $request->input('delete_type');
            $clientId = $request->input('client_id');
            $noteId = $request->input('note_id');

            $deletedCount = 0;

            if ($deleteType === 'client' && $clientId) {
                if ($noteId) {
                    // Delete specific client note
                    $deletedCount = ClientNote::where('user_id', $user->id)
                        ->where('client_id', $clientId)
                        ->where('id', $noteId)
                        ->delete();
                } else {
                    // Delete all client notes
                    $deletedCount = ClientNote::where('user_id', $user->id)
                        ->where('client_id', $clientId)
                        ->delete();
                }
            } else {
                if ($noteId) {
                    // Delete specific user note
                    $deletedCount = UserPersonalNote::where('user_id', $user->id)
                        ->where('id', $noteId)
                        ->delete();
                } else {
                    // Delete all user notes
                    $deletedCount = UserPersonalNote::where('user_id', $user->id)
                        ->delete();
                }
            }

            Log::info("User {$user->id} deleted {$deletedCount} note(s)" . ($clientId ? " for client {$clientId}" : " from personal records"));

            return response()->json([
                'success' => true,
                'message' => "Successfully deleted {$deletedCount} note" . ($deletedCount !== 1 ? 's' : '') . " permanently.",
                'deleted_count' => $deletedCount,
                'type' => $deleteType
            ]);

        } catch (\Exception $e) {
            Log::error('Error deleting notes: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete notes permanently. Please try again.'
            ], 500);
        }
    }
}
