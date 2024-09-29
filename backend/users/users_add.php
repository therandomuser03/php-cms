<?php

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

include('../includes/header.php');

if (isset($_POST['username'])){

    if ($stm = $connect->prepare('INSERT INTO login (name, email, password, access) VALUES (?, ?, ?, ?)')){
        $hashed = SHA1($_POST['password']);
        $stm->bind_param('ssss', $_POST['name'], $_POST['email'], $hashed, $_POST['access']);
        $stm->execute();

        set_message("A new user " . $_POST['name'] . " has been added");
        header('Location: users.php');
        $stm->close();
        die();
    } else {
        echo 'Could not prepare statement!';
    }
}


?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <h1 class="display-1">Add User</h1>
            
            <form method="post">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="name" name="name" class="form-control" />
                    <label class="form-label" for="name">Username</label>
                </div>
                
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>
                
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>
                
                <!-- Active select -->
                <div class="form-outline mb-4">
                    <label for="access">Access</label>
                    <select name="active" class="form-select" id="access">
                        <option value="1">Yes</option>
                        <option value="0">No</option>    
                    </select>
                </div>
                
                
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Add user</button>
            </form>
            
        </div>
    </div>
</div>

<?php


include('../includes/footer.php');
?>


<!-- CREATE USER 'cms'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'cms'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `cms`;GRANT ALL PRIVILEGES ON `cms`.* TO 'cms'@'localhost';GRANT ALL PRIVILEGES ON `cms\_%`.* TO 'cms'@'localhost'; -->

<!-- CREATE TABLE `cms`.`users` (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `active` BOOLEAN NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->

<!-- CREATE TABLE `cms`.`posts` (`id` INT(10) NOT NULL AUTO_INCREMENT , `title` VARCHAR(200) NOT NULL , `content` TEXT NOT NULL , `author` INT NOT NULL , `date` DATE NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->
