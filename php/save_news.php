<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $content = $conn->real_escape_string($_POST['content']);
    $date = $_POST['date'];

    $image_url = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/news_images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image_url = $imagePath;
        } else {
            header("Location: add_news.php?message=Error uploading image.");
            exit;
        }
    }

    $query = "INSERT INTO news (title, content, date, image_url) 
              VALUES ('$title', '$content', '$date', '$image_url')";

    if ($conn->query($query) === TRUE) {
        header("Location: add_news.php?message=News added successfully!");
    } else {
        header("Location: add_news.php?message=Error: " . $conn->error);
    }

    $conn->close();
    exit;
}
?>
