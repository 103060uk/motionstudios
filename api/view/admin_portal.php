<?php

session_start();

// Check if the user is logged in and is an admin
if (!isset($_SESSION["user_id"]) || $_SESSION["role"] !== "Admin") {
    // Send anyone who's not an admin to the error page
    header("Location: ../controller/error.php");
    exit;
}

include_once "../view/partials/navbar.php";

require_once "../model/dbh.inc.php"; 

$query = "SELECT * FROM articles";

$results = $pdo->query($query);

if ($results->rowCount() > 0) {
    $articles = $results->fetchAll(PDO::FETCH_ASSOC);
} else {
    $articles = [];
}

$query = "SELECT * FROM users";

$results = $pdo->query($query);

if ($results->rowCount() > 0) {
    $users = $results->fetchAll(PDO::FETCH_ASSOC);
} else {
    $users = [];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Portal | Motion Studios</title>
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
<body class="admin-body">
<div class="buttons">
</div>
    <div class="container-section">
        <header>
            <h1>Article List</h1>
        </header>
        <main>
        <a href="../controller/upload_article.php"><button>Upload new article</button></a>
        <a href="../controller/update_article.php"><button>Update current article</button></a>
        <a href="../controller/delete_article.php"><button>Delete article</button></a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Heading</th>
                        <th>Subheading</th>
                        <th>Content</th>
                        <th>Author</th>
                        <th>Date Added</th>
                        <th>Published</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td><?php echo $article['article_id']; ?></td>
                            <td><?php echo $article['heading']; ?></td>
                            <td><?php echo $article['subheading']; ?></td>
                            <td><?php echo $article['content']; ?></td>
                            <td><?php echo $article['author_id'];  ?></td>
                            <td><?php echo $article['date_added']; ?></td>
                            <td><?php echo $article['is_published'] ? 'Yes' : 'No'; ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
    <div class="container-section">
        <header>
            <h1>User List</h1>
        </header>
        <main>
        <a href="../controller/add_user.php"><button>Add new user</button></a>
        <a href="../controller/delete_user.php"><button>Delete user</button></a>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo $user['user_id']; ?></td>
                            <td><?php echo $user['first_name']; ?></td>
                            <td><?php echo $user['last_name']; ?></td>
                            <td><?php echo $user['username']; ?></td>
                            <td><?php echo $user['email']; ?></td>
                            <td><?php echo $user['role']; ?></td>
                            <td>
                                <!-- <button onclick="toggleUserRole(<?php // echo $user['user_id']; ?>)">
                                    <?php // echo $user['role'] === 'Admin' ? 'Standard User' : 'Admin'; ?>
                                </button> -->
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </main>
    </div>
    <?php include "../view/partials/footer.php" ?>
</body>
</html>
