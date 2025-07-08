<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContentController extends Controller
{
    public function saveContent(Request $request)
    {
        $validated = $request->validate([
            'context' => 'required|string|in:user,client',
            'editor_content' => 'nullable|string',
            'droppable_content' => 'nullable|string',
            'client_id' => 'nullable|integer|exists:client_table,id'
        ]);
        
        try {
            // Find existing content or create new
            $content = null;
            
            if ($validated['context'] === 'client' && $validated['client_id']) {
                // Verify the client belongs to the current user
                $client = \App\Models\Client::where('id', $validated['client_id'])
                    ->where('user_id', Auth::id())
                    ->first();
                
                if (!$client) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid client selection'
                    ], 403);
                }
                
                // Find existing client-specific content
                $content = Content::where('user_id', Auth::id())
                    ->where('client_id', $validated['client_id'])
                    ->where('context', 'client')
                    ->first();
                    
                if (!$content) {
                    $content = new Content();
                    $content->user_id = Auth::id();
                    $content->client_id = $validated['client_id'];
                    $content->context = 'client';
                }
            } else {
                // Find existing user content
                $content = Content::where('user_id', Auth::id())
                    ->where('context', 'user')
                    ->whereNull('client_id')
                    ->first();
                    
                if (!$content) {
                    $content = new Content();
                    $content->user_id = Auth::id();
                    $content->context = 'user';
                    $content->client_id = null;
                }
            }
            
            // Update content
            $content->editor_content = $validated['editor_content'];
            $content->droppable_content = $validated['droppable_content'];
            $content->save();
            
            return response()->json([
                'success' => true,
                'message' => 'Content saved successfully',
                'content_id' => $content->id
            ]);
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\Log::error('Error saving content: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Failed to save content. Please try again.'
            ], 500);
        }
    }
}
