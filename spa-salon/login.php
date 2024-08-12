<?php
session_start();
require('functions.php');

if (getCurrentUser()) {
    header('Location: index.php');
    exit;
}

$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'];
    $password = $_POST['password'];

    if (checkPassword($login, $password)) {
        $_SESSION['user'] = $login;
        $_SESSION['login_time'] = time();
        header('Location: index.php');
        exit;
    } else {
        $message = 'Invalid login or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
</head>
<body>
<h2>Login</h2>
<form method="POST">
    Login: <input type="text" name="login" required>
    Password: <input type="password" name="password" required>
    <button type="submit">Submit</button>
</form>
<?php if ($message): ?>
    <p><?= $message ?></p>
<?php endif; ?>
</body>
</html>