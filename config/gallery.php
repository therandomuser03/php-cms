<?php
include 'database.php';

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars(trim($_POST['name']));
    $display = htmlspecialchars(trim($_POST['display']));
    $size = 120; // Default size

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $targetDir = '../backend/gallery/assets/uploads/images/';
        $targetFile = $targetDir . basename($_FILES['image']['name']);
        
        // Move uploaded file to the target directory
        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetFile)) {
            // Prepare the SQL statement to insert image details
            $stmt = $connect->prepare("INSERT INTO gallery (name, url, display, size) VALUES (?, ?, ?, ?)");
            $imageName = basename($_FILES['image']['name']);
            $stmt->bind_param("sssi", $name, $imageName, $display, $size);
            
            if ($stmt->execute()) {
                echo "<div class='alert alert-success'>Image uploaded successfully!</div>";
            } else {
                echo "<div class='alert alert-danger'>Error uploading image: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } else {
            echo "<div class='alert alert-danger'>Error moving uploaded file.</div>";
        }
    }
}

// Fetch gallery images from the database where display = 'yes'
$query = "SELECT * FROM gallery WHERE display = 'yes'";
$result = $connect->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Gallery Management</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .gallery-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }
        .gallery-item {
            margin: 15px;
            text-align: center;
        }
        .gallery-item img {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 150px; /* Fixed width for images */
            height: auto; /* Maintain aspect ratio */
        }
        .gallery-item h5 {
            margin-top: 10px;
            font-size: 1rem;
        }
    </style>
</head>
<body>

<div class="container">
    <h1 class="my-4 text-center">Image Gallery Management</h1>

    <!-- Form for uploading new images -->
    <form method="post" enctype="multipart/form-data" class="mb-4">
        <div class="form-group">
            <label for="name">Image Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="image">Select Image</label>
            <input type="file" class="form-control-file" name="image" id="image" accept="image/*" required>
        </div>
        <div class="form-group">
            <label for="display">Display</label>
            <select name="display" id="display" class="form-control">
                <option value="yes">Yes</option>
                <option value="no">No</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Upload Image</button>
    </form>
    
    <h2 class="my-4 text-center">Current Gallery</h2>
    
    <div class="gallery-container">
        <?php if ($result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="gallery-item">
                    <img src="<?php echo '../backend/assets/uploads/images/' . $row['url']; ?>" alt="<?php echo htmlspecialchars($row['name']); ?>">
                    <h5><?php echo htmlspecialchars($row['name']); ?></h5>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No images to display.</p>
        <?php endif; ?>
    </div>
</div>

</body>
</html>

<?php
$connect->close(); // Close the database connection
?>
