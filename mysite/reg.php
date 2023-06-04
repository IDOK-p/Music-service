<?php 
  include("path.php");
  include("app/controllers/users.php");
?>

<!doctype html>
<html lang="ru">
  <head>
    <!-- Обязательные метатеги -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!--Custom Styling -->
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Регистрация</title>
  </head>
  <body>
    <!--header start-->
    <?php include("app/include/header.php");?>
    <!--header end-->

    <!--FORM START-->
    <div class="container reg_form">
        <form class="row justify-content-md-center" method="post" action="reg.php">
          <h2>Форма регистрации</h2>
          <div class="mb-3 col-12 col-md-4 err">                    
              <!-- Вывод массива с ошибками -->
              <?php include("app/helps/errorInfo.php"); ?>
          </div>          
          <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="formGroupExampleInput" class="form-label">Ваш логин</label>
                <input name="login" value="<?=$login?>" type="text" class="form-control" id="formGroupExampleInput" placeholder="Введите Ваш логин">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
              <label for="exampleInputEmail1" class="form-label">Email</label>
              <input name="mail" value="<?=$email?>" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"placeholder="Введите Ваш email">
              <div id="emailHelp" class="form-text">Ваш email адрес не будет использован для спама!</div>
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
              <label for="exampleInputPassword1" class="form-label">Пароль</label>
              <input name="pass-first" type="password" class="form-control" id="exampleInputPassword1" placeholder="Введите Ваш пароль">
            </div>
            <div class="w-100"></div>
            <div class="mb-3 col-12 col-md-4">
                <label for="exampleInputPassword2" class="form-label">Повторите пароль</label>
                <input name="pass-second" type="password" class="form-control" id="exampleInputPassword2" placeholder="Повторите Ваш пароль">
            </div>
            <div class="w-100"></div>    
            <div class="mb-3 col-12 col-md-4">
              <button type="submit" class="btn btn-secondary" name="button-reg">Регистрация</button>
              <a href="<?php echo BASE_URL . "log.php"; ?>">Войти</a>
            </div>    
            
        </form>
    </div>
    <!--FORM END-->

    <!--footer-->
    <?php include("app/include/footer.php");?>
    <!--footer END-->
  
  
      <!-- Необязательный JavaScript; выберите один из двух! -->
  
      <!-- Вариант 1: пакет Bootstrap с Popper -->
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  
      <!-- Вариант 2: отдельные JS для Popper и Bootstrap -->
      <!--
      <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
      -->
    </body>
  </html>