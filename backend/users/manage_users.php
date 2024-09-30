<?php
session_start();

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

include('../includes/header.php');


if (isset($_GET['delete'])) {

    if ($stm = $connect->prepare('DELETE FROM login WHERE sl_no = ?')) {
        $stm->bind_param('i', $_GET['delete']); 
        $stm->execute();

        set_message("User with ID " . $_GET['delete'] . " has been deleted");
        header('Location: manage_users.php');
        $stm->close();
        die();
    } else {
        echo 'Could not prepare statement!';
    }
}


if ($stm = $connect->prepare('SELECT * FROM login')) {
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
?>

<div class="container mt-5">

    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="display-1">Users Management</h1>
            <a href="users_add.php" class="btn btn-secondary">Add new user</a><br><br>
            <table class="table table-striped table-hover">
                <tr style="text-align: center;">
                    <th>Sl. No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Edit | Delete</th>
                </tr>

                <?php while ($record = $result->fetch_assoc()) { ?>
                <tr style="text-align: center;">
                    <td><?php echo $record['sl_no']; ?></td>
                    <td><?php echo $record['name']; ?></td>
                    <td><?php echo $record['email']; ?></td>
                    <td><?php echo $record['phone']; ?></td>
                    <td><?php echo ucfirst($record['status']); ?></td> 
                    <td>
                        <a href="users_edit.php?id=<?php echo $record['sl_no']; ?>">Edit</a> |
                        <a href="users.php?delete=<?php echo $record['sl_no']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php
    } else {
        echo 'No users found';
    }

    $stm->close();
} else {
    echo 'Could not prepare statement!';
}

include('../includes/footer.php');
?>
