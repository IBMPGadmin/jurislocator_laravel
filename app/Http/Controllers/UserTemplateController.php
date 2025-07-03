<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserTemplate;

class UserTemplateController extends Controller
{
    /**
     * Get all user templates
     */
    public function index(Request $request)
    {
        $templates = UserTemplate::forUser(auth()->id())
            ->active()
            ->when($request->type, function ($query) use ($request) {
                return $query->byType($request->type);
            })
            ->orderBy('created_at', 'desc')
            ->get();

        return response()->json([
            'success' => true,
            'templates' => $templates
        ]);
    }

    /**
     * Store new user template
     */
    public function store(Request $request)
    {
        $request->validate([
            'template_name' => 'required|string|max:255',
            'template_content' => 'required|array',
            'template_type' => 'string|in:document,email,note'
        ]);

        $template = UserTemplate::create([
            'user_id' => auth()->id(),
            'template_name' => $request->template_name,
            'template_content' => $request->template_content,
            'template_type' => $request->template_type ?? 'document',
            'is_active' => true
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Template created successfully',
            'template' => $template
        ]);
    }

    /**
     * Update user template
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'template_name' => 'string|max:255',
            'template_content' => 'array',
            'template_type' => 'string|in:document,email,note',
            'is_active' => 'boolean'
        ]);

        $template = UserTemplate::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$template) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found'
            ], 404);
        }

        $template->update($request->only([
            'template_name',
            'template_content', 
            'template_type',
            'is_active'
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Template updated successfully',
            'template' => $template
        ]);
    }

    /**
     * Delete user template
     */
    public function destroy($id)
    {
        $template = UserTemplate::where('user_id', auth()->id())
            ->where('id', $id)
            ->first();

        if (!$template) {
            return response()->json([
                'success' => false,
                'message' => 'Template not found'
            ], 404);
        }

        $template->delete();

        return response()->json([
            'success' => true,
            'message' => 'Template deleted successfully'
        ]);
    }
}
