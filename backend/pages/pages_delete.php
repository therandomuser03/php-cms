<?php
session_start(); // Ensure the session is started

include '../../config/config.php';
include '../../config/database.php';
include '../../config/functions.php';
secure(); // Assuming this checks user permissions

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    die('You must be logged in to delete pages.');
}

// Check if the delete action is called
if (isset($_GET['delete'])) {
    $sl_no = $_GET['delete'];

    // Validate the 'sl_no' parameter
    if (is_numeric($sl_no)) {

        // Prepare the delete statement
        if ($stm = $connect->prepare('DELETE FROM content WHERE sl_no = ?')) {
            $stm->bind_param('i', $sl_no);
            $stm->execute();

            if ($stm->affected_rows > 0) {
                // Record deleted successfully
                echo '<div class="alert alert-success">Page deleted successfully.</div>';
            } else {
                // If the sl_no does not exist
                echo '<div class="alert alert-warning">No page found with that ID.</div>';
            }

            $stm->close();
        } else {
            echo '<div class="alert alert-danger">Could not prepare statement!</div>';
        }
    } else {
        echo '<div class="alert alert-danger">Invalid page ID.</div>';
    }

    // Redirect back to pages management after deletion
    header('Location: pages.php');
    exit;
} else {
    echo '<div class="alert alert-danger">No page ID provided for deletion.</div>';
}
?>
