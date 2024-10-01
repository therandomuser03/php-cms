<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Content Management System</title>
    <!-- Font Awesome -->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    />
    <!-- Google Fonts Roboto -->
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap"
    />
    <!-- MDB -->
    <link rel="stylesheet" href="../includes/assets/css/mdb.min.css" />
    <link rel="stylesheet" href="../includes/assets/css/easy_toast.css" />
</head>
<body>
    
<?php


if (session_status() === PHP_SESSION_NONE) {
  session_start();
}


function display_login_logout() {
  if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {
      echo '<li class="nav-item">
                <a class="nav-link" href="../admin/logout.php">Logout</a>
            </li>';
  } else {
      echo '<li class="nav-item">
                <a class="nav-link" href="#">Login</a>
            </li>';
  }
}

// $_SESSION['logged_in'] = true;

// unset($_SESSION['logged_in']);

// Show the navbar only if the user is logged in
if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true) {

?>

<nav class="navbar navbar-expand-lg navbar-light bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CMS</a>
    <button
      data-mdb-collapse-init
      class="navbar-toggler"
      type="button"
      data-mdb-target="#navbarNav"
      aria-controls="navbarNav"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <i class="fas fa-bars"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="../admin/dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <?php display_login_logout(); ?>
        </li>
      </ul>
    </div>  
  </div>  
</nav>
<?php
}
?>
<div style="display: flex; justify-content: space-between; padding: 10px;">
  <button onclick="window.history.back();" style="padding: 0px 20px; font-size: 16px; cursor: pointer; border-radius: 8px;">Back</button>
  <button onclick="window.history.forward();" style="padding: 0px 20px; font-size: 16px; cursor: pointer; border-radius: 8px;">Forward</button>
</div>