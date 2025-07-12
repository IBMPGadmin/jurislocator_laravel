<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class NotesController extends Controller
{
    /**
     * Save notes to a JSON file instead of database
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveNotes(Request $request)
    {
        try {
            $userId = Auth::id();
            $saveType = $request->save_type;
            $noteTitle = $request->note_title;
            $noteContent = $request->note_content;
            $clientId = $request->client_id;
            
            // Validate required fields
            if (!$userId || !$saveType || !$noteTitle || !$noteContent) {
                return response()->json([
                    'success' => false,
                    'message' => 'Missing required fields'
                ]);
            }
            
            // Validate save type
            if (!in_array($saveType, ['user', 'client'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid save type'
                ]);
            }
            
            // Validate client ID if saving to client
            if ($saveType === 'client' && !$clientId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Client ID is required when saving to client'
                ]);
            }
            
            // Create note object
            $note = [
                'id' => uniqid(),
                'user_id' => $userId,
                'note_title' => $noteTitle,
                'note_content' => $noteContent,
                'context' => $saveType,
                'client_id' => $saveType === 'client' ? $clientId : null,
                'created_at' => now()->toDateTimeString(),
                'updated_at' => now()->toDateTimeString()
            ];
            
            // Create directory for user notes if it doesn't exist
            $directory = 'user_notes/' . $userId;
            if (!Storage::exists($directory)) {
                Storage::makeDirectory($directory);
            }
            
            // Determine file path based on context
            $filename = $saveType === 'user' 
                ? $directory . '/user_notes.json' 
                : $directory . '/client_' . $clientId . '_notes.json';
            
            // Get existing notes
            $existingNotes = [];
            if (Storage::exists($filename)) {
                $existingNotes = json_decode(Storage::get($filename), true) ?? [];
            }
            
            // Add new note to existing notes
            array_unshift($existingNotes, $note);
            
            // Save notes to file
            Storage::put($filename, json_encode($existingNotes));
            
            return response()->json([
                'success' => true,
                'message' => 'Notes saved successfully',
                'note' => $note
            ]);
        } catch (\Exception $e) {
            Log::error('Error saving notes: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error saving notes: ' . $e->getMessage()
            ]);
        }
    }

    /**
     * Get saved notes from JSON file instead of database
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getSavedNotes(Request $request)
    {
        try {
            $userId = Auth::id();
            $fetchType = $request->fetch_type;
            $clientId = $request->client_id;
            
            // Validate required fields
            if (!$userId || !$fetchType) {
                return response()->json([
                    'success' => false,
                    'message' => 'Missing required fields'
                ]);
            }
            
            // Validate fetch type
            if (!in_array($fetchType, ['user', 'client'])) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid fetch type'
                ]);
            }
            
            // Validate client ID if fetching from client
            if ($fetchType === 'client' && !$clientId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Client ID is required when fetching from client'
                ]);
            }
            
            // Determine file path based on context
            $directory = 'user_notes/' . $userId;
            $filename = $fetchType === 'user' 
                ? $directory . '/user_notes.json' 
                : $directory . '/client_' . $clientId . '_notes.json';
            
            // Get notes from file
            $notes = [];
            if (Storage::exists($filename)) {
                $notes = json_decode(Storage::get($filename), true) ?? [];
            }
            
            // Add saved_at attribute for display
            foreach ($notes as &$note) {
                $note['saved_at'] = $note['created_at'];
            }
            
            return response()->json([
                'success' => true,
                'notes' => $notes
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching notes: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error fetching notes: ' . $e->getMessage()
            ]);
        }
    }
}
