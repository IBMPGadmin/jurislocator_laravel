<?php

use App\Models\User;
use Illuminate\Support\Facades\Storage;

$users = User::where('approval_status', 'pending')
    ->where(function($query) {
        $query->whereNotNull('student_id_file')
              ->orWhereNotNull('profile_image');
    })
    ->select('id', 'first_name', 'last_name', 'profile_image', 'student_id_file')
    ->take(5)
    ->get();

echo "Users with images:\n";
echo "==================\n";

foreach ($users as $user) {
    echo "ID: {$user->id}\n";
    echo "Name: {$user->first_name} {$user->last_name}\n";
    echo "Profile Image: " . ($user->profile_image ?? 'NULL') . "\n";
    echo "Student ID File: " . ($user->student_id_file ?? 'NULL') . "\n";
    
    // Check if files exist
    if ($user->profile_image) {
        $profileExists = Storage::disk('public')->exists($user->profile_image);
        echo "Profile Image Exists: " . ($profileExists ? 'YES' : 'NO') . "\n";
        echo "Profile URL: " . Storage::url($user->profile_image) . "\n";
        
        // Check different path variations
        $altPath1 = str_replace('public/', '', $user->profile_image);
        $altPath2 = 'public/' . $user->profile_image;
        echo "Alt Path 1 ({$altPath1}): " . (Storage::disk('public')->exists($altPath1) ? 'YES' : 'NO') . "\n";
        echo "Alt Path 2 ({$altPath2}): " . (Storage::disk('public')->exists($altPath2) ? 'YES' : 'NO') . "\n";
    }
    
    if ($user->student_id_file) {
        $studentIdExists = Storage::disk('public')->exists($user->student_id_file);
        echo "Student ID Exists: " . ($studentIdExists ? 'YES' : 'NO') . "\n";
        echo "Student ID URL: " . Storage::url($user->student_id_file) . "\n";
        
        // Check different path variations
        $altPath1 = str_replace('public/', '', $user->student_id_file);
        $altPath2 = 'public/' . $user->student_id_file;
        echo "Alt Path 1 ({$altPath1}): " . (Storage::disk('public')->exists($altPath1) ? 'YES' : 'NO') . "\n";
        echo "Alt Path 2 ({$altPath2}): " . (Storage::disk('public')->exists($altPath2) ? 'YES' : 'NO') . "\n";
    }
    
    echo "-------------------\n";
}
