<?php
session_start();
require('../../config/database.php'); // This will include the $connect variable

$targetDir = "uploads/images/";

if (isset($_POST) && !empty($_FILES['image']['name']) && !empty($_POST['title'])) {

    $fileName = basename($_FILES['image']['name']);
    $targetFilePath = $targetDir . time() . "_" . $fileName;
    $fileSize = $_FILES['image']['size']; // Get file size

    // Get the title from the POST request
    $title = $_POST['title'];  // Capture title from form submission
    $url = time() . "_" . $fileName; // Set the URL for the image (this could also be $fileName)

    // Allow certain file formats (for safety)
    $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
    $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

    if (in_array($fileType, $allowTypes)) {
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFilePath)) {

            // Prepare file size in a human-readable format
            $sizeInKB = round($fileSize / 1024, 2) . ' KB';

            // Insert into the `gallery` table using $connect
            $sql = "INSERT INTO gallery (name, url, display, size) VALUES (?, ?, 'yes', ?)";
            if ($stmt = mysqli_prepare($connect, $sql)) {
                mysqli_stmt_bind_param($stmt, "sss", $title, $url, $sizeInKB); // Bind the title, URL, and size
                $result = mysqli_stmt_execute($stmt);

                if ($result) {
                    // Generate a URL-friendly image path
                    $imageUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/' . $targetFilePath;
                    $_SESSION['success'] = 'Image uploaded successfully.';
                    echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
                } else {
                    $_SESSION['error'] = 'Image upload failed in the database.';
                    echo json_encode(['success' => false, 'message' => 'Failed to save image in the database.']);
                }
                mysqli_stmt_close($stmt);
            } else {
                $_SESSION['error'] = 'Database error: ' . mysqli_error($connect);
                echo json_encode(['success' => false, 'message' => 'Database error.']);
            }
        } else {
            $_SESSION['error'] = 'Image upload failed.';
            echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
        }
    } else {
        $_SESSION['error'] = 'Invalid file type. Only JPG, PNG, JPEG, and GIF are allowed.';
        echo json_encode(['success' => false, 'message' => 'Invalid file type.']);
    }
} else {
    $_SESSION['error'] = 'Please select an image and provide a title.';
    echo json_encode(['success' => false, 'message' => 'Missing input.']);
}
?>
