<?php

include('../../config/config.php');
include('../../config/database.php');
include('../../config/functions.php');
secure();

include('../includes/header.php');

if (isset($_POST['title'])){
    
    if ($stm = $connect->prepare('UPDATE content set title = ?, contents = ? WHERE sl_no = ?')){
        $stm->bind_param('ssi', $_POST['title'], $_POST['contents'], $_GET['sl_no']);
        $stm->execute();
        $stm->close();
    }
    
    set_message("Post " . $_GET['sl_no'] . " has been updated");
    header('Location: pages.php');
    die();

} else {
    echo $connect->error;
}

if (isset($_GET['sl_no'])){
    if($stm = $connect->prepare('SELECT * from content WHERE sl_no = ?')){
        $stm->bind_param('i', $_GET['sl_no']);
        $stm->execute();

        $result = $stm->get_result();
        $post = $result->fetch_assoc();

        if ($post){
        
?>
<div style="padding: 0 4vw;">
    <div class="row justify-content-center">
        <div class="col-md-12">
            
            <h1 class="display-4">Edit Post</h1>
            
            <form method="post" enctype="multipart/form-data">
                <!-- Title input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="title" name="title" class="form-control" value="<?php echo $post['title'] ?>"/>
                    <label class="form-label" for="title">Title</label>
                </div>
                
                <!-- Content input -->
                <div data-mdb-input-init class="form-outline mb-4">
                    <textarea name="contents" id="content" style="height: 500px; width: 100%"><?php echo $post['contents'] ?></textarea>
                </div>
                
                <!-- Submit button -->
                <button data-mdb-ripple-init type="submit" class="btn btn-primary">Save Changes</button>

            </form>
            
        </div>
    </div>
</div>

<script src="../includes/assets/js/tinymce/tinymce.min.js"></script>
<script>
tinymce.init({
    selector: '#content',
    plugins: [
        'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'image', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
        'checklist', 'mediaembed', 'casechange', 'export', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'editimage', 'advtemplate', 'ai', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown',
        'spellchecker', 'template'  // Adding extra plugins from the second config
    ],
    toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | alignleft aligncenter alignright alignjustify | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
    image_title: true,
    automatic_uploads: true,
    file_picker_types: 'image',
    images_upload_url: '../gallery/upload_image.php',  // PHP script to handle image uploads
    relative_urls: false,
    remove_script_host: false,
    convert_urls: true,
    // content_css: '/path/to/your/content.css',
    // content_css: '../includes/assets/',
    tinycomments_mode: 'embedded',
    tinycomments_author: 'Author name',
    mergetags_list: [
        { value: 'First.Name', title: 'First Name' },
        { value: 'Email', title: 'Email' },
    ],
    ai_request: (request, respondWith) => respondWith.string(() => Promise.reject('See docs to implement AI Assistant')),
});


</script>

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