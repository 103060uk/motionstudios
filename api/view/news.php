<?php

session_start();

// Check if the user is logged in
if (isset($_SESSION["user_id"])) {
    $logged_in = true;
    $username = $_SESSION["username"];

    // Check if the user is an admin
    if ($_SESSION["role"] === "Admin") {
        $is_admin = true;
    } else {
        $is_admin = false;
    }
} else {
    $logged_in = false;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News | Motion Studios</title>
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
    <main class="news-body">
<?php
// Display welcome message and login/signup button if user is logged in
if ($logged_in) {
    echo "<p style='padding: 36px 0 0;' >Welcome back, $username!</p>";
    echo "<a href='../controller/logout.php'><button>Logout</button></a>";
    // Display admin portal button for admins
    if ($is_admin) {
        echo "<a href='../controller/admin_portal.php'><button>Admin Portal</button></a>";
    }
} else {
    echo "<a href='../controller/login.php'><button>Login/Signup</button></a>";
}
?>
<h1>News</h1>
<?php

require_once "../model/dbh.inc.php";

// Fetch articles
$query = "SELECT * FROM articles";

$stmt = $pdo->prepare($query);
$stmt->execute();

$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!$articles) {
    echo "No articles found.";
} else {
    foreach ($articles as $article) {
        echo "<div class='article'>";
        echo "<h2>{$article['heading']}</h2>";
        echo "<h3>{$article['subheading']}</h3>";
        echo "<p>{$article['content']}</p>";

        // Display like button and share button for logged-in users
        if ($logged_in) {
             // Add data-article-id attribute with the article ID for when the like button functionality is fully working
        echo "<a href='../controller/like.php'><button class='like-button' data-article-id='{$article['article_id']}'>Like</button></a>";
        echo "<button class='share-button'>Share</button>";
        }

        echo "</div>";
    }
}

?>
</main>
    <?php include "../view/partials/footer.php" ?>


</body>