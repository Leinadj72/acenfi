<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    include 'connection.php'; 

    $stmt = $conn->prepare("SELECT * FROM newsletter WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<p>You are already subscribed to the newsletter.</p>";
    } else {
        $stmt = $conn->prepare("INSERT INTO newsletter (email) VALUES (?)");
        $stmt->bind_param("s", $email);

        if ($stmt->execute()) {
            echo "<p>Thank you for subscribing! We will keep you updated.</p>";
        } else {
            echo "<p>Something went wrong. Please try again.</p>";
        }
    }

    $stmt->close();
    $conn->close();
}
?>
