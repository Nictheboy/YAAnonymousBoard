<?php
session_start();
require 'config.php';
require 'security.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $content = $_POST['content'];
    $post_id = $_POST['post_id'];
    $user_id = $_SESSION['user_id'];

    try {
        // Validate that post_id is a valid integer
        if (!filter_var($post_id, FILTER_VALIDATE_INT)) {
            throw new Exception('Invalid post');
        }

        $stmt = $pdo->prepare('INSERT INTO comments (content, user_id, post_id) VALUES (?, ?, ?)');
        $stmt->execute([$content, $user_id, $post_id]);

        header('Location: index.php');
        exit();
    } catch (Exception $e) {
        // Log error but don't display to user
        error_log('Comment error: ' . $e->getMessage());
        header('Location: index.php');
        exit();
    }
}

// If not a POST request, redirect to index
header('Location: index.php');
exit();
?>
