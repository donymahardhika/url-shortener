<?php
/* URL SHORTENER USING PHP & MYSQL with msqli
 * Created by : Dony Mahardhika (@donymahardhika)
 * Published on : 20/05/2026
 * Library : phpqrcode
 *
 * Everything contained in this project may be used freely,
 * whether for personal or commercial purposes.
 * Feel free to develop it further and send it back to my GitHub
 * so that more people can benefit from it.
 *
 */

session_start();
require_once 'config.php';

if (isset($_SESSION['logged_in'])) {
    header("Location: index.php");
    exit();
}

$error = "";
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = $_POST['password'];

    $query = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        if (password_verify($password, $user['password'])) {
            $_SESSION['logged_in'] = true;
            $_SESSION['username'] = $user['username'];
            header("Location: index.php");
            exit();
        }
    }
    $error = "Incorrect username or password!";
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <title>Your Name - URL Shortener</title>
    <meta name="description" content="Your website description">
    <meta name="keywords" content="your keyword, separated by commas">
    <link rel="shortcut icon" href="assets/favicon.png">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 h-screen flex items-center justify-center">
    <form method="POST" class="bg-white p-8 rounded-lg shadow-md w-80">
        <h2 class="text-xl font-bold mb-4">LOGIN ADMIN</h2>
        <?php if($error): ?> <p class="text-red-500 text-sm mb-2"><?= $error ?></p> <?php endif; ?>
        <input type="text" name="username" placeholder="username" class="w-full p-2 border rounded mb-3" required>
        <input type="password" name="password" placeholder="password" class="w-full p-2 border rounded mb-4" required>
        <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded">Login</button>
    </form>
</body>
</html>