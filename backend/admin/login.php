<?php

include '../includes/config.php';
include '../includes/database.php';
include '../includes/functions.php';

include 'includes/header.php';

if (isset($_POST['email'])){
    if ($stm = $connect->prepare('SELECT * FROM users WHERE email = ? AND password = ? AND active = 1')){
        $hashed = SHA1($_POST['password']);
        $stm->bind_param('ss', $_POST['email'], $hashed);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user){
            $_SESSION['id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['username'] = $user['username'];
            $_SESSION['logged_in'] = true; // Set logged_in session variable


            set_message("You have successfully logged in as " . $_SESSION['username']);

            header('Location: ../admin/dashboard.php');
            die();
        }
        $stm->close();



        // var_dump($user);
    } else {
        echo 'Could not prepare statement!';
    }
}
    

?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <form method="post">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control" />
                    <label class="form-label" for="email">Email address</label>
                </div>
                
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>
                
                
<!-- Submit button -->
<button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Sign in</button>
</form>

    </div>
</div>
</div>



<!-- CREATE USER 'cms'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'cms'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `cms`;GRANT ALL PRIVILEGES ON `cms`.* TO 'cms'@'localhost';GRANT ALL PRIVILEGES ON `cms\_%`.* TO 'cms'@'localhost'; -->

<!-- CREATE TABLE `cms`.`users` (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `active` BOOLEAN NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->

<!-- CREATE TABLE `cms`.`posts` (`id` INT(10) NOT NULL AUTO_INCREMENT , `title` VARCHAR(200) NOT NULL , `content` TEXT NOT NULL , `author` INT NOT NULL , `date` DATE NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->
