<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTextData;

class UserAnnotationController extends Controller
{
    /**
     * Store user annotation
     */
    public function store(Request $request)
    {
        $request->validate([
            'table_name' => 'required|string',
            'category_id' => 'required|string',
            'section' => 'required|string',
            'text' => 'required|string'
        ]);

        $userTextData = UserTextData::getOrCreateForUser(
            auth()->id(),
            $request->table_name,
            $request->category_id
        );

        // Get existing content and add new annotation
        $content = $userTextData->text_content ?? [];
        $content[$request->section] = $request->text;

        $userTextData->update(['text_content' => $content]);

        return response()->json([
            'success' => true,
            'message' => 'Annotation saved successfully'
        ]);
    }

    /**
     * Get annotations for a specific section
     */
    public function getForSection(Request $request)
    {
        $request->validate([
            'table_name' => 'required|string',
            'category_id' => 'required|string',
            'section' => 'required|string'
        ]);

        $userTextData = UserTextData::where('user_id', auth()->id())
            ->where('table_name', $request->table_name)
            ->where('category_id', $request->category_id)
            ->first();

        $text = '';
        if ($userTextData && isset($userTextData->text_content[$request->section])) {
            $text = $userTextData->text_content[$request->section];
        }

        return response()->json([
            'success' => true,
            'text' => $text
        ]);
    }

    /**
     * Update user annotation
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'section' => 'required|string',
            'text' => 'required|string'
        ]);

        $userTextData = UserTextData::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$userTextData) {
            return response()->json([
                'success' => false,
                'message' => 'Annotation not found'
            ], 404);
        }

        $content = $userTextData->text_content ?? [];
        $content[$request->section] = $request->text;

        $userTextData->update(['text_content' => $content]);

        return response()->json([
            'success' => true,
            'message' => 'Annotation updated successfully'
        ]);
    }

    /**
     * Delete user annotation
     */
    public function destroy(Request $request, $id)
    {
        $request->validate([
            'section' => 'required|string'
        ]);

        $userTextData = UserTextData::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$userTextData) {
            return response()->json([
                'success' => false,
                'message' => 'Annotation not found'
            ], 404);
        }

        $content = $userTextData->text_content ?? [];
        unset($content[$request->section]);

        $userTextData->update(['text_content' => $content]);

        return response()->json([
            'success' => true,
            'message' => 'Annotation deleted successfully'
        ]);
    }
}
