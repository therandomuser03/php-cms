<?php
require('../../config/database.php'); // Include database connection

if (isset($_POST['sl_no']) && isset($_POST['current_display'])) {
    $sl_no = $_POST['sl_no'];
    $current_display = $_POST['current_display'];
    $new_display = ($current_display == 'yes') ? 'no' : 'yes';

    // Update the display status in the database
    $sql = "UPDATE gallery SET display = ? WHERE sl_no = ?";
    if ($stmt = mysqli_prepare($connect, $sql)) {
        mysqli_stmt_bind_param($stmt, 'si', $new_display, $sl_no);
        if (mysqli_stmt_execute($stmt)) {
            header("Location: gallery_image2.php"); // Redirect back to gallery page
        } else {
            echo "Error: " . mysqli_error($connect);
        }
        mysqli_stmt_close($stmt);
    }
}
?>
