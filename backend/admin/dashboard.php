<?php

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

include('../includes/header.php');

?>

<div class="container mt-5">
    <h1 class="display-1">Dashboard</h1><br>
    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pages Management</h5>
                    <br>
                    <a href="../pages/pages.php" class="btn btn-primary" data-mdb-ripple-init>Manage Pages</a>&emsp;
                    <a href="../pages/pages_add.php" class="btn btn-secondary" data-mdb-ripple-init>Add New Pages</a><br>
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['name']) && $_SESSION['name'] === 'admin') { ?>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Users Management</h5>
                    <br>
                    <a href="../users/manage_users.php" class="btn btn-primary" data-mdb-ripple-init>Manage Users</a>&emsp;
                    <a href="../users/users_add.php" class="btn btn-secondary" data-mdb-ripple-init>Add New User</a><br>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
    
    <br>

    <div class="row justify-content-center">
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Gallery Management</h5>
                    <br>
                    <a href="../gallery/gallery_image2.php" class="btn btn-primary" data-mdb-ripple-init>Manage Gallery</a>&emsp;
                    <!-- <a href="../gallery/add_image.php" class="btn btn-secondary" data-mdb-ripple-init>Add New Image</a><br> -->
                </div>
            </div>
        </div>

        <?php if (isset($_SESSION['name']) && $_SESSION['name'] === 'admin') { ?>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Contact-Form Mails</h5>
                    <br>
                    <a href="../mails/check_mails.php" class="btn btn-primary" data-mdb-ripple-init>Check Emails</a>&emsp;
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>


<?php include('../includes/footer.php'); ?>

<!-- CREATE USER 'cms'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'cms'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `cms`;GRANT ALL PRIVILEGES ON `cms`.* TO 'cms'@'localhost';GRANT ALL PRIVILEGES ON `cms\_%`.* TO 'cms'@'localhost'; -->

<!-- CREATE TABLE `cms`.`users` (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `active` BOOLEAN NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->

<!-- CREATE TABLE `cms`.`posts` (`id` INT(10) NOT NULL AUTO_INCREMENT , `title` VARCHAR(200) NOT NULL , `content` TEXT NOT NULL , `author` INT NOT NULL , `date` DATE NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->
