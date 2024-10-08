<!DOCTYPE html>
<html lang="ru">

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
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            margin-bottom: 10px;
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"],
        input[type="email"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
            width: 100%;
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
    </style>
</head>

<body>
<form action="" method="POST">
    <div class="centered">
        <fieldset>
            <label>Логин</label>
            <input type="text" name="login"/><br>
            <label>Пароль</label>
            <input type="password" name="password"/>
            <label>Почта</label>
            <input type="email" name="email"/>
            <input type="submit" value="Зарегистрироваться" name="but2"/><br>
        </fieldset>
    </div>
    <?php
        if (isset($_POST["but2"])){
            session_start();
            $_SESSION["user"] = FALSE;
            $host = 'localhost';
            $dbname = 'users';
            $username = 'root';
            $password = '';

            // создаем объект PDO для работы с базой данных
            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);

            // подготавливаем SQL запрос для поиска пользователя с указанным логином
            $stmt = $pdo->prepare('SELECT * FROM users WHERE login = :login');

            // задаем значение параметра :login
            $login = $_POST["login"];
            $stmt->bindParam(':login', $login);

            // выполняем запрос и получаем результат
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // проверяем, найден ли пользователь с указанным логином
            if ($user) {
                echo 'Логин уже занят';
            } else {
            $host = 'localhost';
            $user = 'root';    
            $pass = ''; 
            $db_name = 'users';   
            $link = mysqli_connect($host, $user, $pass, $db_name); // Соединяемся с базой
            if ((strlen($_POST["login"])>12) || (strlen($_POST["login"])<4)){
                echo "<p>Логин должен быть длиной от 4 до 12 символов!</p>";
                exit;
            }
            if ((strlen($_POST["password"])>15) || (strlen($_POST["password"])<6)){
                echo "<p>Пароль должен быть длиной от 6 до 15 символов!</p>";
                exit;
            }
            
            $_SESSION["login"] = $_POST["login"];
            $stmt1 = $pdo->prepare("SELECT password FROM users WHERE login = :login");
            $stmt1->execute(['login' => $_POST["login"]]);

            // Извлечение значения из результата запроса
            $p = $stmt1->fetchColumn();

            $stmt3 = $pdo->prepare("SELECT email FROM users WHERE login = :login");
            $stmt3->execute(['login' => $_POST["login"]]);
            $e = $stmt3->fetchColumn();
            $_SESSION["password"] = $_POST['password'];
            $_SESSION["email"] = $e;

            $sql = mysqli_query($link, "INSERT INTO `users` (`login`, `password`, `email`) VALUES ('{$_POST['login']}', '{$_POST['password']}', '{$_POST['email']}');");
            if ($sql) {
                echo '<p>Вы успешно зарегистрировались!</p>';
                $_SESSION["user"] = TRUE;
                $_SESSION["email"] = $_POST["email"];
                sleep(2);
                header('Location: userpage.php');
              } else {
                echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
            }
            }
        }
    ?>
</form>
</body>

</html>