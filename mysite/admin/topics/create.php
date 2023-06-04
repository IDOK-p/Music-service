<?php 
    include("../../path.php");
    include("../../app/controllers/topics.php");

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

    <title>Создать категорию</title>
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
                    <a href="<?php echo BASE_URL . "admin/topics/create.php"?>" class="col-2 btn btn-success">Создать</a>
                    <span class="col-1"></span>
                    <a href="<?php echo BASE_URL . "admin/topics/index.php"?>" class="col-3 btn btn-warning">Редактировать</a>
                </div>
                <div class="row title-table">
                    <h2>Создать категорию</h2>                    
                </div>
                <div class="row add-post">
                <div class="mb-12 col-12 col-md-12 err">
                    <p><?=$errMsg?></p>
                </div>
                    <!--form start-->
                    <form action="create.php" method="post">
                        <div class="col">
                            <input name="name" value="<?=$name?>" type="text" class="form-control" placeholder="Имя категории" aria-label="Имя категории">
                        </div>

                        <div class="col">
                            <label for="content" class="form-label">Описание категории</label>
                            <textarea name="description" class="form-control" id="content" rows="3"><?=$description;?></textarea>
                        </div> 
                                               
                        <div class="col">
                            <button name="topic-create" class="btn btn-primary" type="submit">Создать категорию</button>
                        </div>
                    </form>
                    <!--form end-->
                </div>
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