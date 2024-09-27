<?php

include('../includes/config.php');
include('../includes/database.php');
include('../includes/functions.php');
secure();

include('../includes/header.php');

if (isset($_POST['username'])){
    
    if ($stm = $connect->prepare('UPDATE users set username = ? , email = ? , active = ? WHERE id = ?')){
        $stm->bind_param('sssi', $_POST['username'], $_POST['email'], $_POST['active'], $_GET['id']);
        $stm->execute();
        
        $stm->close();

        if (!empty($_POST['password'])){
            if ($stm = $connect->prepare('UPDATE users set password = ? WHERE id = ?')){
                $hashed = SHA1($_POST['password']);
                $stm->bind_param('si', $hashed, $_GET['id']);
                $stm->execute();

                $stm->close();
            } else {
                echo 'Could not prepare password update statement!';
            }
        }
    }
    
    set_message("User " . $_GET['id'] . " has been updated");
    header('Location: users.php');
    die();

} else {
    // echo 'Could not prepare user update statement!';
}

if (isset($_GET['id'])){
    if($stm = $connect->prepare('SELECT * from users WHERE id = ?')){
        $stm->bind_param('i', $_GET['id']);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user){
        
?>
<div class="container mt-5">
    </div>
    
    <div class="row justify-content-center">
        <div class="col-md-6">
            
            <h1 class="display-1">Edit User</h1>
            
            <form method="post">
                <!-- Email input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="username" name="username" class="form-control active" value="<?php echo $user['username'] ?>"/>
                    <label class="form-label" for="username">Username</label>
                </div>
                
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="email" name="email" class="form-control active" value="<?php echo $user['email'] ?>" />
                    <label class="form-label" for="email">Email address</label>
                </div>
                
                <!-- Password input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="password" name="password" class="form-control" />
                    <label class="form-label" for="password">Password</label>
                </div>
                
                <!-- Active select -->
                <div class="form-outline mb-4">
                    <select name="active" class="form-select" id="active">
                        <option <?php echo ($user['active']) ? "selected" : ""; ?> value="1">Active</option>
                        <option <?php echo ($user['active']) ? "" : "selected"; ?> value="0">Inactive</option>    
                    </select>
                </div>
                
                
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary btn-block">Update user</button>
            </form>
            
        </div>
    </div>
</div>

<?php

    // User details fetched successfully
} else {
    echo 'User not found!';
}
$stm->close();
} else {
echo 'Could not prepare statement!';
}
} else {
echo "No user selected";
// die();
}

include('../includes/footer.php');
?>



<!-- CREATE USER 'cms'@'localhost' IDENTIFIED VIA mysql_native_password USING '***';GRANT ALL PRIVILEGES ON *.* TO 'cms'@'localhost' REQUIRE NONE WITH GRANT OPTION MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0;CREATE DATABASE IF NOT EXISTS `cms`;GRANT ALL PRIVILEGES ON `cms`.* TO 'cms'@'localhost';GRANT ALL PRIVILEGES ON `cms\_%`.* TO 'cms'@'localhost'; -->

<!-- CREATE TABLE `cms`.`users` (`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT , `username` VARCHAR(100) NOT NULL , `email` VARCHAR(100) NOT NULL , `password` VARCHAR(100) NOT NULL , `active` BOOLEAN NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->

<!-- CREATE TABLE `cms`.`posts` (`id` INT(10) NOT NULL AUTO_INCREMENT , `title` VARCHAR(200) NOT NULL , `content` TEXT NOT NULL , `author` INT NOT NULL , `date` DATE NOT NULL , `added` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP , PRIMARY KEY (`id`)) ENGINE = InnoDB; -->