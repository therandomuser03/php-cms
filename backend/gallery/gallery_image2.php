<head>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    
    <!-- Latest Fancybox version 3.x -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>
    
    <link rel="stylesheet" href="../includes/assets/css/mdb.min.css" />
    <link rel="stylesheet" href="../includes/assets/css/easy_toast.css" />
    
    <style type="text/css">
        .gallery {
            display: inline-block;
            margin-top: 20px;
        }

        .image:hover {
            border: 1px solid black;
        }
        
        .close-icon {
            border-radius: 4px;
            right: 5px;
            top: -50px;
        }
        
        .form-image-upload {
            background: #e8e8e8 none repeat scroll 0 0;
            padding: 15px;
        }
        
        .thumbnail a>img,
        .thumbnail>img {
            width: 300px !important;
            height: 160px !important;
        }
        
        /* FancyBox custom styling */
        .fancybox-image {
            border-radius: 10px;
        }
        
        /* Modal styling */
        #successModal {
            display: none;
        }
    </style>
</head>


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


<section style="padding: 2rem">
    <section class="image-upload-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <form id="imageUploadForm" enctype="multipart/form-data">
                        <!-- code to show error message -->
                        <div class="row">
                            <div class="col-md-5">
                                <strong>Title :</strong><br><br>
                                <input type="text" name="title" class="form-control" placeholder="Title" required>
                            </div>
                            <div class="col-md-5">
                                <strong>Image :</strong><br><br>
                                <input type="file" name="image" class="form-control" accept="image/*" required>
                            </div>
                            <div class="col-md-2">
                                <br><br>
                                <button type="submit" class="btn btn-success">Upload</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Success Modal -->
    <div id="successModal" style="display:none;">
        <div class="modal-content" style="max-width: 600px; margin: auto;">
            <h3>Image Uploaded Successfully!</h3>
            <p>Your image has been uploaded. Preview below:</p>
            <img id="uploadedImagePreview" src="" alt="Uploaded Image" style="width:100%; max-height:300px; object-fit:contain;">
            <div class="text-center" style="margin-top: 10px;">
                <button data-fancybox-close class="btn btn-primary">Close</button>
            </div>
        </div>
    </div>
</section>
    <!-- end image-upload-section -->

    <?php
    // Include the database connection
    require('../../config/database.php'); // Ensure this path is correct
    ?>

    <section class="gallery-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="list-group gallery" style="width:100%;">
                        <?php
                        // Fetch the gallery images from the database
                        $sql = "SELECT * FROM gallery";
                        if ($stmt = mysqli_prepare($connect, $sql)) {
                            mysqli_stmt_execute($stmt);
                            $result = mysqli_stmt_get_result($stmt);

                            // Loop through each image and display it
                            while ($image = mysqli_fetch_assoc($result)) {
                                // Ensure the URL points to the correct folder where images are stored
                                $imageUrl = "uploads/images/" . htmlspecialchars($image['url']);
                                if (file_exists($imageUrl)) {
                        ?>
                                    <div class='col-sm-3' style="float: left; margin-bottom: 20px;">
                                        <a class="thumbnail" data-fancybox="gallery" href="<?php echo $imageUrl; ?>" data-caption="<?php echo htmlspecialchars($image['name']); ?>">
                                            <img alt="<?php echo htmlspecialchars($image['name']); ?>" src="<?php echo $imageUrl; ?>" style="width:100%; height:auto;" />
                                            <div class='text-center'>
                                                <small class='text-muted'><?php echo htmlspecialchars($image['name']); ?></small>
                                            </div>
                                        </a>

                                        <!-- Form to toggle display status -->
                                        <form action="toggle_display.php" method="POST" style="margin-top: 10px;">
                                            <input type="hidden" name="sl_no" value="<?php echo htmlspecialchars($image['sl_no']); ?>">
                                            <input type="hidden" name="current_display" value="<?php echo htmlspecialchars($image['display']); ?>">
                                            <button type="submit" class="btn btn-<?php echo ($image['display'] == 'yes') ? 'warning' : 'success'; ?>">
                                                <?php echo ($image['display'] == 'yes') ? 'Hide Image' : 'Show Image'; ?>
                                            </button><br>
                                        </form>

                                        <!-- Form to delete image -->
                                        <form action="delete_image2.php" method="POST" style="position:relative;" onsubmit="return confirm('Are you sure you want to delete this image?');">
                                            <input type="hidden" name="id" value="<?php echo htmlspecialchars($image['sl_no']); ?>">
                                            <button type="submit" title="delete" class="close-icon btn btn-danger">Delete</button>
                                        </form>
                                    </div>
                        <?php
                                }
                            }
                            mysqli_stmt_close($stmt);
                        } else {
                            echo "<div class='alert alert-danger'>Error: " . mysqli_error($connect) . "</div>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<script>
    $(document).ready(function() {
        $('#imageUploadForm').on('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            var formData = new FormData(this); // Create a FormData object for AJAX

            $.ajax({
                url: 'upload_image.php', // The PHP file that handles the upload
                type: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    var jsonResponse = JSON.parse(response);
                    
                    if (jsonResponse.success) {
                        // Show a native browser alert for successful upload
                        window.alert('Image successfully uploaded!');
                    } else {
                        // Show a native browser alert for errors
                        window.alert('Error: ' + jsonResponse.message);
                    }
                },
                error: function(xhr, status, error) {
                    // Show a general error message using window alert
                    window.alert('Error: ' + error);
                }
            });
        });

        // Initialize Fancybox for image gallery (if you still want to keep Fancybox for gallery)
        $('[data-fancybox="gallery"]').fancybox({
            loop: true, // Allows back and forth navigation
            buttons: [
                "zoom",
                "slideShow",
                "thumbs",
                "close"
            ],
            transitionEffect: "slide" // Adds smooth sliding transition
        });
    });
</script>


<p style="position: relative; bottom: 0; width: 100%; text-align: center; padding: 1vh 0; background-color: #f1f1f1;">Copyright @ 2024</p>