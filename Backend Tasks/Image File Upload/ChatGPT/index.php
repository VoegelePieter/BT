<?php
// Directory where the file will be stored
$targetDirectory = "uploads/";
// Ensure the directory exists
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

// Check if the file has been uploaded via POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['image'])) {
    $file = $_FILES['image'];

    // Check for upload errors
    if ($file['error'] != 0) {
        die("Error uploading file: " . $file['error']);
    }

    // Validate file size (5MB maximum)
    $maxSize = 5 * 1024 * 1024; // 5MB in bytes
    if ($file['size'] > $maxSize) {
        die("Error: File size is larger than the allowed limit.");
    }

    // Validate file type (JPEG and PNG)
    $validTypes = ['image/jpeg', 'image/png'];
    if (!in_array($file['type'], $validTypes)) {
        die("Error: Invalid file type. Only JPEG and PNG are allowed.");
    }

    // Set the target path for storing the file
    $targetFilePath = $targetDirectory . basename($file['name']);

    // Move the file from the temporary location to the target directory
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        echo "File uploaded successfully to {$targetFilePath}";
    } else {
        die("Error moving the uploaded file.");
    }
} else {
    die("No file uploaded or invalid request.");
}

?>
