<?php
session_start();
require('../../config/database.php'); // Use the correct database configuration

if (isset($_POST) && !empty($_POST['id'])) {
    // Sanitize the input
    $id = intval($_POST['id']);

    // Select the image to delete from the database
    $sql_select = "SELECT url FROM gallery WHERE sl_no = $id";
    $select_result = mysqli_query($connect, $sql_select);

    if ($select_result && mysqli_num_rows($select_result) > 0) {
        $row = mysqli_fetch_assoc($select_result); // Fetch as associative array
        $image_name = $row['url'];

        // Code to unlink (delete) the image physically from the folder
        $image_path = "../../backend/gallery/uploads/images/" . $image_name; // Adjusted path
        if (file_exists($image_path)) {
            $unl = unlink($image_path);

            if ($unl) {
                // Delete the image record from the database
                $sql_delete = "DELETE FROM gallery WHERE sl_no = $id";
                $delete_result = mysqli_query($connect, $sql_delete);

                if ($delete_result) {
                    $_SESSION['success'] = 'Image deleted successfully.';
                } else {
                    $_SESSION['error'] = 'Failed to delete image from the database: ' . mysqli_error($connect);
                }
            } else {
                $_SESSION['error'] = 'Failed to delete image from the folder.';
            }
        } else {
            $_SESSION['error'] = 'Image file does not exist.';
        }
    } else {
        $_SESSION['error'] = 'Image not found in the database.';
    }

    header("Location: ../../frontend/index.php?sl_no=6");
} else {
    $_SESSION['error'] = 'Please select an image to delete.';
    header("Location: ../../frontend/index.php?sl_no=6");
}
?>
