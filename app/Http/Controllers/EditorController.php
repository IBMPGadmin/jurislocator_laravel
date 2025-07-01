<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EditorController extends Controller
{
    public function save(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'content' => 'required|string'
            ]);

            // Store in session for now
            session(['editor_content' => $request->content]);

            return response()->json([
                'success' => true,
                'message' => 'Content saved successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saving content: ' . $e->getMessage()
            ], 500);
        }
    }

    public function load()
    {
        try {
            // Get content from session
            $content = session('editor_content', '');

            return response()->json([
                'success' => true,
                'content' => $content
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error loading content: ' . $e->getMessage()
            ], 500);
        }
    }
}
