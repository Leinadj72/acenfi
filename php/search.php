<?php
include 'connection.php';

$query = isset($_GET['query']) ? $_GET['query'] : '';

$sql = "SELECT * FROM news WHERE title LIKE ? OR content LIKE ? LIMIT 5";
$stmt = $conn->prepare($sql);
$searchTerm = "%" . $query . "%";
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>News - </h2>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='news-item'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['content'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No news found.</p>";
}

$sql = "SELECT * FROM events WHERE title LIKE ? OR description LIKE ? LIMIT 5";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

echo "<h2>Events - </h2>";
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<div class='event-item'>";
        echo "<h3>" . $row['title'] . "</h3>";
        echo "<p>" . $row['description'] . "</p>";
        echo "</div>";
    }
} else {
    echo "<p>No events found.</p>";
}

$conn->close();
?>
