<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $event_date = $_POST['event_date'];

    $image_url = '';
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/events_images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $imageName;

        if (move_uploaded_file($imageTmpName, $imagePath)) {
            $image_url = $imagePath;
        } else {
            header("Location: add_event.php?message=Error uploading image.");
            exit;
        }
    }

    $query = "INSERT INTO events (title, description, event_date, image_url) 
              VALUES ('$title', '$description', '$event_date', '$image_url')";

    if ($conn->query($query)) {
        header("Location: add_event.php?message=Event added successfully!");
    } else {
        header("Location: add_event.php?message=Error: " . $conn->error);
    }

    $conn->close();
    exit;
}
?>
