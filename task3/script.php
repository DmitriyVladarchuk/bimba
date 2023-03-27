<?php
$name = trim($_POST['name']);
//проверка ошибок
$errors = FALSE;
//проверка имени
if (empty($_POST['name']) || (!preg_match('/^[а-яёА-ЯЁ]+$/u', $name) && !preg_match('/^[a-zA-Z]+$/u', $name))) {
  print('Поле имя введено не корректно (вводите нужно только имя).<br/>');
  $errors = TRUE;
}
//проверка email
if(empty($_POST['email']) || !preg_match('/^(?:[a-z0-9]+(?:[-_.]?[a-z0-9]+)?@[a-z0-9_.-]+(?:\.?[a-z0-9]+)?\.[a-z]{2,5})$/i', $_POST['email'])){
    print('Поле email введено не корректно.<br/>');
  $errors = TRUE;
}
//проверка года !is_numeric($_POST['datee'])
if (empty($_POST['datee']) || !preg_match('/^[0-9]{4}-(0[1-9]|1[012])-(0[1-9]|1[0-9]|2[0-9]|3[01])$/', $_POST['datee'])) {
  print('Заполните год.<br/>');
  $errors = TRUE;
}
//проверка пола
if(empty($_POST['gender'])){
    print('выберите пол.<br/>');
    $errors = TRUE;
}
//проверка конечностей
if(empty($_POST['number_limb'])){
    print('выберите количество конечностей.<br/>');
    $errors = TRUE;
}
//проверка суперсособностей
if(empty($_POST['superpower'])){
    print('выберите суперспособность.<br/>');
    $errors = TRUE;
}
//проверка биографии
if(empty($_POST['biography'])){
    print('заполните биографию.<br/>');
    $errors = TRUE;
}
//проверка checkbox
if(empty($_POST['Contract'])){
    print('нажмите на checkbox.<br/>');
    $errors = TRUE;
}
if ($errors) {
    // При наличии ошибок завершаем работу скрипта.
    exit();
}

try{
    $user = 'u52869';
    $password = '6068422';
    $database = new PDO('mysql:host=localhost;dbname=u52869', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $statement = $database -> prepare("INSERT INTO user (name, email, datee, gender, number_limb, biography) VALUES (:name, :email, :datee, :gender, :number_limb, :biography)");
    $statement -> execute(['name' => $_POST['name'], 'email' => $_POST['email'], 'datee' => $_POST['datee'], 'gender' => $_POST['gender'], 'number_limb' => $_POST['number_limb'], 'biography' => $_POST['biography']]);
    $id_connection = $database -> lastInsertId();

   $statement = $database -> prepare("INSERT INTO connecter (user_id, superpower_id) VALUES (:user_id, :superpower_id)");
    foreach ($_POST['superpower'] as $superpower)
    {
        if ($superpower != false)
        {
            $statement -> execute(['user_id' => $id_connection, 'superpower_id' => $superpower]);
        }
    }

    print('Ваши данные отправлены.<br/>');
}
catch (PDOException $e)
{
    print('Error: ' .$e -> getMessage());
    exit();
}
?>