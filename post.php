<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)');
    $stmt->execute([$title, $content, $user_id]);

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Post</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1 class="title">New Post</h1>
        <form action="post.php" method="post" class="form">
            <div class="form-group">
                <label for="title" class="form-label">Title</label>
                <input type="text" name="title" class="form-input" required>
            </div>
            <div class="form-group">
                <label for="content" class="form-label">Content</label>
                <textarea name="content" class="form-input" required></textarea>
            </div>
            <button type="submit" class="btn">Post</button>
        </form>
    </div>
</body>
</html>
