<?php

session_start(); // Ensure session is started

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

include('../includes/header.php');

if (isset($_POST['title'])) {
    // Handle the image upload
    $targetFilePath = null; // Initialize variable for image path
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        // Define upload path
        $targetDir = "../gallery/uploads/images/";
        $fileName = basename($_FILES["image"]["name"]);
        $targetFilePath = $targetDir . $fileName;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array($fileType, $allowTypes) && move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
            // Image uploaded successfully
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            exit; // Exit if image upload fails
        }
    }

    // Prepare the insert statement to match your content table structure
    if ($stm = $connect->prepare('INSERT INTO content (title, header_image, contents, search_tag, display) VALUES (?, ?, ?, ?, ?)')) {
        $display = 'yes'; // Default display is 'yes'
        $stm->bind_param('sssss', $_POST['title'], $targetFilePath, $_POST['content'], $_POST['search_tag'], $display);
        $stm->execute();

        set_message("A new post \"" . $_POST['title'] . "\" has been added");
        header('Location: pages.php');
        $stm->close();
        die();
    } else {
        echo 'Could not prepare statement!';
    }
}
?>

<div style="padding: 0 4vw;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <h1 class="display-4">Add Page</h1>
            
            <form method="post" enctype="multipart/form-data">
                <!-- Title input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" required />
                    <label class="form-label" for="title">Title</label>
                </div>
                
                <!-- Content input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <textarea name="content" id="content" style="min-height: 50vh;"></textarea>
                </div>
                
                <!-- Search Tag input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="search_tag" name="search_tag" class="form-control" />
                    <label class="form-label" for="search_tag">Search Tag</label>
                </div>
                
                <!-- Image upload -->
                <div class="form-outline mb-4">
                    <label class="form-label" for="imageUpload">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control" style="border: 1px solid black;"/>
                </div>

                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary">Add post</button>
            </form>
        </div>
    </div>
</div>

<!-- TinyMCE Editor -->
<script src="../assets/js/tinymce/tinymce.min.js"></script>

<script>
tinymce.init({
    selector: '#content',
    plugins: [
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' },
    ],
});
</script>

<?php include('../includes/footer.php'); ?>
