<html>
  <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Задание 6</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <style>
/* Сообщения об ошибках и поля с ошибками выводим с красным бордюром. */

    </style>
  </head>
  <body>

<?php
if (!empty($messages)) {
  print('<div id="messages">');
  // Выводим все сообщения.
  foreach ($messages as $message) {
    print($message);
  }
  print('</div>');
}

// Далее выводим форму отмечая элементы с ошибками классом error
// и задавая начальные значения элементов ранее сохраненными.
?>

<form action="" method="POST" class="content">
        <h1 class="form_title">Форма</h1>

        <div class="form_group <?php if ($errors['name']) {
            print 'error';
        } ?>">
            <input name="name" class="form_input" placeholder=" " value="<?php print $values['name']; ?>">
            <label class="form_label">Имя:</label>
        </div>

        <div class="form_group <?php if ($errors['email']) {
            print 'error';
        } ?>">
            <input name="email" class="form_input" placeholder=" "  value="<?php print $values['email']; ?>" <?php if ($errors['email']) {
                    print 'class="error"';
                } ?>>
            <label class="form_label">e-mail:</label>
        </div>
        
        <div class="group">
            <p class="text_label">Год рождения:</p>
            <input name="datee" type="date" value="<?php print $values['datee']; ?>" <?php if ($errors['datee']) {
                    print 'class="error"';
                } ?>>
        </div>

        <div class="group <?php if ($errors['gender']) {
            print 'error';
        } ?>">
            <p class="text_label">Пол:</p>
            <input name = "gender" type = "radio" value= Female <?php if ($values['gender'] == 'Female') {
                    print 'checked="checked"';
                } ?>>Женский
            <input name = "gender" type = "radio" value= Male <?php if ($values['gender'] == 'Male') {
                    print 'checked="checked"';
                } ?>>Мужской
        </div>

        <div class="group <?php if ($errors['number_limb']) {
            print 'error';
        } ?>">
            <p class="text_label">Количество конечностей:</p>
            <label class="text_label">4 </label>
            <input class="radio" name="number_limb" type="radio" value=4 <?php if ($values['number_limb'] == 4) {
                    print 'checked="checked"';
                } ?>>
            <label class="text_label">5 </label>
            <input class="radio" name="number_limb" type="radio" value=5 <?php if ($values['number_limb'] == 5 or empty($values['limb'])) {
                    print 'checked="checked"';
                } ?>>
            <label class="text_label">6 </label>
            <input class="radio" name="number_limb" type="radio" value=6 <?php if ($values['number_limb'] == 6) {
                    print 'checked="checked"';
                } ?>>
        </div>

        <div class = "<?php if ($errors['superpower']) {
            print 'error';
        } ?>">
            <label>
                Cверхспособности: <br>
                <select name="superpower[]" multiple="multiple">
                    <option  value = 1 <?php if (isset($_COOKIE["1"])) if ($_COOKIE["1"]=="true") echo "selected" ?> > Бессмертие </option>
                    <option  value = 2 <?php if (isset($_COOKIE["2"])) if ($_COOKIE["2"]=="true") echo "selected" ?> > Прохождение сквозь стены </option>
                    <option  value = 3 <?php if (isset($_COOKIE["3"])) if ($_COOKIE["3"]=="true") echo "selected" ?> > Левитация </option>
                </select><br>
            </label>
            <br>
        </div>

        <div class="group <?php if ($errors['biography']) {
            print ' error';
        } ?>">
            <textarea name = "biography" placeholder = "Биография" class = "form_textarea"> <?php print $values['biography']; ?> </textarea>
        </div>
        
        <div>
            <label><input name = "Contract" type = "checkbox" value = "1">С контрактом ознакомлен(а)</label>
            <br>
        </div>
        <input type = "submit" value = "Отправить данные" class = "form_btn">

        <br>
        <br>
        <div class="group">
            <a href = "login.php" class="labelInput"> <center>Войти</center> </a>
        </div>
        <div class="group">
            <a href = "admin.php" class="labelInput"> <center>Войти Админом</center> </a>
        </div>
        
    </form>
  </body>
</html>
