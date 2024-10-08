<?php
    session_start();
    echo "Профиль администратора ".$_SESSION["login"].": "."<br>";
    echo "Ваш пароль: ".$_SESSION["password"]."<br>";
    echo "Ваш email: ".$_SESSION["email"]."<br>";

    $dsn = 'mysql:host=localhost;dbname=users;charset=utf8';
    $username = 'root';
    $password = '';
    $options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);
    $pdo = new PDO($dsn, $username, $password, $options);

    // Выполнение запроса
    $sql = "SELECT COUNT(*) FROM `users`";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    $count = $stmt->fetchColumn();
    echo "Кол-во пользователей = ".$count;
?>
<html>
<head>
    <meta http-equiv="content-type" content="charset=utf-8" />
    <style>
        body {
            background-color: #40E0D0;
            font-family: Arial, sans-serif;
        }

        .form-container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: left;
            justify-content: center;
            background-color: #40E0D0;
            padding: 20px;
            border-radius: 5px;
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
            width: 150px;
            box-sizing: border-box;
        }
        input[type="text"],
        input[type="password"],
        input[type="email"] {
            background-color: #EEE8AA;
        }
        input[type="submit"] {
            background-color: #008B8B;
            color: #fff;
            cursor: pointer;
        }
        input[type="submit"]:hover, button:hover {
            background-color: #008080;
        }
        a {
            color: #0000ff;
            text-decoration: none;
        }
    </style>
</head>
    <body>
        <form action="change.php" method="POST">
            <input type="submit" value="Поменять пароль" name="but"/>
        </form>
        <br>
        <form action="" method="POST">
            <label>Удалить пользователя с ником </label>
            <input type="text" name="log"/>
            <input name="del_but" value="Удалить" type="submit">
            <?php
                if (isset($_POST["del_but"])){
                        // устанавливаем соединение с базой данных
                        $dsn = "mysql:host=localhost;dbname=users;charset=utf8mb4";
                        $username = "root";
                        $password = "";
                        $options = [
                            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
                        ];

                        try {
                            $pdo = new PDO($dsn, $username, $password, $options);
                        } catch (PDOException $e) {
                            echo "Ошибка подключения к базе данных: " . $e->getMessage();
                            exit;
                        }

                        // логин пользователя, которого нужно удалить
                        $login = $_POST["log"];

                        // составляем SQL-запрос для удаления записи из таблицы
                        $sql = "DELETE FROM users WHERE login = :login";

                        // подготавливаем запрос
                        $stmt = $pdo->prepare($sql);

                        // выполняем запрос, передавая в качестве параметра логин пользователя
                        $stmt->execute(['login' => $login]);

                        // закрываем соединение с базой данных
                        $pdo = null;

                        echo "<br>"."Пользователь $login удален из базы данных";
                }
            ?>   
            <br><br><label>Забанить пользователя с ником </label>
            <input type="text" name="name_ban"/>
            <input name="but_ban" value="Забанить" type="submit">
            <?php
                if (isset($_POST['but_ban'])){
                    $pdo = new PDO("mysql:host=localhost;dbname=users", "root", "");

                    // Получаем логин пользователя, которого нужно забанить
                    $username = $_POST["name_ban"];

                    // Выполняем запрос к базе данных для обновления поля is_banned
                    $stmt = $pdo->prepare("UPDATE users SET is_banned = 1 WHERE login = ?");
                    $stmt->execute([$username]);
                }
            ?>
            <br><br><label>Разбанить пользователя с ником </label>
            <input type="text" name="name_rban"/>
            <input name="but_rban" type="submit" value="Разбанить">
            <?php
                if (isset($_POST['but_rban'])){
                    $pdo = new PDO("mysql:host=localhost;dbname=users", "root", "");

                    // Получаем логин пользователя, которого нужно забанить
                    $username = $_POST["name_rban"];

                    // Выполняем запрос к базе данных для обновления поля is_banned
                    $stmt = $pdo->prepare("UPDATE users SET is_banned = 0 WHERE login = ?");
                    $stmt->execute([$username]);
                }
            ?>   
        </form>
        <a href="adminpage.php">Назад</a>
    </body>
</html>