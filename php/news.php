<?php
include 'connection.php';

$query = "SELECT * FROM news ORDER BY date DESC LIMIT 5";
$result = $conn->query($query);

$news = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $news[] = [
            'title' => $row['title'],
            'content' => $row['content'],
            'date' => $row['date'],
            'image_url' => $row['image_url']
        ];
    }
    echo json_encode($news);
} else {
    echo json_encode([]);
}

$conn->close();
?>
