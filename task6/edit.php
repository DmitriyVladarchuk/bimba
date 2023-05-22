<?php
    $user = 'u52869';
    $password = '6068422';
    $database = new PDO('mysql:host=localhost;dbname=u52869', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
if($_SERVER['REQUEST_METHOD'] == 'GET'){
    $user_id = $_GET['rn'];
    $result = $database -> query("SELECT * FROM user WHERE user_id = '$user_id'");
    $row = $result -> fetch();
}
else{
$name = $_POST['name'];
$email = $_POST['email'];
$datee = $_POST['datee'];
$gender = $_POST['gender'];
$number_limb = $_POST['number_limb'];
$biography = $_POST['biography'];
$result = $database -> query("UPDATE user SET name = '$name', email = '$email', datee = '$date', gender = '$gender', number_limb = '$number_limb', biography = '$biography' WHERE user_id = $user_id");
//$result = $database -> prepare("UPDATE user SET name = ?, email = ?, datee = ?, gender = ?, number_limb = ?, biography = ? WHERE user_id = ?");
//$result -> execute($_POST['name'], $_POST['email'], $_POST['datee'], $_POST['gender'], $_POST['number_limb'], $_POST['biography'], $user_id);
}
?>

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <form method="post">
        <p>Name: </p>
        <input name="name" value="<?php echo $row['name']?>">
        <p>Email: </p>
        <input name="email" value="<?php echo $row['email']?>">
        <p>Date: </p>
        <input name="datee" value="<?php echo $row['datee']?>">
        <p>Gender: </p>
        <input name="gender" value="<?php echo $row['gender']?>">
        <p>Number_limb: </p>
        <input name="number_limb" value="<?php echo $row['number_limb']?>">
        <p>Biography</p>
        <input name="biography" value="<?php echo $row['biography']?>">
        <input type = "submit" value = "Отправить данные" class = "form_btn">
    </form>
    
</body>