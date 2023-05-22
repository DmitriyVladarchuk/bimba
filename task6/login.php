<?php
    header('Content-Type: text/html; charset=UTF-8');

    session_start();

    if (!empty($_SESSION['login']))
    {
        session_destroy();
        header('Location: ./');
    }
    if ($_SERVER['REQUEST_METHOD'] == 'GET')
    {
        ?>

        <head>
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <link rel="stylesheet" type="text/css" href="styles.css">
        </head>
        <body>
            <form action = "" method = "POST" class="content">
                <h1 class="form_title">Авторизация</h1>
                <div class="form_group">
                    <input name="log" class="form_input" placeholder=" ">
                    <label class="form_label">Логин:</label>
                </div>
                <div class="form_group">
                    <input name="pass" class="form_input" placeholder=" ">
                    <label class="form_label">Пароль:</label>
                </div>
                <!-- <input name = "user_login" type = "text" placeholder = "Логин" class = "txtb sf_input">
                <input name = "user_password" type = "text" placeholder = "Пароль" class = "txtb sf_input"> -->
                <input type = "submit" value = "Войти" class = "form_btn">
            </form>
        </body>

        <?php
        if (!empty($_GET['none']))
        {
            $message = "Неверные данные!";
            print($message);
        }
    }
    else
    {
        $user = 'u52869';
        $password = '6068422';
        $database = new PDO('mysql:host=localhost;dbname=u52869', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $user_login = $_POST['log'];
        $user_password = md5($_POST['pass']);
        $statement = $database -> prepare("SELECT id_login FROM user_info WHERE user_login = ? AND user_password = ?");
        $statement -> execute([$user_login, $user_password]);
        $user_id = $statement -> fetch(PDO::FETCH_COLUMN);

        if ($user_id)
        {
            $_SESSION['login'] = $_POST['log'];
            $_SESSION['uid'] = $user_id;
            $_COOKIE[session_name()] = "session_true";
            header('Location: ./');
        }

        else
        {
            print("ошибка");
        }
    }
?>