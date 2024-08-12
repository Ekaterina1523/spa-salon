<?php
session_start();
require('functions.php');

$user = getCurrentUser();
if (!$user) {
    header('Location: login.php');
    exit;
}

$users = getUsersList();
$userData = $users[$user];
$loginTime = $_SESSION['login_time'];
$currentTime = time();
$timeLeft = 86400 - ($currentTime - $loginTime);

$message = "Welcome, $user! You have a personal discount.";
if ($timeLeft <= 0) {
    $timeLeft = 0;
    $message = "Your personal discount has expired.";
}

$bdaysLeft = daysToBirthday(new DateTime($userData['bday']));
if ($bdaysLeft == 0) {
    $birthdayMessage = "Happy Birthday! You have 5% off all services!";
} else {
    $birthdayMessage = "Your birthday is in $bdaysLeft days.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Index</title>
</head>
<body>
<h2>Main Page</h2>
<p><?= $message ?></p>
<p><?= $birthdayMessage ?></p>
<p>Discount time left: <?= gmdate("H:i:s", $timeLeft) ?></p>
<form method="POST" action="logout.php">
    <button type="submit">Logout</button>
</form>
</body>
</html>