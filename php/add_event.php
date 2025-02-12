<?php if (isset($_GET['message'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Event</title>
</head>
<body>
    <h1>Add New Event</h1>
    <form action="save_events.php" method="POST" enctype="multipart/form-data" autocomplete="on">
        <label for="title">Event Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="description">Event Description:</label><br>
        <textarea id="description" name="description" rows="4" required></textarea><br><br>

        <label for="event_date">Event Date:</label><br>
        <input type="date" id="event_date" name="event_date" autocomplete="date" required><br><br>

        <label for="image">Event Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*" required><br><br>

        <button type="submit">Add Event</button>
    </form>

</body>
</html>
