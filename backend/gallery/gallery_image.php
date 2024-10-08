<head>
    <!-- Latest compiled and minified CSS for Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <!-- Latest Fancybox version 3.x (for gallery navigation) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.min.js"></script>

    <style type="text/css">
        .gallery {
            display: inline-block;
            margin-top: 20px;
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
    </style>
</head>

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
                    $sql = "SELECT * FROM gallery WHERE display = 'yes'";
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

<script>
    $(document).ready(function() {
        // Initialize Fancybox for image gallery
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
