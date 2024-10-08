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
        input[type="number"],
        input[type="date"],
        input[type="textarea"] {
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
        a {
            color: #0000ff;
            text-decoration: none;
        }
    </style>
</head>

<body>
<form action="" method="POST">
        <div>
            <fieldset>
                <legend>Добавление записи в БД</legend>
                <div>
                    <label>Фамилия</label>
                    <input type="text" size=40 name="fio" autocomplete="off" autofocus><br>
                    <label>Имя</label>
                    <input type="text" name="name" autocomplete="off"><br>
                    <label for="date">Дата рождения</label>
                    <input type="date" id="date" name="date" autocomplete="off"><br>
                    <label>Адрес проживания</label>
                    <input type="text" size=40 name="adres" autocomplete="off"><br>
                    <label>Номер телефона</label>
                    <input type="text" size=40 name="tel" autocomplete="off">
                    <label>Прочее</label>
                    <input type="textarea" name="info" autocomplete="off"/>
                </div>
            </fieldset>
        </div>
        <br><input type="submit" value="Отправить" name="b">
        <?php
            if (isset($_POST["b"])){
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "telefon";

                // Создаем подключение к базе данных
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Проверяем, удалось ли подключиться к базе данных
                if ($conn->connect_error) {
                    die("Ошибка подключения к базе данных: " . $conn->connect_error);
                }

                // Получаем данные из формы
                $fio = $_POST["fio"];
                $name = $_POST["name"];
                $date = $_POST["date"];
                $adres = $_POST["adres"];
                $tel = $_POST["tel"];
                $info = $_POST["info"];

                // Готовим SQL-запрос для сохранения данных в базу данных
                $sql = "INSERT INTO telefon (fio, name, date, adres, number, info) VALUES ('$fio', '$name', '$date', '$adres', '$tel', '$info')";

                // Выполняем запрос
                if ($conn->query($sql) === TRUE) {
                    echo "Данные успешно сохранены в базе данных";
                } else {
                    echo "Ошибка: " . $sql . "<br>" . $conn->error;
                }

                // Закрываем подключение к базе данных
                $conn->close();
                header('Location: adminpage.php');
                    }
        ?>
    </form>
</body>

</html>