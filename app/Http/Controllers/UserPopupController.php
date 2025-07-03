<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserPopupData;

class UserPopupController extends Controller
{
    /**
     * Save user popup data
     */
    public function save(Request $request)
    {
        $request->validate([
            'table_name' => 'required|string',
            'category_id' => 'required|string',
            'popups' => 'required|array'
        ]);

        $userPopupData = UserPopupData::getOrCreateForUser(
            auth()->id(),
            $request->table_name,
            $request->category_id
        );

        $userPopupData->update(['popup_data' => $request->popups]);

        return response()->json([
            'success' => true,
            'message' => 'Popups saved successfully'
        ]);
    }

    /**
     * Fetch user popup data
     */
    public function fetch(Request $request)
    {
        $request->validate([
            'table_name' => 'required|string',
            'category_id' => 'required|string'
        ]);

        $userPopupData = UserPopupData::where('user_id', auth()->id())
            ->where('table_name', $request->table_name)
            ->where('category_id', $request->category_id)
            ->first();

        $popups = $userPopupData ? $userPopupData->popup_data : [];

        return response()->json([
            'success' => true,
            'popups' => $popups ?? []
        ]);
    }

    /**
     * Clear user popup data
     */
    public function clear(Request $request)
    {
        $request->validate([
            'table_name' => 'required|string',
            'category_id' => 'required|string'
        ]);

        $userPopupData = UserPopupData::where('user_id', auth()->id())
            ->where('table_name', $request->table_name)
            ->where('category_id', $request->category_id)
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
