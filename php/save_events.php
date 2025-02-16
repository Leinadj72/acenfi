<?php
include 'connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $conn->real_escape_string($_POST['title']);
    $description = $conn->real_escape_string($_POST['description']);
    $event_date = $_POST['event_date'];

    $image_url = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../uploads/events_images/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        

        $imageTmpName = $_FILES['image']['tmp_name'];
        $imageName = time() . '_' . preg_replace("/[^a-zA-Z0-9\._-]/", "", basename($_FILES['image']['name'])); // Sanitize filename
        $imagePath = $uploadDir . $imageName;

        // Allow only specific image formats
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            if (move_uploaded_file($imageTmpName, $imagePath)) {
                $image_url = 'uploads/events_images/' . $imageName;
            } else {
                header("Location: add_event.php?message=Error uploading image.");
                exit;
            }
        } else {
            header("Location: add_event.php?message=Invalid file type. Only JPG, PNG, GIF, and WEBP allowed.");
            exit;
        }
    }

    // Use prepared statements to prevent SQL injection
    $query = "INSERT INTO events (title, description, event_date, image_url) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("ssss", $title, $description, $event_date, $image_url);

    if ($stmt->execute()) {
        header("Location: add_event.php?message=Event added successfully!");
    } else {
        header("Location: add_event.php?message=Error: " . $conn->error);
    }

    $stmt->close();
    $conn->close();
    exit;
}
?>
