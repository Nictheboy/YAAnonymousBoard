<?php
session_start();
require 'config.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    $stmt = $pdo->prepare('INSERT INTO comments (content, user_id, post_id) VALUES (?, ?, ?)');
    $stmt->execute([$content, $user_id, $post_id]);

    header('Location: index.php');
    exit();
}
?>
