<?php

$userDataFile = 'user_data.txt';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Отримання даних з форми
    $login = isset($_POST['login']) ? $_POST['login'] : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    // Читання правильного логіну та пароля з файлу
    if (file_exists($userDataFile)) {
        $userData = file_get_contents($userDataFile);
        list($correctLogin, $correctPassword) = explode("\n", $userData);

        // Видалення зайвих пробілів і перевірка
        $correctLogin = trim($correctLogin);
        $correctPassword = trim($correctPassword);

        if ($login === $correctLogin && $password === $correctPassword) {
            $message = 'Ви залогінені!';
        } else {
            $message = 'Неправильний логін або пароль!';
        }
    } else {
        $message = 'Помилка: файл з даними користувача не знайдено!';
    }
} else {
    $message = ''; // Якщо форма не була відправлена
}
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Форма Авторизації</title>
    <style>
        /* Ваши стили остаются неизменными */
        body {
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f0f0f0;
            font-family: Arial, sans-serif;
        }

        .login-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 50px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 300px;
            text-align: center;
            align-items: center;
        }

        .login-form label {
            display: block;
            text-align: left;
            margin-bottom: 5px;
            font-size: 14px;
            color: #555;
            width: 100%;
        }

        .login-form input {
            width: 90%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 14px;
        }

        .login-form button {
            width: 61.25%;
            padding: 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        .login-form button:hover {
            background-color: #0056b3;
        }

        .login-form p {
            margin-top: 15px;
            font-size: 14px;
            text-align: center;
            color: #e74c3c;
        }

        /* Новые стили для кнопки показа пароля */
        .show-password-btn {
            background: none;
            border: none;
            color: #007bff;
            font-size: 14px;
            cursor: pointer;
            margin-top: -10px;
            text-decoration: underline;
        }

    </style>
</head>
<body>
    <form class="login-form" method="POST" action="">
        <h1>Авторизація</h1>
        <label for="login">Логін:</label>
        <input type="text" id="login" name="login" required>
        
        <label for="password">Пароль:</label>
        <input type="password" id="password" name="password" required>
        
        <!-- Кнопка для показа/скрытия пароля -->
        <button type="button" class="show-password-btn" onclick="togglePassword()">Показати пароль</button>

        <button type="submit">Увійти</button>
        <p><?= htmlspecialchars($message) ?></p>
    </form>

    <script>
        // Функция для переключения типа поля ввода пароля
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var button = document.querySelector(".show-password-btn");

            // Проверка текущего типа поля
            if (passwordField.type === "password") {
                passwordField.type = "text"; // Показываем пароль
                button.textContent = "Сховати пароль"; // Меняем текст на кнопке
            } else {
                passwordField.type = "password"; // Скрываем пароль
                button.textContent = "Показати пароль"; // Меняем текст на кнопке
            }
        }
    </script>
</body>
</html>
