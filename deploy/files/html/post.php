<?php
session_start();
require 'config.php';
require 'security.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];
    $user_id = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare('INSERT INTO posts (title, content, user_id) VALUES (?, ?, ?)');
        $stmt->execute([$title, $content, $user_id]);

        header('Location: index.php');
        exit();
    } catch (PDOException $e) {
        $error_message = 'Error creating post. Please try again.';
    }
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
        <h1 class="title">New Anonymous Post</h1>
        <?php if (isset($error_message)): ?>
            <div class="error"><?php safe_echo($error_message); ?></div>
        <?php endif; ?>
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
        <p><a href="index.php">Back to Wall</a></p>
    </div>
</body>
</html>
