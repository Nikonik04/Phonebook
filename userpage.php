<!DOCTYPE html>
<html lang="ru">

<head>
    <meta http-equiv="content-type" content="charset=utf-8" />
    <style>
        body {
            background-color: #40E0D0;
            font-family: Arial, sans-serif;
            font-size: 16px;
            line-height: 1.5;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        table th, table td {
            border: 1px solid #FF6347;
            padding: 8px;
            text-align: left;
        }

        table th {
            background-color: #008B8B;
            color: white;
        }

        form {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"], select {
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            background-color: #EEE8AA;
        }

        input[type="submit"], button {
            background-color: #008B8B;
            color: white;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover, button:hover {
            background-color: #008080;
        }
        a {
            color: #0000ff;
            text-decoration: none;
            float: right;
        }
        .welcome-text {
        text-align: right;
        }
        

        form input[name="exit"] {
            float: right;
        }
    </style>
</head>

<body>
<?php
    session_start();
    if (!isset($_SESSION['user'])) {
        header('Location: index1.php');
        exit;
    }
    echo "<div class=\"welcome-text\"> Добро пожаловать, ".$_SESSION["login"]."<br>";
    echo "Ваш статус -> пользователь</div>";
?>
<form action="" method="POST">
    <input type="submit" name="exit" value="Выйти"/>
    <?php
        if (isset($_POST["exit"])){
            session_destroy();
            unset($_SESSION['user']);
            header("Location: index1.php");
        }
    ?>
    <a href="profile.php">Профиль</a>
</form><br>
<form method="POST">
        <?php
            if (isset($_POST["butt2"])){
                // установка соединения с базой данных
                $host = "localhost";
                $username = "root";
                $password = "";
                $dbname = "telefon";
                $conn = mysqli_connect($host, $username, $password, $dbname);

                // выборка данных из таблицы
                $sql = "SELECT * FROM telefon";
                $result = mysqli_query($conn, $sql);

                // вывод данных в виде таблицы
                if (mysqli_num_rows($result) > 0) {
                    echo "<table border=solid><tr><th>Фамилия</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    while($row = mysqli_fetch_assoc($result)) {
                        echo "<tr><td>".$row["fio"]."</td><td>".$row["name"]."</td><td>".$row["date"]."</td><td>".$row["adres"]."</td><td>".$row["number"]."</td><td>".$row["info"]."</td></tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 results";
                }

                // закрытие соединения с базой данных
                mysqli_close($conn);
            }
            if (isset($_POST["butt3"])){
                if ((isset($_POST["n"])) and ($_POST["n"]==1)){
                    // подключение к базе данных
                    $db = new mysqli('localhost', 'root', '', 'telefon');

                    // выборка данных из таблицы
                    $result = $db->query("SELECT * FROM telefon ORDER BY fio");

                    // вывод данных в виде таблицы
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['fio'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['number'] . "</td>";
                        echo "<td>" . $row['info'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==2)){
                    // подключение к базе данных
                    $db = new mysqli('localhost', 'root', '', 'telefon');

                    // выборка данных из таблицы
                    $result = $db->query("SELECT * FROM telefon ORDER BY name");

                    // вывод данных в виде таблицы
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['fio'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['number'] . "</td>";
                        echo "<td>" . $row['info'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==3)){
                    // подключение к базе данных
                    $db = new mysqli('localhost', 'root', '', 'telefon');

                    // выборка данных из таблицы
                    $result = $db->query("SELECT * FROM telefon ORDER BY date");

                    // вывод данных в виде таблицы
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['fio'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['number'] . "</td>";
                        echo "<td>" . $row['info'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==4)){
                    // подключение к базе данных
                    $db = new mysqli('localhost', 'root', '', 'telefon');

                    // выборка данных из таблицы
                    $result = $db->query("SELECT * FROM telefon ORDER BY adres");

                    // вывод данных в виде таблицы
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['fio'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['number'] . "</td>";
                        echo "<td>" . $row['info'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==5)){
                    // подключение к базе данных
                    $db = new mysqli('localhost', 'root', '', 'telefon');

                    // выборка данных из таблицы
                    $result = $db->query("SELECT * FROM telefon ORDER BY number");

                    // вывод данных в виде таблицы
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['fio'] . "</td>";
                        echo "<td>" . $row['name'] . "</td>";
                        echo "<td>" . $row['date'] . "</td>";
                        echo "<td>" . $row['adres'] . "</td>";
                        echo "<td>" . $row['number'] . "</td>";
                        echo "<td>" . $row['info'] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                }
            }
            if (isset($_POST["butt4"])){
                if ((isset($_POST["n"])) and ($_POST["n"]==1)){
                    $search = $_POST['search'];
                    $dsn = 'mysql:host=localhost;dbname=telefon;charset=utf8';
                    $pdo = new PDO($dsn, 'root', '');
                    // Подготавливаем SQL запрос с использованием подстановки
                    $stmt = $pdo->prepare("SELECT * FROM telefon WHERE fio = ?");
                    
                    // Выполняем запрос с передачей параметра
                    $stmt->execute([$search]);
                    
                    // Получаем результаты запроса в виде массива объектов
                    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
                    
                    // Выводим результаты поиска в виде таблицы
                    if ($results){
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    foreach ($results as $row) {
                        echo "<tr><td>$row->fio</td><td>$row->name</td><td>$row->date</td><td>$row->adres</td><td>$row->number</td><td>$row->info</td></tr>";
                    }
                    echo "</table>";}
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==2)){
                    $search = $_POST['search'];
                    $dsn = 'mysql:host=localhost;dbname=telefon;charset=utf8';
                    $pdo = new PDO($dsn, 'root', '');
                    // Подготавливаем SQL запрос с использованием подстановки
                    $stmt = $pdo->prepare("SELECT * FROM telefon WHERE name = ?");
                    
                    // Выполняем запрос с передачей параметра
                    $stmt->execute([$search]);
                    
                    // Получаем результаты запроса в виде массива объектов
                    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
                    
                    // Выводим результаты поиска в виде таблицы
                    if ($results){
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    foreach ($results as $row) {
                        echo "<tr><td>$row->fio</td><td>$row->name</td><td>$row->date</td><td>$row->adres</td><td>$row->number</td><td>$row->info</td></tr>";
                    }
                    echo "</table>";}
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==3)){
                    $search = $_POST['search'];
                    $dsn = 'mysql:host=localhost;dbname=telefon;charset=utf8';
                    $pdo = new PDO($dsn, 'root', '');
                    // Подготавливаем SQL запрос с использованием подстановки
                    $stmt = $pdo->prepare("SELECT * FROM telefon WHERE date = ?");
                    
                    // Выполняем запрос с передачей параметра
                    $stmt->execute([$search]);
                    
                    // Получаем результаты запроса в виде массива объектов
                    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
                    
                    // Выводим результаты поиска в виде таблицы
                    if ($results){
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    foreach ($results as $row) {
                        echo "<tr><td>$row->fio</td><td>$row->name</td><td>$row->date</td><td>$row->adres</td><td>$row->number</td><td>$row->info</td></tr>";
                    }
                    echo "</table>";}
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==4)){
                    $search = $_POST['search'];
                    $dsn = 'mysql:host=localhost;dbname=telefon;charset=utf8';
                    $pdo = new PDO($dsn, 'root', '');
                    // Подготавливаем SQL запрос с использованием подстановки
                    $stmt = $pdo->prepare("SELECT * FROM telefon WHERE adres = ?");
                    
                    // Выполняем запрос с передачей параметра
                    $stmt->execute([$search]);
                    
                    // Получаем результаты запроса в виде массива объектов
                    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
                    
                    // Выводим результаты поиска в виде таблицы
                    if ($results){
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    foreach ($results as $row) {
                        echo "<tr><td>$row->fio</td><td>$row->name</td><td>$row->date</td><td>$row->adres</td><td>$row->number</td><td>$row->info</td></tr>";
                    }
                    echo "</table>";}
                }
                if ((isset($_POST["n"])) and ($_POST["n"]==5)){
                    $search = $_POST['search'];
                    $dsn = 'mysql:host=localhost;dbname=telefon;charset=utf8';
                    $pdo = new PDO($dsn, 'root', '');
                    // Подготавливаем SQL запрос с использованием подстановки
                    $stmt = $pdo->prepare("SELECT * FROM telefon WHERE number = ?");
                    
                    // Выполняем запрос с передачей параметра
                    $stmt->execute([$search]);
                    
                    // Получаем результаты запроса в виде массива объектов
                    $results = $stmt->fetchAll(PDO::FETCH_OBJ);
                    
                    // Выводим результаты поиска в виде таблицы
                    if ($results){
                    echo "<table border=solid>";
                    echo "<table border=solid><tr><th>ФИО</th><th>Имя</th><th>Дата рождения</th><th>Адрес проживания</th><th>Номер телефона</th><th>Прочая информация</th></tr>";
                    foreach ($results as $row) {
                        echo "<tr><td>$row->fio</td><td>$row->name</td><td>$row->date</td><td>$row->adres</td><td>$row->number</td><td>$row->info</td></tr>";
                    }
                    echo "</table>";}
                }
            }
        ?>
        <br>
        <button name="butt2">Прочитать</button>
        <select name="n">
            <option value="1">По фамилии</option>
            <option value="2">По имени</option>
            <option value="3">По дате</option>
            <option value="4">По адресу</option>
            <option value="5">По номеру</option>
        </select>
        <input type="text" name="search" id="search">
        <button name="butt4">Поиск</button>
        <button name="butt3">Сортировать</button>
    </form>
</body>

</html>