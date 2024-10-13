<?php
// Directory where the uploaded files will be saved
$target_dir = "uploads/";

// Ensure the uploads directory exists
if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
}

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $file = $_FILES['file'];

    // Check if file was uploaded without errors
    if ($file['error'] == UPLOAD_ERR_OK) {
        $file_name = basename($file['name']);
        $file_size = $file['size'];
        $file_tmp = $file['tmp_name'];
        $file_type = mime_content_type($file_tmp);

        // Validate file type (JPEG or PNG)
        $allowed_types = ['image/jpeg', 'image/png'];
        if (!in_array($file_type, $allowed_types)) {
            echo "Error: Only JPEG and PNG files are allowed.";
            exit;
        }

        // Validate file size (max 5MB)
        $max_size = 5 * 1024 * 1024; // 5MB in bytes
        if ($file_size > $max_size) {
            echo "Error: File size exceeds 5MB.";
            exit;
        }

        // Move the uploaded file to the target directory
        $target_file = $target_dir . $file_name;
        if (move_uploaded_file($file_tmp, $target_file)) {
            echo "The file " . htmlspecialchars($file_name) . " has been uploaded successfully.";
        } else {
            echo "Error: There was an error uploading your file.";
        }
    } else {
        echo "Error: " . $file['error'];
    }
} else {
    echo "No file uploaded.";
}
?>