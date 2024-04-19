<?php

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "Admin") {
    // Send anyone who's not an admin to the error page
    header("Location: ../controller/error.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $heading = trim($_POST["heading"]);
    $subheading = trim($_POST["subheading"]);
    $content = trim($_POST["content"]);
        
    try {
        require_once "../model/dbh.inc.php"; 

        $stmt = $pdo->prepare("INSERT INTO articles (heading, subheading, content) VALUES (:heading, :subheading, :content)");

        $stmt->bindParam(":heading", $heading);
        $stmt->bindParam(":subheading", $subheading);
        $stmt->bindParam(":content", $content);

        $stmt->execute();

        echo "Article uploaded successfully! <br>";
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
    <title>Upload New Article | Admin | Motion Studios</title>
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
    <h1>Upload new article</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <div class="form-group">
            <label for="heading" class="hidden-input-label">Article Heading:</label>
            <input type="text" id="heading" name="heading" placeholder="Please enter article heading here*" required>
        </div>
        <div class="form-group">
            <label for="subheading" class="hidden-input-label">Article Subheading:</label>
            <input type="text" id="subheading" name="subheading" placeholder="Please enter article subheading here*" required>
        </div>
        <div class="form-group">
            <label for="content" class="hidden-input-label">Article Content:</label>
            <textarea id="content" name="content" rows="5" placeholder="Please enter article content here*" required></textarea>
        </div>
        <div class="form-group">
            <button type="submit">SUBMIT</button>
        </div>
    </form>
</main>
<?php include "../view/partials/footer.php" ?>
</body>
</html>