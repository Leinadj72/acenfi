<?php
include 'connection.php';

$query = "SELECT * FROM events ORDER BY event_date ASC LIMIT 5";
$result = $conn->query($query);

$events = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $events[] = [
            'title' => $row['title'],
            'description' => $row['description'],
            'event_date' => $row['event_date'],
            'image_url' => $row['image_url']
        ];
    }
    echo json_encode($events);
} else {
    echo json_encode([]);
}

$conn->close();
?>
