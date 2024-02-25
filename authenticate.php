<?php
// Пользователи и пароли (замените на свои)
$users = array(
    'user1' => 'password1',
    'user2' => 'password2'
);

// Проверка аутентификации
function authenticate() {
    header('WWW-Authenticate: Basic realm="Restricted Area"');
    header('HTTP/1.0 401 Unauthorized');
    echo 'Доступ запрещен';
    exit;
}

// Проверка существования пользователя и соответствия пароля
function check_credentials($username, $password, $users) {
    return isset($users[$username]) && $users[$username] === $password;
}

// Проверяем, переданы ли данные аутентификации
if (!isset($_SERVER['PHP_AUTH_USER']) || !isset($_SERVER['PHP_AUTH_PW'])) {
    authenticate();
} else {
    // Проверяем введенные данные
    if (check_credentials($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'], $users)) {
        echo 'Добро пожаловать, ' . htmlspecialchars($_SERVER['PHP_AUTH_USER']) . '.';
    } else {
        authenticate();
    }
}
?>
