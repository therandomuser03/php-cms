<?php
session_start(); // Start the session at the beginning

include '../config/database.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $note = htmlspecialchars(trim($_POST['note']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = "Invalid email format";
        header("Location: contact_form.php");
        exit();
    }

    // Save the contact form data into the database
    $stmt = $connect->prepare("INSERT INTO contact_form (name, email, phone, subject, note) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $name, $email, $phone, $subject, $note);

    if ($stmt->execute()) {
        // If database insert is successful
        $_SESSION['message'] = "Your message has been sent successfully.";
    } else {
        $_SESSION['message'] = "Error: Unable to save the data. Please try again.";
    }

    $stmt->close(); // Close the statement
    header("Location: contact_form.php"); // Redirect to the contact form
    exit();
}

$connect->close(); // Close the database connection
