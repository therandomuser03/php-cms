<?php
session_start(); // Ensure the session is started

include '../../config/config.php';
include '../../config/database.php';
include '../../config/functions.php';
secure();

include '../includes/header.php';

// Check if the user is logged in
if (!isset($_SESSION['name'])) {
    die('You must be logged in to manage pages.');
}

// Handle delete action
if (isset($_GET['delete'])) {
    $sl_no = $_GET['delete'];

    // Check if sl_no is valid and numeric
    if (is_numeric($sl_no)) {
        // Prepare delete statement
        if ($stm = $connect->prepare('DELETE FROM content WHERE sl_no = ?')) {
            $stm->bind_param('i', $sl_no);
            $stm->execute();
            $stm->close();

            // Redirect to avoid form resubmission and refresh page
            header('Location: pages_manage.php');
            exit;
        } else {
            echo 'Could not prepare statement!';
        }
    } else {
        echo 'Invalid post ID!';
    }
}

// Fetch all pages
if ($stm = $connect->prepare('SELECT * FROM content')) {
    $stm->execute();
    $result = $stm->get_result();

    if ($result->num_rows > 0) {
?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <h1 class="display-1">Pages Management</h1>
            <a href="pages_add.php" class="btn btn-secondary" data-mdb-ripple-init>Add New Pages</a><br><br>
            <table class="table table-striped table-hover">
                <tr>
                    <th>Sl. No.</th>
                    <th>Title</th>
                    <th>Header Image</th>
                    <th>Content</th>
                    <th>Search Tags</th>
                    <th>Display Status</th>
                    <th>Actions</th>
                </tr>

                <?php while ($record = $result->fetch_assoc()) { ?>
                <tr>
                    <td><?php echo $record['sl_no']; ?></td>
                    <td><a href="../../frontend/index.php?sl_no=<?php echo $record['sl_no']; ?>"><?php echo $record['title']; ?></a></td>
                    <td>
                        <?php 
                        if (!empty($record['header_image'])) {
                            echo '<img src="../assets/uploads/images/' . $record['header_image'] . '" alt="Header Image" style="max-width:100px;">';
                        } else {
                            echo 'No image';
                        }
                        ?>
                    </td>
                    <td><?php echo substr($record['contents'], 0, 100) . '...'; ?></td>
                    <td><?php echo $record['search_tag']; ?></td>
                    <td><?php echo ucfirst($record['display']); ?></td>
                    <td>
                        <a href="pages_edit.php?sl_no=<?php echo $record['sl_no']; ?>">Edit</a> |
                        <!-- <a href="pages_manage.php?delete=<?php echo $record['sl_no']; ?>" onclick="return confirm('Are you sure you want to delete this post?')">Delete</a> -->
                    </td>
                </tr>
                <?php } ?>
            </table>
        </div>
    </div>
</div>

<?php
    } else {
        echo 'No pages found';
    }

    $stm->close();
} else {
    echo 'Could not prepare statement!';
}

include '../includes/footer.php';
?>
