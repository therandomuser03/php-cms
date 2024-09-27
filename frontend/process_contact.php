<?php

include '../config/database.php';

// Prepare the SQL statement to prevent SQL injection
$stmt = $connect->prepare("INSERT INTO contact_form (name, email, phone, subject, note) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("sssss", $name, $email, $phone, $subject, $note);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $phone = htmlspecialchars(trim($_POST['phone']));
    $subject = htmlspecialchars(trim($_POST['subject']));
    $note = htmlspecialchars(trim($_POST['note']));

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION['message'] = "Invalid email format";
        header("Location : contact_form.php");
        exit();
    }

    $to = "therandomuser03@gmail.com";
    $headers = "From: $name <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";

    $mailSent = mail($to, $subject, $note, $headers); // Attempt to send email

    // Execute the statement
    if ($stmt->execute()) {
        $_SESSION['message'] = "Your message has been sent successfully.";

        // Email success message if email was sent
        if ($mailSent) {
            $_SESSION['message'] .= " and the email has been delivered.";
        } else {
            $_SESSION['message'] .= ", but the email delivery failed.";
        }
    } else {
        $_SESSION['message'] = "Error: Unable to save the data. Please try again.";
    }

    $stmt->close(); // Close the statement
    header("Location: contact_form.php"); // Redirect to contact form
    exit();
}

$connect->close(); // Close the database connection
?>