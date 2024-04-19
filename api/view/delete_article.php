<?php

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "Admin") {
    // Send anyone who's not an admin to the error page
    header("Location: ../controller/error.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $article_id = trim($_POST["article_id"]);
    $confirm_article_id = trim($_POST["confirm_article_id"]);

    // Check that the confirmation of the article ID matches the first entry of the article ID
    if ($article_id === $confirm_article_id) {
        try {
            require_once "../model/dbh.inc.php";

            $sql = "DELETE FROM articles WHERE article_id = :article_id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(":article_id", $article_id, PDO::PARAM_INT);

            $stmt->execute();

            echo "Article deleted successfully!";

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "Error: Article IDs do not match. Please confirm the correct article ID.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Article | Admin | Motion Studios</title>
    <link rel="stylesheet" href="../view/style/motion-studios.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo+Black&display=swap"
      rel="stylesheet"
    />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Archivo&display=swap"
      rel="stylesheet"
    />
  </head>
  <?php include "../view/partials/navbar.php" ?>
<body>
<main class= "crud-main">
<a href='../controller/admin_portal.php'><button>Back to Admin Portal</button></a>
<h1>Delete article</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="article_id" class="hidden-input-label">Article ID:</label>
            <input type="text" id="article_id" name="article_id" placeholder="Please enter the article ID (that you’d like to delete)*" required>
        </div>
        <div class="form-group">
            <label for="confirm_article_id" class="hidden-input-label">Confirm Article ID:</label>
            <input type="text" id="confirm_article_id" name="confirm_article_id" placeholder="Please confirm the article ID*" required>
        </div>
        <div class="form-group">
            <button type="submit">CONFIRM DELETION</button>
        </div>
    </form>
</main>
<?php include "../view/partials/footer.php" ?>
</body>
</html>