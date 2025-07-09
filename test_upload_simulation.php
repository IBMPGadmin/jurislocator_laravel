<?php
require_once 'vendor/autoload.php';

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

echo "Testing file upload simulation...\n\n";

// Create a temporary test file
$tempFile = tempnam(sys_get_temp_dir(), 'test_student_id');
file_put_contents($tempFile, 'This is a test student ID file content');

// Create an UploadedFile instance
$uploadedFile = new UploadedFile($tempFile, 'test_student_id.txt', 'text/plain', null, true);

echo "Original file: " . $tempFile . "\n";
echo "Uploaded file name: " . $uploadedFile->getClientOriginalName() . "\n\n";

// Test the storage
$storedPath = $uploadedFile->store('student_ids', 'public');
echo "Stored path: " . $storedPath . "\n";

// Check if file exists
$fullPath = Storage::disk('public')->path($storedPath);
echo "Full storage path: " . $fullPath . "\n";
echo "File exists in storage: " . (Storage::disk('public')->exists($storedPath) ? 'YES' : 'NO') . "\n";

// Check if file exists in public symlink
$publicPath = public_path('storage/' . $storedPath);
echo "Public path: " . $publicPath . "\n";
echo "File exists in public: " . (file_exists($publicPath) ? 'YES' : 'NO') . "\n";

// Generate URL
$url = Storage::disk('public')->url($storedPath);
echo "Generated URL: " . $url . "\n";

// Clean up
Storage::disk('public')->delete($storedPath);
unlink($tempFile);

echo "\nTest completed.\n";
