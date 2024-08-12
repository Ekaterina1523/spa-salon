<?php
$users = [
    'user1' => ['password' => password_hash('password1', PASSWORD_DEFAULT), 'bday' => '1990-01-15'],
    'user2' => ['password' => password_hash('password2', PASSWORD_DEFAULT), 'bday' => '1991-02-20']
];

function getUsersList() {
    global $users;
    return $users;
}

function existsUser($login) {
    $users = getUsersList();
    return array_key_exists($login, $users);
}

function checkPassword($login, $password) {
    $users = getUsersList();
    if (existsUser($login)) {
        return password_verify($password, $users[$login]['password']);
    }
    return false;
}

function getCurrentUser() {
    return isset($_SESSION['user']) ? $_SESSION['user'] : null;
}

function daysToBirthday($birthday) {
    $today = new DateTime();
    $birthdayThisYear = DateTime::createFromFormat('Y-m-d', date('Y') . $birthday->format('-m-d'));

    if ($today > $birthdayThisYear) {
        $birthdayThisYear->modify('+1 year');
    }

    $interval = $today->diff($birthdayThisYear);
    return $interval->days;
}
?>