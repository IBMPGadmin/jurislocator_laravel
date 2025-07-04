<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPopupData;
use Illuminate\Support\Facades\Auth;

class UserPopupController extends Controller
{
    /**
     * Save user popup data (user-wide, not document-specific)
     */
    public function save(Request $request)
    {
        $request->validate([
            'popups' => 'required|array'
        ]);

        $userPopupData = UserPopupData::getOrCreateForUser(
            Auth::id(),
            'user_global', // Use a global key instead of specific table
            'all' // Use 'all' as category to indicate global scope
        );

        $userPopupData->update(['popup_data' => $request->popups]);

        return response()->json([
            'success' => true,
            'message' => 'Popups saved successfully'
        ]);
    }

    /**
     * Fetch user popup data (user-wide, not document-specific)
     */
    public function fetch(Request $request)
    {
        $userPopupData = UserPopupData::where('user_id', Auth::id())
            ->where('table_name', 'user_global')
            ->where('category_id', 'all')
            ->first();

        $popups = $userPopupData ? $userPopupData->popup_data : [];

        return response()->json([
            'success' => true,
            'popups' => $popups ?? []
        ]);
    }

    /**
     * Clear user popup data (user-wide, not document-specific)
     */
    public function clear(Request $request)
    {
        $userPopupData = UserPopupData::where('user_id', Auth::id())
            ->where('table_name', 'user_global')
            ->where('category_id', 'all')
            ->first();

        if ($userPopupData) {
            $userPopupData->update(['popup_data' => []]);
        }

        return response()->json([
            'success' => true,
            'message' => 'Popups cleared successfully'
        ]);
    }
}
