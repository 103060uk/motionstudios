<?php

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "Admin") {
    // Send anyone who's not an admin to the error page
    header("Location: ../controller/error.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user_id = trim($_POST["user_id"]);
    $confirm_id = trim($_POST["confirm_id"]);

    // Check that the confirmation of the user ID matches the first entry of the user ID
    if ($user_id !== $confirm_id) {
        $error = "User ID and Confirmation ID do not match.";
    } else {
        try {
            require_once "../model/dbh.inc.php";

            $stmt = $pdo->prepare("DELETE FROM users WHERE user_id = ?");
            $stmt->execute([$user_id]);

            // Check if any rows were affected
            if ($stmt->rowCount() > 0) {
                $success = "User deleted successfully!";
            } else {
                $error = "User not found.";
            }
        } catch (PDOException $e) {
            $error = "Error: " . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete User | Admin | Motion Studios</title>
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
<body class= "crud-main">
    <?php include "../view/partials/navbar.php"; ?>

    <div class="container">
        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php elseif (isset($success)): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <a href='../controller/admin_portal.php'><button>Back to Admin Portal</button></a>
        <h1>Delete user</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="user_id" class="hidden-input-label">User ID:</label>
                <input type="text" id="user_id" name="user_id" placeholder="Please enter the user ID (that you’d like to delete)*" required>
            </div>
            <div class="form-group">
                <label for="confirm_id" class="hidden-input-label">Confirm User ID:</label>
                <input type="text" id="confirm_id" name="confirm_id" placeholder="Please confirm the User ID*" required>
            </div>
            <button type="submit">CONFIRM DELETION</button>
        </form>
    </div>
    <?php include "../view/partials/footer.php" ?>
</body>
</html>
