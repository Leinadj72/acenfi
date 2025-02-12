<?php if (isset($_GET['message'])): ?>
    <p style="color: green;"><?php echo htmlspecialchars($_GET['message']); ?></p>
<?php endif; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add News</title>
</head>
<body>
    <h1>Add News</h1>
    <form action="save_news.php" method="post" enctype="multipart/form-data" autocomplete="on">
        <label for="title">News Title:</label><br>
        <input type="text" id="title" name="title" required><br><br>

        <label for="content">News Content:</label><br>
        <textarea id="content" name="content" rows="5" required></textarea><br><br>

        <label for="date">Date:</label><br>
        <input type="date" id="date" name="date" autocomplete="date" required><br><br>

        <label for="image">Image:</label><br>
        <input type="file" id="image" name="image" accept="image/*" ><br><br>

        <button type="submit">Add News</button>
    </form>

</body>
</html>
