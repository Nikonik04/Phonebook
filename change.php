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
<form action="" method="POST">
    <div class="centered">
        <fieldset>
            <label>Логин</label>
            <input type="text" name="login"/><br>
            <label>Пароль</label>
            <input type="password" name="new_password"/>
            <input type="submit" value="Изменить" name="ch"/><br>
        </fieldset>
    </div>
    <?php
        if (isset($_POST["ch"])){
            session_start();
            // подключение к базе данных
            $pdo = new PDO('mysql:host=localhost;dbname=users', 'root', '');

            // получение данных из формы
            $login = $_POST['login'];
            $newPassword = $_POST['new_password'];

            // запрос на изменение пароля пользователя
            $sql = "UPDATE users SET password = :password WHERE login = :login";

            // подготовка запроса
            $stmt = $pdo->prepare($sql);

            // передача параметров в запрос и выполнение запроса
            $stmt->execute([
                'password' => $newPassword,
                'login' => $login
            ]);

            // проверка количества измененных записей
            if ($stmt->rowCount() > 0) {
                echo "Пароль успешно изменен";
            } else {
                echo "Ошибка при изменении пароля";
            }
            sleep(2);
            header("Location: index1.php");
        }
    ?>
</form>