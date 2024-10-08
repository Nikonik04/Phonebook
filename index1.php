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
        }
        .beg{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            margin-bottom: 5px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            border: 1px solid #ccc;
        }
        label {
            
        }

        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
            width: 100%;
            box-sizing: border-box;
        }
        input[type="text"],
        input[type="password"]{
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
        .title{
            margin: 20px;
            font-size: 20px;
            font-family: Arial, sans-serif;
            font-style: italic;
        }
        .end{
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 5px;
            margin-top: 165px;
            font-family: Arial, sans-serif;
            font-size: 16px;
            color: #333;
            line-height: 1.5;
            border: 1px solid #ccc;
        }
    </style>
</head>

<body>
    <div class="beg">
        Этот справочник преднаначен для поиска информации о телефонных номерах и их владельцах.
        Его база регулярно обновляется.
    </div>
    <form action="" method="POST">
        <div class="title">
            Pozvoni.by
        </div>
        <div class="centered">
            <fieldset>
                <label>Логин</label>
                <input type="text" name="login"/><br>
                <label>Пароль</label>
                <input type="password" name="password"/>
                <input type="submit" value="Войти" name="but1"/><br>
                <a href="reg.php">Ещё не зарегистрировались?</a>
            </fieldset>
        </div>
        <?php
            if (isset($_POST["but1"])){
                session_start();
                $pdo = new PDO("mysql:host=localhost;dbname=users;charset=utf8", 'root', '');

                $stmt = $pdo->prepare("SELECT password FROM users WHERE login = :login");
                $stmt->execute(['login' => $_POST["login"]]);
                $p = $stmt->fetchColumn();

                $stmt3 = $pdo->prepare("SELECT email FROM users WHERE login = :login");
                $stmt3->execute(['login' => $_POST["login"]]);
                $e = $stmt3->fetchColumn();
                $_SESSION["login"] = $_POST["login"];
                
                $_SESSION["email"] = $e;

                $_SESSION["user"] = FALSE;
                if (($_POST["login"] == "Nikonik") && ($_POST["password"]==$p)){
                    sleep(2);
                    $_SESSION["user"] = TRUE;
                    $_SESSION["password"] = $p;
                    header("Location: adminpage.php");
                    exit;
                }
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

                $stmt1 = $pdo->prepare("SELECT password FROM users WHERE login = :login");
                $stmt1->execute(['login' => $_POST["login"]]);

                // Извлечение значения из результата запроса
                $p = $stmt1->fetchColumn();

                $stmt3 = $pdo->prepare("SELECT email FROM users WHERE login = :login");
                $stmt3->execute(['login' => $_POST["login"]]);
                $e = $stmt3->fetchColumn();

                $stmt4 = $pdo->prepare("SELECT is_banned FROM users WHERE login = :login");
                $stmt4->execute(['login' => $_POST["login"]]);
                $b = $stmt4->fetchColumn();

                // проверяем, найден ли пользователь с указанным логином
                if (!$user) {
                    echo 'Неверный логин!';
                } else{
                    if ($_POST["password"]==$p){
                        if ($b == 1){
                            echo "<p>Вам ограничили доступ</p>";
                            exit;
                        }
                        $_SESSION["login"] = $_POST["login"];
                        $_SESSION["password"] = $_POST['password'];
                        $_SESSION["age"] = $a;
                        $_SESSION["email"] = $e;
                        $_SESSION["user"] = TRUE;
                        sleep(2);
                        setcookie('time1', time());
                        header('Location: userpage.php');
                    } else{
                        echo 'Проверьте правильность ввода пароля!';
                    }
                }
            }
        ?>
    </form>
    <div class="end">
        С вопросами и предложениями обращаться к <a href="mailto: rn7.mobile@gmail.com">администрации</a>
    </div>
</body>

</html>