<?php
include '../config/config.php';
include '../config/database.php';
include '../config/functions.php';

$post_id = $_GET['sl_no'] ?? null; // Get the post ID from the query parameter

if ($post_id) {
    $stm = $connect->prepare('SELECT title FROM content WHERE sl_no = ?');
    $stm->bind_param('i', $post_id);
    $stm->execute();
    $result = $stm->get_result();
    $post = $result->fetch_assoc();
    
    // Check if post exists
    if ($post) {
        $title = htmlspecialchars($post['title']);
    } else {
        $title = 'Page Not Found';
    }
} else {
    $title = 'No Page ID Provided';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="irstheme">

    <title><?php echo $title; ?></title>
    
    <link href="../backend/includes/assets/css/themify-icons.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/flaticon.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/animate.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/owl.theme.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/slick.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/slick-theme.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/swiper.min.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/odometer-theme-default.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/owl.transitions.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="../backend/includes/assets/css/style.css" rel="stylesheet">

</head>

<body>

    <!-- start page-wrapper -->
    <div class="page-wrapper">

        <!-- start preloader -->
        <div class="preloader">
            <div class="loader">
                <div class="gear two">
                    <svg viewbox="0 0 100 100" fill="#131e4a">
                        <path d="M97.6,55.7V44.3l-13.6-2.9c-0.8-3.3-2.1-6.4-3.9-9.3l7.6-11.7l-8-8L67.9,20c-2.9-1.7-6-3.1-9.3-3.9L55.7,2.4H44.3l-2.9,13.6      c-3.3,0.8-6.4,2.1-9.3,3.9l-11.7-7.6l-8,8L20,32.1c-1.7,2.9-3.1,6-3.9,9.3L2.4,44.3v11.4l13.6,2.9c0.8,3.3,2.1,6.4,3.9,9.3      l-7.6,11.7l8,8L32.1,80c2.9,1.7,6,3.1,9.3,3.9l2.9,13.6h11.4l2.9-13.6c3.3-0.8,6.4-2.1,9.3-3.9l11.7,7.6l8-8L80,67.9      c1.7-2.9,3.1-6,3.9-9.3L97.6,55.7z M50,65.6c-8.7,0-15.6-7-15.6-15.6s7-15.6,15.6-15.6s15.6,7,15.6,15.6S58.7,65.6,50,65.6z"></path>
                    </svg>
                </div>
                <div class="gear three">
                    <svg viewbox="0 0 100 100" fill="#fd5f17">
                        <path d="M97.6,55.7V44.3l-13.6-2.9c-0.8-3.3-2.1-6.4-3.9-9.3l7.6-11.7l-8-8L67.9,20c-2.9-1.7-6-3.1-9.3-3.9L55.7,2.4H44.3l-2.9,13.6      c-3.3,0.8-6.4,2.1-9.3,3.9l-11.7-7.6l-8,8L20,32.1c-1.7,2.9-3.1,6-3.9,9.3L2.4,44.3v11.4l13.6,2.9c0.8,3.3,2.1,6.4,3.9,9.3      l-7.6,11.7l8,8L32.1,80c2.9,1.7,6,3.1,9.3,3.9l2.9,13.6h11.4l2.9-13.6c3.3-0.8,6.4-2.1,9.3-3.9l11.7,7.6l8-8L80,67.9      c1.7-2.9,3.1-6,3.9-9.3L97.6,55.7z M50,65.6c-8.7,0-15.6-7-15.6-15.6s7-15.6,15.6-15.6s15.6,7,15.6,15.6S58.7,65.6,50,65.6z"></path>
                    </svg>
                </div>
            </div>
        </div>
        <!-- end preloader -->


        <!-- Start header -->
        <header id="header" class="site-header header-style-1">
            <nav class="navigation navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.php?sl_no=1"><img src="../backend/includes/assets/images/logo.png" alt></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">
                        <div id="navbar" class="navbar-collapse collapse navigation-holder">
    <button class="close-navbar"><i class="ti-close"></i></button>
    <ul class="nav navbar-nav">
        <?php 
        // Define an array of titles for each page
        // home, about us, services, career, contact, gallery
        $titles = [
            1 => "Home",
            2 => "About Us",
            3 => "Services",
            4 => "Career",
            5 => "Contact",
            6 => "Gallery",
        ];

        // Loop through and display each title as a link
        for ($i = 1; $i <= count($titles); $i++) {
            // Ensure the title exists for the current index
            if (isset($titles[$i])) {
                echo '<li><a href="index.php?sl_no=' . $i . '">' . $titles[$i] . '</a></li>';
            }
        }
        ?>
    </ul>
</div>

                            
                        </ul>
                    </div>
                    <!-- end of nav-collapse -->

                    <div class="search-contact">
                        <div class="header-search-area">
                            <div class="header-search-form">
                                <form class="form">
                                    <div>
                                        <input type="text" class="form-control" placeholder="Search here">
                                    </div>
                                    <button type="submit" class="btn"><i class="ti-search"></i></button>
                                </form>
                            </div>
                            <div>
                                <button class="btn open-btn"><i class="ti-search"></i></button>
                            </div>
                        </div>
                        <div class="contact">
                            <div class="call">
                                <i class="fi flaticon-call"></i>
                                <p>Call us at</p>
                                <h5>+91 / 033 7198 1000</h5>
                            </div>
                            <a href="index.php?sl_no=5" class="theme-btn">Contact us</a>
                        </div>
                    </div>
                </div><!-- end of container -->
            </nav>
        </header>
        <!-- end of header -->