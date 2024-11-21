<?php
include 'connection.php';

$query = "SELECT * FROM news ORDER BY date DESC LIMIT 5";
$result = $conn->query($query);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<div class="news-item">';
        echo '<h3>' . $row['title'] . '</h3>';
        echo '<p>' . $row['content'] . '</p>';
        echo '<small>' . date("F j, Y", strtotime($row['date'])) . '</small>';
        echo '</div>';
    }
} else {
    echo "<p>No news available.</p>";
}

$conn->close();
?>
