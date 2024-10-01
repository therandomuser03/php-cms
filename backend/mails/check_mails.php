<?php
session_start();

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

include('../includes/header.php');

if ($stm = $connect->prepare('SELECT * FROM contact_form')) {
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
?>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="display-1">Contact Mails From People</h1>
            <!-- <a href="users_add.php" class="btn btn-secondary">Add new user</a> --> <br>
            <table class="table table-striped table-hover">
                <tr style="text-align: center;">
                    <th>Sl. No.</th>
                    <th>Name</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Read?</th>
                    <!-- <th>Delete</th> -->
                </tr>

                <?php while ($record = $result->fetch_assoc()) { ?>
                <tr style="text-align: center;">
                    <td><?php echo $record['sl_no']; ?></td>
                    <td><?php echo $record['name']; ?></td>
                    <td><?php echo $record['subject']; ?></a></td>
                    <td><a href="view_mail.php?sl_no=<?php echo $record['sl_no']; ?>"><?php echo substr($record['note'], 0, 42) . '...'; ?></a></td>
                    <td><?php echo $record['email']; ?></td>
                    <td><?php echo $record['phone']; ?></td>
                    <td><?php echo ucfirst($record['read']); ?></td> 
                    <td>
    <?php if (strtolower($record['read']) == 'yes') { ?>
        <a href="delete_mail.php?sl_no=<?php echo $record['sl_no']; ?>" onclick="return confirm('Are you sure you want to delete this mail?');">Delete</a>
    <?php } ?>
</td>

                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php
    } else {
        echo 'No mails found';
    }

    $stm->close();
} else {
    echo 'Could not prepare statement!';
}

include('../includes/footer.php');
?>
