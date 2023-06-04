<?php 
  include("../../path.php");
  include("../../app/controllers/users.php"); 
  session_start();

  if (!$_SESSION){
    header('location: ' . 'http://localhost/mysite/log.php');                     
  }
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
    <link rel="stylesheet" href="../../assets/css/admin.css">

    <title>Пользователи</title>
  </head>
  <body>
    <!--header start-->
    <?php include("../../app/include/header-admin.php");?>
    <!--header end-->

    <!--main start-->
    <div class="container">
        <div class="row">
            <?php include("../../app/include/sidebar-admin.php"); ?>
            
            <div class="posts col-9">
              <div class="button row">
                    <a href="<?php echo BASE_URL . "admin/users/create.php"?>" class="col-2 btn btn-success">Создать</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . "admin/users/index.php"?>" class="col-3 btn btn-warning">Редактировать</a>
                </div>
                <div class="row title-table">
                    <h2>Управление пользователями</h2>
                    <div class="col-1">ID</div>
                    <div class="col-2">Логин</div>
                    <div class="col-3">Email</div>
                    <div class="col-2">Роль</div>
                    <div class="col-4">Управление</div>
                </div>
                <?php foreach ($users as $key => $user): ?>
                <div class="row post">
                    <div class="col-1"><?=$key + 1; ?></div>
                    <div class="col-2"><?=$user['username']?></div>
                    <div class="col-3"><?=$user['email']?></div>
                    <?php if ($user['admin'] == 1): ?>
                      <div class="col-2">Admin</div>
                    <?php else: ?>
                      <div class="col-2">User</div>
                    <?php endif; ?>
                    <div class="red col-2"><a href="edit.php?edit_id=<?=$user['id'];?>">edit</a></div>
                    <div class="del col-2"><a href="index.php?delete_id=<?=$user['id'];?>">delete</a></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <!--main end-->
    
    <!--footer-->
    <?php include("../../app/include/footer.php");?>
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