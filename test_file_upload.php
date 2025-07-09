<?php
require_once 'vendor/autoload.php';

use Illuminate\Support\Facades\Storage;

// Initialize Laravel
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Testing file upload storage...\n\n";

// Check storage disk configuration
echo "Storage disk 'public' root: " . Storage::disk('public')->path('') . "\n";
echo "Storage disk 'public' URL: " . Storage::disk('public')->url('') . "\n\n";

// Check if student_ids directory exists
$studentIdsPath = Storage::disk('public')->path('student_ids');
echo "Student IDs directory path: " . $studentIdsPath . "\n";
echo "Student IDs directory exists: " . (is_dir($studentIdsPath) ? 'YES' : 'NO') . "\n";

// Create directory if it doesn't exist
if (!is_dir($studentIdsPath)) {
    echo "Creating student_ids directory...\n";
    Storage::disk('public')->makeDirectory('student_ids');
    echo "Directory created: " . (is_dir($studentIdsPath) ? 'YES' : 'NO') . "\n";
}

// List files in student_ids directory
echo "\nFiles in student_ids directory:\n";
$files = Storage::disk('public')->files('student_ids');
foreach ($files as $file) {
    echo "- " . $file . "\n";
}

// Check public/storage symlink
$publicStoragePath = public_path('storage');
echo "\nPublic storage path: " . $publicStoragePath . "\n";
echo "Public storage exists: " . (is_dir($publicStoragePath) ? 'YES' : 'NO') . "\n";

if (is_dir($publicStoragePath)) {
    $publicStudentIdsPath = $publicStoragePath . DIRECTORY_SEPARATOR . 'student_ids';
    echo "Public student_ids path: " . $publicStudentIdsPath . "\n";
    echo "Public student_ids exists: " . (is_dir($publicStudentIdsPath) ? 'YES' : 'NO') . "\n";
    
    if (is_dir($publicStudentIdsPath)) {
        $publicFiles = scandir($publicStudentIdsPath);
        echo "Files in public/storage/student_ids:\n";
        foreach ($publicFiles as $file) {
            if ($file !== '.' && $file !== '..') {
                echo "- " . $file . "\n";
            }
        }
    }
}

echo "\nDone.\n";
