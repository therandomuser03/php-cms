<?php
session_start();

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

include('../includes/header.php');

// Fetch the specific mail based on the 'sl_no' passed via GET
if (isset($_GET['sl_no'])) {
    $sl_no = $_GET['sl_no'];

    if ($stm = $connect->prepare('SELECT * FROM contact_form WHERE sl_no = ?')) {
        $stm->bind_param('i', $sl_no);
        $stm->execute();
        $result = $stm->get_result();

        if ($result->num_rows > 0) {
            $record = $result->fetch_assoc();

            // Mark the mail as 'read'
            $updateStm = $connect->prepare('UPDATE contact_form SET `read` = "Yes" WHERE sl_no = ?');
            $updateStm->bind_param('i', $sl_no);
            $updateStm->execute();
            $updateStm->close();
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- <h1>Mail Details</h1> -->
            <h1>From <?php echo htmlspecialchars($record['name']); ?></h1>
            <hr>
            <p><strong>Email :</strong> <a href="mailto:<?php echo htmlspecialchars($record['email']); ?>"><?php echo htmlspecialchars($record['email']); ?></a></p>
            <p><strong>Subject :</strong> <?php echo htmlspecialchars($record['subject']); ?></p><br>
            <?php echo nl2br(htmlspecialchars($record['note'])); ?></p>
        </div>
    </div>
</div>

<?php
        } else {
            echo '<p class="text-center">No mail found.</p>';
        }

        $stm->close();
    } else {
        echo '<p class="text-center">Could not prepare statement!</p>';
    }
} else {
    echo '<p class="text-center">Invalid request.</p>';
}

include('../includes/footer.php');
?>
