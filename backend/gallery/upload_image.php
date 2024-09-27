<?php
$targetDir = "uploads/images/";
$fileName = basename($_FILES["image"]["name"]);
$targetFilePath = $targetDir . $fileName;

// Allow certain file formats (optional, for safety)
$allowTypes = array('jpg', 'png', 'jpeg', 'gif');
$fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

if (in_array($fileType, $allowTypes) && move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
    // Create a URL-friendly path
    $imageUrl = 'https://' . $_SERVER['HTTP_HOST'] . '/' . $targetFilePath;
    echo json_encode(['success' => true, 'imageUrl' => $imageUrl]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to upload image.']);
}
?>
