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
    $heading = isset($_POST["heading"]) ? trim($_POST["heading"]) : null;
    $subheading = isset($_POST["subheading"]) ? trim($_POST["subheading"]) : null;
    $content = isset($_POST["content"]) ? trim($_POST["content"]) : null;

    try {
        require_once "../model/dbh.inc.php"; 

        $query = "UPDATE articles SET ";
        $values = [];

// If a field is anything other than blank, update database field
    if ($heading !== "") {
        $query .= "heading = :heading, ";
        $values[':heading'] = $heading;
    }
    if ($subheading !== "") {
        $query .= "subheading = :subheading, ";
         $values[':subheading'] = $subheading;
    }
    if ($content !== "") {
        $query .= "content = :content, ";
        $values[':content'] = $content;
    }
        // Remove trailing comma and space in the query 
        $query = rtrim($query, ", ");

        // Update the article ID record that user has specified
        $query .= " WHERE article_id = :article_id";
        $values[':article_id'] = $article_id;

        $stmt = $pdo->prepare($query);

        foreach ($values as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        $stmt->execute();

        echo "Article updated successfully! <br>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Existing Article | Admin | Motion Studios</title>
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
<h1>Update existing article</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="article_id" class="hidden-input-label">Article ID:</label>
            <input type="text" id="article_id" name="article_id" placeholder="Please enter the article ID (that you’d like to update)*" required>
        </div>
        <div class="form-group">
            <label for="heading" class="hidden-input-label">Article Heading:</label>
            <input type="text" id="heading" name="heading" placeholder="Please enter article heading here*">
        </div>
        <div class="form-group">
            <label for="subheading" class="hidden-input-label">Article Subheading:</label>
            <input type="text" id="subheading" name="subheading" placeholder="Please enter article subheading here*">
        </div>
        <div class="form-group">
            <label for="content" class="hidden-input-label">Article Content:</label>
            <textarea id="content" name="content" rows="5" placeholder="Please enter article content here*" ></textarea>
        </div>
        <div class="form-group">
            <button type="submit">SUBMIT</button>
        </div>
    </form>
</main>
<?php include "../view/partials/footer.php" ?>
</body>
</html>