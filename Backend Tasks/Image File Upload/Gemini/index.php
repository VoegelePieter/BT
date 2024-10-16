<?php

// Set the allowed file types
$allowedTypes = array('image/jpeg', 'image/png');

// Set the maximum file size in bytes
$maxSize = 5 * 1024 * 1024;

// Set the upload directory
$uploadDir = 'uploads/';

// Check if the file was uploaded
if(isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    // Get the file details
    $tempname = $_FILES['image']['tmp_name'];
    $name = $_FILES['image']['name'];
    $type = $_FILES['image']['type'];
    $size = $_FILES['image']['size'];

    // Validate the file type
    if(!in_array($type, $allowedTypes)) {
        echo 'Invalid file type. Please upload a JPEG or PNG image.';
        exit;
    }

    // Validate the file size
    if($size > $maxSize) {
        echo 'File too large. Maximum file size is 5MB.';
        exit;
    }

    // Generate a unique filename to avoid overwriting existing files
    $uniqueName = uniqid() . '.' . pathinfo($name, PATHINFO_EXTENSION);

    // Move the uploaded file to the specified directory
    if(move_uploaded_file($tempname, $uploadDir . $uniqueName)) {
        echo 'File uploaded successfully!';
    } else {
        echo 'Error uploading file.';
    }
} else {
    echo 'Please select a file to upload.';
}