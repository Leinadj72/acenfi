<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = htmlspecialchars(strip_tags($_POST['name'] ?? '')); 
    $email = filter_var($_POST['email'] ?? '', FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(strip_tags($_POST['subject'] ?? ''));
    $message = htmlspecialchars(strip_tags($_POST['message'] ?? ''));
    $location = htmlspecialchars(strip_tags($_POST['location'] ?? ''));

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        header("Location: contact-us.htm?status=missing-fields");
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: contact-us.htm?status=invalid-email");
        exit();
    }

    $date = date("Y-m-d");

    include 'connection.php';

    $stmt = $conn->prepare(
        "INSERT INTO contacts (name, email, subject, message, date, location) VALUES (?, ?, ?, ?, ?, ?)"
    );

    if (!$stmt) {
        error_log("Database error: " . $conn->error);
        header("Location: contact-us.htm?status=error");
        exit();
    }

    $stmt->bind_param("ssssss", $name, $email, $subject, $message, $date, $location);

    if ($stmt->execute()) {
        header("Location: contact-us.htm?status=success");
    } else {
        error_log("Execution error: " . $stmt->error);
        header("Location: contact-us.htm?status=error");
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>
