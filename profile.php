<?php
    session_start();
    echo "Профиль пользователя ".$_SESSION["login"].": "."<br>";
    echo "Ваш пароль: ".$_SESSION["password"]."<br>";
    echo "Ваш email: ".$_SESSION["email"]."<br>";
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
        <a href="userpage.php">Назад</a>
    </body>
</html>