<?php
session_start();
require 'Database/databaseweb.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->execute([$username]);
    $admin = $stmt->fetch();

    if ($admin && password_verify($password, $admin['password'])) {
        $_SESSION['admin'] = $admin['id'];
        header('Location: admin_dashboard.php');
        exit;
    } else {
        echo 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - UrbanVogue Collective</title>
    <link rel="stylesheet" href="CSS/styles.css">
    <style>
    body {
        background-color: #f8f8f8;
        margin: 0;
        padding: 0;
    }

    main {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: white;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2, h3 {
        color: #333;
    }

    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        margin-bottom: 20px;
        display: flex;
        align-items: center;
    }

    input[type="text"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    input[type="password"] {
        width: 100%;
        padding: 8px;
        box-sizing: border-box;
    }

    input[type="submit"] {
        background-color: #333;
        color: white;
        padding: 10px 15px;
        border: none;
        cursor: pointer;
    }
    </style>

</head>

<body>
<header>
    <a href="admin_login.php" style="text-decoration: none; color: #333;">
        <h1 style="font-family: Garamond, serif; color: white;">&nbsp;&nbsp;-ADMIN- UrbanVogue Collective</h1>
    </a>
</header>

<main>
<h2 style="text-align: center;">Admin Login</h2>
    <form method="post" id="paymentForm" action="admin_login.php">
    <div>
        <label for="username">Username:</label>
        <input type="text" name="username" required><br>
    </div>
    <div>
        <label for="password">Password:</label>
        <input type="password" name="password" required><br>
    </div>
    <div>
        <button type="submit">Login</button>
    </div>
    </form>
</main>

</body>
</html>
