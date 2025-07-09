<?php

require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';

// Get users with images
$users = \App\Models\User::where('approval_status', 'pending')
    ->whereNotNull('student_id_file')
    ->orWhereNotNull('profile_image')
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
        $profileExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($user->profile_image);
        echo "Profile Image Exists: " . ($profileExists ? 'YES' : 'NO') . "\n";
        echo "Profile URL: " . \Illuminate\Support\Facades\Storage::url($user->profile_image) . "\n";
    }
    
    if ($user->student_id_file) {
        $studentIdExists = \Illuminate\Support\Facades\Storage::disk('public')->exists($user->student_id_file);
        echo "Student ID Exists: " . ($studentIdExists ? 'YES' : 'NO') . "\n";
        echo "Student ID URL: " . \Illuminate\Support\Facades\Storage::url($user->student_id_file) . "\n";
    }
    
    echo "-------------------\n";
}
