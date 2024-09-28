<?php

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');

include '../includes/header.php';

if (isset($_POST['email'])){
    if ($stm = $connect->prepare('SELECT * FROM login WHERE email = ? AND password = ?')){
        $hashed = SHA1($_POST['password']);
        $stm->bind_param('ss', $_POST['email'], $hashed);
        $stm->execute();

        $result = $stm->get_result();
        $user = $result->fetch_assoc();

        if ($user){
            $_SESSION['sl_no'] = $user['sl_no'];
            $_SESSION['email'] = $user['email'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['logged_in'] = true; // Set logged_in session variable


            set_message("You have successfully logged in as " . $_SESSION['name']);

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
        <div class="col-md-16">
            <h1 style="text-align: center">Admin Login</h1><br><br>
            <h4 style="text-align: center">Login to your account. Integrated with TinyMCE</h4>
        </div>
    </div>
    <br><br>
    <div class="row justify-content-center">    
        <div class="col-md-5">
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

<?php include '../includes/footer.php'; ?>