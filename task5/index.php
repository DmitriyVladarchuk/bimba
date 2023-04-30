<?php

//  Отправляем браузеру кодировку
header('Content-Type: text/html; charset=UTF-8');
setlocale(LC_ALL, "ru_RU.UTF-8");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //  Массив для хранения сообщений пользователю
    $messages = array();
    // В суперглобальном массиве $_COOKIE PHP хранит все имена и значения куки текущего запроса.
    if (!empty($_COOKIE['save'])) {
        setcookie('save', '', time() + 24 * 60 * 60);
        $messages[] = 'Ваши данные сохранены!';
    }
    //  Массив для хранения ошибок
    $errors = array();
    $errors['name'] = !empty($_COOKIE['name_error']);
    $errors['email'] = !empty($_COOKIE['email_error']);
    $errors['datee'] = !empty($_COOKIE['date_error']);
    $errors['gender'] = !empty($_COOKIE['gender_error']);
    $errors['number_limb'] = !empty($_COOKIE['limb_error']);
    $errors['superpower'] = !empty($_COOKIE['superpowers_error']);
    $errors['biography'] = !empty($_COOKIE['biography_error']);
    $errors['Contract'] = !empty($_COOKIE['signed_error']);

    //  Сообщения об ошибках
    if ($errors['name']) {
        setcookie('name_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Введите Имя.</div>';
    }
    if ($errors['email']) {
        setcookie('email_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Введите email.</div>';
    }
    if ($errors['datee']) {
        setcookie('date_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите год рождения.</div>';
    }
    if ($errors['gender']) {
        setcookie('gender_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите пол.</div>';
    }
    if ($errors['number_limb']) {
        setcookie('limb_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите кол-во конечностей.</div>';
    }
    if ($errors['superpower']) {
        setcookie('superpowers_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Выберите суперсилы.</div>';
    }
    if ($errors['Contract']) {
        setcookie('signed_error', '', time() + 24 * 60 * 60);
        $messages[] = '<div class="error">Согласитесь с условиями контракта.</div>';
    }

    //  Сохраняем значения полей в массив
    $values = array();
    $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
    $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
    $values['datee'] = empty($_COOKIE['date_value']) ? '' : $_COOKIE['date_value'];
    $values['gender'] = empty($_COOKIE['gender_value']) ? '' : $_COOKIE['gender_value'];
    $values['number_limb'] = empty($_COOKIE['limbs_value']) ? '' : $_COOKIE['limbs_value'];
    $values['superpower'] = empty($_COOKIE['superpowers_value']) ? '' : $_COOKIE['superpowers_value'];
    $values['biography'] = empty($_COOKIE['biography_value']) ? '' : $_COOKIE['biography_value'];
    $values['Contract'] = empty($_COOKIE['signed_value']) ? '' : $_COOKIE['signed_value'];

    //  Включаем файл form.php
    //  в него передаются переменные $messages, $errors, $values
    include('form.php');
} else {
    //  Если метод был POST
    //  Флаг для отлова ошибок полей
    $errors = FALSE;
    if (empty($_POST['name'])) {
        setcookie('name_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^[a-zA-Zа-яёА-ЯЁ\s\-]+$/u', $_POST['name'])) {
            setcookie('name_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('name_value', $_POST['name'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['email'])) {
        setcookie('email_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^([a-z0-9_-]+\.)*[a-z0-9_-]+@[a-z0-9_-]+(\.[a-z0-9_-]+)*\.[a-z]{2,6}$/', $_POST['email'])) {
            setcookie('email_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('email_value', $_POST['email'], time() + 31 * 24 * 60 * 60);
        }
    }
    if (empty($_POST['datee'])) { setcookie('date_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['datee'] == "0001-01-01")
                {
                    setcookie('date_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('date_value', $_POST['datee'], time() + 60 * 60 * 24 * 31);
            }

    if (empty($_POST['gender'])) { setcookie('gender_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['gender'] != "Female" && $_POST['gender'] != "Male")
                {
                    setcookie('gender_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('gender_value', $_POST['gender'], time() + 60 * 60 * 24 * 31);
            }
    if (empty($_POST['number_limb'])) { setcookie('limb_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
            else
            {
                if ($_POST['number_limb'] != 4 && $_POST['number_limb'] != 5 && $_POST['number_limb'] != 6)
                {
                    setcookie('limb_error', '2', time() + 24 * 60 * 60);
                    $errors = TRUE;
                }
                else setcookie('limb_value', $_POST['number_limb'], time() + 60 * 60 * 24 * 31);
            }

    if (empty($_POST['superpower'])) { setcookie('superpowers_error', '1', time() + 24 * 60 * 60); $errors = TRUE; }
    else
    {
        setcookie("superpowers_error","",1000000);
        setcookie("1","",1000000);
        setcookie("2","",1000000);
        setcookie("3","",1000000);
        $super=$_POST["superpower"];
        foreach($super as $cout){
          if($cout =="1"){
            setcookie("1","true");
          }
          if($cout =="2"){
            setcookie("2","true");
          }
          if($cout =="3"){
            setcookie("3","true");
          }
        }
    }


    setcookie('biography_value', $_POST['biography'], time() + 60 * 60 * 24 * 31);



    if (empty($_POST['Contract'])) {
        setcookie('signed_error', '1', time() + 24 * 60 * 60);
        $errors = TRUE;
    } else {
        if (!preg_match('/^\d+$/', $_POST['Contract'])) {
            setcookie('signed_error', '2', time() + 24 * 60 * 60);
            $errors = TRUE;
        } else {
            setcookie('signed_value', $_POST['Contract'], time() + 31 * 24 * 60 * 60);
        }
    }


    if ($errors) {
        header('Location: index.php');
        exit();
    } else {
        setcookie('name_error', '', 100000);
        setcookie('email_error', '', 100000);
        setcookie('date_error', '', 100000);
        setcookie('gender_error', '', 100000);
        setcookie('limb_error', '', 100000);
        setcookie('superpowers_error', '', 100000);
        setcookie('biography_error', '', 100000);
        setcookie('signed_error', '', 100000);
    }
    //*************************
    $user = 'u52869';
    $password = '6068422';
    $database = new PDO('mysql:host=localhost;dbname=u52869', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

    if (!empty($_COOKIE[session_name()]) && session_start() && !empty($_SESSION['login']))
    {
        $statement = $database -> prepare("UPDATE user SET name = ?, email = ?, datee = ?, gender = ?, number_limb = ?, biography = ? WHERE user_id = ?");
        $statement -> execute([$_POST['name']], [$_POST['email']], [$_POST['datee']], [$_POST['gender']], [$_POST['number_limb']], [$_POST['biography']], $_SESSION['uid']);
        $statement_sup = $database -> prepare("INSERT INTO connecter SET user_id = ?, superpower_id  = ?");
        foreach($_POST['superpower'] as $superpowers)
            $statement_sup -> execute($_SESSION['uid'], $superpowers);
    }

    else
    {
        $user_login = uniqid('', true);
        $user_password = rand(1, 1000);
        setcookie('login', $user_login);
        setcookie('password', $user_password);

         //отправка данных в базу
        $statement = $database -> prepare("INSERT INTO user (name, email, datee, gender, number_limb, biography) VALUES (:name, :email, :datee, :gender, :number_limb, :biography)");
        $statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'datee' => $_POST['datee'], 'gender' => $_POST['gender'], 'number_limb' => $_POST['number_limb'], 'biography' => $_POST['biography']]);
        $id_connection = $database -> lastInsertId();
        
        $statement = $database -> prepare("INSERT INTO connecter (user_id, superpower_id) VALUES (:user_id, :superpower_id)");
        foreach ($_POST['superpower'] as $superpower)
        {
            if ($superpowers != false)
            {
                $statement -> execute(['user_id' => $id_connection, 'superpower_id' => $superpower]);
            }
         }
        $statement = $database -> prepare("INSERT INTO user_info SET id_login = ?, user_login = ?, user_password = ?");
        $statement -> execute([$id_connection, $user_login, md5($user_password)]);
    }
/*
    $user = 'u52869';
$password = '6068422';

try{
$database = new PDO('mysql:host=localhost;dbname=u52869', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
print('Ваши данные отправлены.<br/>');
}
catch (PDOException $e)
{
print('Error: ' .$e -> getMessage());
exit();
}

$statement = $database -> prepare("INSERT INTO user (name, email, datee, gender, number_limb, biography) VALUES (:name, :email, :datee, :gender, :number_limb, :biography)");
$statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'datee' => $_POST['datee'], 'gender' => $_POST['gender'], 'number_limb' => $_POST['number_limb'], 'biography' => $_POST['biography']]);
$id_connection = $database -> lastInsertId();

$statement = $database -> prepare("INSERT INTO connecter (user_id, superpower_id) VALUES (:user_id, :superpower_id)");
foreach ($_POST['superpower'] as $superpower)
{
   if ($superpowers != false)
   {
       $statement -> execute(['user_id' => $id_connection, 'superpower_id' => $superpower]);
   }
}

*/

    //*************************
    setcookie('save', '1');
    header('Location: index.php');
}