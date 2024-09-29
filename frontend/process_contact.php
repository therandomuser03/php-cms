<?php
// Include PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../backend/phpmailer/src/Exception.php';
require '../backend/phpmailer/src/PHPMailer.php';
require '../backend/phpmailer/src/SMTP.php';

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
        // If database insert is successful, proceed with sending the email
        $_SESSION['message'] = "Your message has been sent successfully.";

        // Send email using PHPMailer
        $mail = new PHPMailer(true);
        try {
            // SMTP configuration
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com'; // Use your SMTP server (Gmail, etc.)
            $mail->SMTPAuth   = true;
            $mail->Username   = 'your-email@gmail.com'; // Your email address
            $mail->Password   = 'your-email-password'; // Your email password
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;

            // Email headers and content
            $mail->setFrom($email, $name); // Sender's email and name
            $mail->addAddress('therandomuser03@gmail.com'); // Recipient's email

            // Email subject and body
            $mail->Subject = $subject;
            $mail->Body    = "Name: $name\nEmail: $email\nPhone: $phone\n\nMessage:\n$note";

            // Send the email
            if ($mail->send()) {
                $_SESSION['message'] .= " Email has been delivered.";
            } else {
                $_SESSION['message'] .= " Email delivery failed.";
            }
        } catch (Exception $e) {
            $_SESSION['message'] .= " Error: {$mail->ErrorInfo}";
        }
    } else {
        $_SESSION['message'] = "Error: Unable to save the data. Please try again.";
    }

    $stmt->close(); // Close the statement
    header("Location: contact_form.php"); // Redirect to the contact form
    exit();
}

$connect->close(); // Close the database connection
