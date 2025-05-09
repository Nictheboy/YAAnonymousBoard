<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$posts = $pdo->query('SELECT p.id, p.title, p.content, p.date_posted, u.username FROM posts p JOIN users u ON p.user_id = u.id ORDER BY p.date_posted DESC')->fetchAll();

function get_comments($pdo, $post_id) {
    $stmt = $pdo->prepare('SELECT c.content, c.date_posted, u.username FROM comments c JOIN users u ON c.user_id = u.id WHERE c.post_id = ? ORDER BY c.date_posted DESC');
    $stmt->execute([$post_id]);
    return $stmt->fetchAll();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Anonymous Wall</title>
    <link rel="stylesheet" href="style.css">
    <script src="js/scripts.js" defer></script>
</head>
<body>
    <header class="header">
        <div class="container">
            <h1 class="title">Anonymous Wall</h1>
            <nav class="nav">
                <a class="nav-link" href="index.php">Home</a>
                <a class="nav-link" href="post.php">New Post</a>
                <a class="nav-link" href="logout.php">Logout</a>
            </nav>
        </div>
    </header>
    <main class="container">
        <?php foreach ($posts as $post): ?>
            <article class="post">
                <h2><?= htmlspecialchars($post['title']) ?></h2>
                <p><?= nl2br(htmlspecialchars($post['content'])) ?></p>
                <p class="meta">by <?= htmlspecialchars($post['username']) ?> on <?= $post['date_posted'] ?></p>
                <div class="comments">
                    <h3>Comments:</h3>
                    <?php $comments = get_comments($pdo, $post['id']); ?>
                    <?php foreach ($comments as $comment): ?>
                        <div class="comment">
                            <p><?= htmlspecialchars($comment['username']) ?>: <?= nl2br(htmlspecialchars($comment['content'])) ?></p>
                            <small><?= $comment['date_posted'] ?></small>
                        </div>
                    <?php endforeach; ?>
                </div>
                <form action="comment.php" method="post" class="comment-form">
                    <input type="hidden" name="post_id" value="<?= $post['id'] ?>">
                    <textarea name="content" placeholder="Add a comment..." required></textarea>
                    <button type="submit" class="btn">Comment</button>
                </form>
            </article>
        <?php endforeach; ?>
    </main>
</body>
</html>
