<?php

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "Admin") {
    // Send anyone who's not an admin to the error page
    header("Location: ../controller/error.php");
    exit;
}

$first_name = $last_name = $username = $email = $password = "";
$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        require_once "../model/dbh.inc.php";

        $stmt = $pdo->prepare("INSERT INTO users (first_name, last_name, username, email, password, role) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$first_name, $last_name, $username, $email, $hashed_password, "Standard User"]);

        $success = "User added successfully!";
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New User | Admin | Motion Studios</title>
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
        <?php if (!empty($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php elseif (!empty($success)): ?>
            <p class="success"><?php echo $success; ?></p>
        <?php endif; ?>
        <a href='admin_portal.php'><button>Back to Admin Portal</button></a>
        <h1>Add new user</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="first_name" class="hidden-input-label">First Name:</label>
                <input type="text" id="first_name" name="first_name" value="<?php echo htmlspecialchars($first_name); ?>" placeholder="Please enter first name here*" required>
            </div>
            <div class="form-group">
                <label for="last_name" class="hidden-input-label">Last Name:</label>
                <input type="text" id="last_name" name="last_name" value="<?php echo htmlspecialchars($last_name); ?>" placeholder="Please enter last name here*" required>
            </div>
            <div class="form-group">
                <label for="username" class="hidden-input-label">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" placeholder="Please enter username here*" required>
            </div>
            <div class="form-group">
                <label for="email" class="hidden-input-label">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" placeholder="Please enter email address here*" required>
            </div>
            <div class="form-group">
                <label for="password" class="hidden-input-label">Password:</label>
                <input type="password" id="password" name="password" placeholder="Please enter the password here*" required>
            </div>
            <button type="submit">CREATE ACCOUNT</button>
        </form>
    </div>
    <?php include "../view/partials/footer.php" ?>
</body>
</html>
