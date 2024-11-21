<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];
    $location = $_POST['location'] ?? '';
    
    $date = date("Y-m-d");

    include 'connection.php';

    $stmt = $conn->prepare("INSERT INTO contacts (name, email, subject, message, date, location) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $name, $email, $subject, $message, $date, $location);

    if ($stmt->execute()) {
        header("Location: contact-us.html?status=success");
    } else {
        header("Location: contact-us.html?status=error");
    }

    $stmt->close();
    $conn->close();
}
?>