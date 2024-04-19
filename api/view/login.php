<?php
session_start();

// Check if user is already logged in, redirect to news page if they are
if (isset($_SESSION["user_id"])) {
    header("Location: ../controller/news.php");
    exit();
}

require_once "../model/dbh.inc.php";

$username = $password = $first_name = $last_name = $signup_username = $email = $signup_password = "";
$login_error = $signup_error = "";

// Log in process
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login_submit"])) {
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);

    if (empty($username) || empty($password)) {
        $login_error = "Please enter both username and password.";
    } else {
        // Fetch user details
        $query = "SELECT user_id, username, password, role FROM users WHERE username = :username";

        if ($stmt = $pdo->prepare($query)) {
            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);

            $param_username = $username;

            if ($stmt->execute()) {
                // Check if username exists, if yes then verify password
                if ($stmt->rowCount() == 1) {
                    if ($row = $stmt->fetch()) {
                        $hashed_password = $row["password"];
                        if (password_verify($password, $hashed_password)) {
                            // If the password to the given username is correct, store user data to the session
                            $_SESSION["user_id"] = $row["user_id"];
                            $_SESSION["username"] = $row["username"];
                            $_SESSION["role"] = $row["role"];
                            header("Location: ../controller/news.php");
                            exit();
                        } else {
                            $login_error = "Invalid username or password.";
                        }
                    }
                } else {
                    $login_error = "Invalid username or password.";
                }
            } else {
                $login_error = "Oops! Something went wrong. Please try again later.";
            }
        }

        unset($stmt);
    }
}

// Sign up process
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup_submit"])) {
    $first_name = trim($_POST["first_name"]);
    $last_name = trim($_POST["last_name"]);
    $signup_username = trim($_POST["signup_username"]);
    $email = trim($_POST["email"]);
    $signup_password = trim($_POST["signup_password"]);

    if (empty($first_name) || empty($last_name) || empty($signup_username) || empty($email) || empty($signup_password)) {
        $signup_error = "Please fill in all fields.";
    } else {
        // Check if username or email already exists in the database
        $query = "SELECT user_id FROM users WHERE username = :username OR email = :email";
        if ($stmt = $pdo->prepare($query)) {

            $stmt->bindParam(":username", $signup_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $email, PDO::PARAM_STR);

            if ($stmt->execute()) {
                if ($stmt->rowCount() > 0) {
                    $signup_error = "Username or email already exists.";
                } else {
                    // Hash the password
                    $hashed_password = password_hash($signup_password, PASSWORD_DEFAULT);

                    $query = "INSERT INTO users (first_name, last_name, username, email, password, role) VALUES (:first_name, :last_name, :username, :email, :password, 'Standard User')";
                    if ($stmt = $pdo->prepare($query)) {

                        $stmt->bindParam(":first_name", $first_name, PDO::PARAM_STR);
                        $stmt->bindParam(":last_name", $last_name, PDO::PARAM_STR);
                        $stmt->bindParam(":username", $signup_username, PDO::PARAM_STR);
                        $stmt->bindParam(":email", $email, PDO::PARAM_STR);
                        $stmt->bindParam(":password", $hashed_password, PDO::PARAM_STR);

                        if ($stmt->execute()) {
                            header("Location: ../controller/login.php");
                            exit();
                        } else {
                            $signup_error = "Oops! Something went wrong. Please try again later.";
                        }
                    }
                }
            } else {
                $signup_error = "Oops! Something went wrong. Please try again later.";
            }
        }

        unset($stmt);
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login or Signup | Motion Studios</title>
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
<body>
    <?php include "../view/partials/navbar.php"; ?>
    <div class="container">
        <main class="crud-main">
        <h1>Login/Signup</h1>
            <section class="login">
                <h2>Login</h2>
                <?php if (!empty($login_error)): ?>
                    <p class="error"><?php echo $login_error; ?></p>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                    <button type="submit" name="login_submit">Login</button>
                </form>
            </section>
            <section class="signup">
                <h2>Sign Up</h2>
                <?php if (!empty($signup_error)): ?>
                    <p class="error"><?php echo $signup_error; ?></p>
                <?php endif; ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="first_name">First Name:</label>
                    <input type="text" id="first_name" name="first_name" required>
                    <label for="last_name">Last Name:</label>
                    <input type="text" id="last_name" name="last_name" required>
                    <label for="signup_username">Username:</label>
                    <input type="text" id="signup_username" name="signup_username" required>
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                    <label for="signup_password">Password:</label>
                    <input type="password" id="signup_password" name="signup_password" required>
                    <button type="submit" name="signup_submit">Sign Up</button>
                </form>
            </section>
        </main>
    </div>
    <?php include "../view/partials/footer.php" ?>
</body>
</html>
