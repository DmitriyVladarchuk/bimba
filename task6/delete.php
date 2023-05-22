<?php
$user_id = $_GET['rn'];
    $user = 'u52869';
    $password = '6068422';
    $database = new PDO('mysql:host=localhost;dbname=u52869', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $result = $database -> exec("delete from user where user_id = '$user_id'");
    $resultComporator = $database -> exec("delete from connecter where user_id = '$user_id'");
    header('Location: ./admin.php');
?>