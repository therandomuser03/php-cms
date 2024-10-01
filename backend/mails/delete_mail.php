<?php
session_start();

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

// Check if 'sl_no' is passed via GET
if (isset($_GET['sl_no'])) {
    $sl_no = $_GET['sl_no'];

    // Prepare the SQL statement to delete the specific mail based on 'sl_no'
    if ($stm = $connect->prepare('DELETE FROM contact_form WHERE sl_no = ?')) {
        $stm->bind_param('i', $sl_no);
        if ($stm->execute()) {
            $_SESSION['message'] = "Mail with Sl. No. $sl_no has been successfully deleted.";
        } else {
            $_SESSION['message'] = "Failed to delete mail. Please try again.";
        }
        $stm->close();
    } else {
        $_SESSION['message'] = "Could not prepare the delete statement.";
    }
} else {
    $_SESSION['message'] = "Invalid request. No mail ID specified.";
}

// Redirect back to the check_mails.php page with a message
header('Location: check_mails.php');
exit();

?>
