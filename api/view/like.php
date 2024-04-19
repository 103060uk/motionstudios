<?php

session_start();

require_once "../model/dbh.inc.php";

// Check if user is logged in
if (!isset($_SESSION["user_id"])) {
    // Send anyone who's not an admin to the error page
    header("Location: ../controller/login.php");
    exit();
}

// Get user ID from session
$user_id = $_SESSION["user_id"];
$article_id = $_GET["article_id"];

try {
    // Check if the user has already liked the article
    $query = "SELECT * FROM likes WHERE user_id = :user_id AND article_id = :article_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":article_id", $article_id, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        // User has already liked the article, redirect back to news page
        header("Location: ../controller/news.php");
        exit();
    }

    // Insert like into database
    $query = "INSERT INTO likes (user_id, article_id) VALUES (:user_id, :article_id)";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":article_id", $article_id, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: ../controller/news.php");
    exit();
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
