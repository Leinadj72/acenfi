<?php
include 'connection.php';


$query = "SELECT * FROM events ORDER BY date DESC LIMIT 5"; 
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="event-item">';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>' . $row['description'] . '</p>';
        echo '<small>' . date("F j, Y", strtotime($row['date'])) . '</small>';
        echo '</div>';
    }
} else {
    echo "<p>No events available.</p>";
}

$conn->close();
?>
