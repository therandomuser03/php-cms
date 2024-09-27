<?php
include '../backend/includes/pageheader.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />

    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
</head>
<body>

<?php 
if (isset($_GET['sl_no'])) {
    if($stm = $connect->prepare('SELECT * FROM content WHERE sl_no = ?')) {
        $stm->bind_param('i', $_GET['sl_no']);
        $stm->execute();

        $result = $stm->get_result();
        $post = $result->fetch_assoc();

        if ($post) {
?>

<div>
    <?php echo substr($post['contents'], 0); ?>
</div>

<?php
} else {
    echo 'Post not found!';
}
$stm->close();
} else {
    echo 'Could not prepare statement!';
}
} else {
    echo "No post selected.";
}

include '../backend/includes/pagefooter.php';
?>