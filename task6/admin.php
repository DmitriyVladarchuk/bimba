<?php
  header('Content-Type: text/html; charset=UTF-8');
  session_start();
  if ($_SERVER['REQUEST_METHOD'] == 'GET'){
      if (empty($_SERVER['PHP_AUTH_USER']) ||
      empty($_SERVER['PHP_AUTH_PW']) ||
      $_SERVER['PHP_AUTH_USER'] != 'admin' ||
      md5($_SERVER['PHP_AUTH_PW']) != md5('123')) {
      header('HTTP/1.1 401 Unanthorized');
      header('WWW-Authenticate: Basic realm="My site"');
      print('<h1>401 Требуется авторизация</h1>');
      exit();
    }
    $user = 'u52869';
    $password = '6068422';
    $database = new PDO('mysql:host=localhost;dbname=u52869', $user, $password, [PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $result = $database -> query("SELECT * FROM user");
    $resultConnector = $database -> query("SELECT * FROM connecter");
    $row1 = $resultConnector -> fetch();

    //print('Вы успешно авторизовались и видите защищенные паролем данные.');
    ?>
    <head>
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
      <!-- <link rel="stylesheet" type="text/css" href="styles.css"> -->
    </head>
    <body>
      <div style="margin: 50px;">
      <a href="index.php">Добавить клиента</a>
      <table class="table table-bordered border-dark">
        <thead class="table-dark">
          <tr>
            <th>user_id</th>
            <th>name</th>
            <th>email</th>
            <th>datee</th>
            <th>gender</th>
            <th>number_limb</th>
            <th>biography</th>
            <th>действие</th>
          </tr>
        </thead>
        <tbody>
        <?php
          while($row = $result -> fetch()){
            echo "<tr>
            <td> <input value=".$row["user_id"]."></td> 
            <td><input value=".$row["name"]."></td>
            <td><input value=".$row["email"]."></td>
            <td><input value=".$row["datee"]."></td>
            <td><input value=".$row["gender"]."></td>
            <td><input value=".$row["number_limb"]."></td>
            <td><input value=".$row["biography"]."></td>
            <td>
            <a href='edit.php?rn=".$row["user_id"]."'>изменить</a><br>
            <a href='delete.php?rn=".$row["user_id"]."'>удалить</a>
            </td>
            </tr>";
          }
          echo '</tr>';
        ?>
        </tbody>
      </table>
      <p class="fs-1">Статистика</p>
      <?php
      $result1 = $database -> query("SELECT * FROM connecter WHERE superpower_id  = 1");
      $result2 = $database -> query("SELECT * FROM connecter WHERE superpower_id  = 2");
      $result3 = $database -> query("SELECT * FROM connecter WHERE superpower_id  = 3");
      $count1 = 0;
      $count2 = 0;
      $count3 = 0;
      while($rowCon = $result1 -> fetch()){
        if($rowCon['superpower_id'] == 1){
          $count1++;
        }
      }
      while($rowCon = $result2 -> fetch()){
        if($rowCon['superpower_id'] == 2){
          $count2++;
        }
      }
      while($rowCon = $result3 -> fetch()){
        if($rowCon['superpower_id'] == 3){
          $count3++;
        }
      }
      echo '<p style = "margin-bottom: 5px;">бессмертие - '.$count1.'</p>';
      echo '<p style = "margin-bottom: 5px;">прохождение сквозь стены - '.$count2.'</p>';
      echo '<p style = "margin-bottom: 5px;">левитация - '.$count3.'</p>';
      ?>
      </div>
    </body>
    <?php
  }
/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.

// *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********
