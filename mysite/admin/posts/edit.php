<?php 
    include("../../path.php");
    include("../../app/controllers/posts.php");
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

    <title>Редактирование записи</title>
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
                <div class="row title-table">
                    <h2>Редактирование записи</h2>                    
                </div>
                <div class="row add-post">
                <div class="mb-12 col-12 col-md-12 err">
                    <!-- Вывод массива с ошибками -->
                    <?php include("../../app/helps/errorInfo.php"); ?>
                </div>
                <div class="row add-post">
                    <!--form start-->
                    <form action="edit.php" method="post" enctype="multipart/form-data">
                        <input type="hidden" name = "id" value="<?=$id; ?>">
                        <div class="col">
                            <input value="<?=$post['title'];?>" name = "title" type="text" class="form-control" placeholder="Title" aria-label="Название статьи">
                        </div>
                        <div class="col">
                            <label for="content" class="form-label">Содержимое записи</label>
                            <textarea name = "content" class="form-control" id="content" rows="6"><?=$post['content'];?></textarea>
                        </div>
                        <div class="input-group col mb-4 mt-4">
                            <input name ="img" value="<?=$post['img']; ?>" type="file" class="form-control" id="inputGroupFile02">
                            <label class="input-group-text" for="inputGroupFile02">Upload</label>
                        </div>
                        <select name="topic" class="form-select mb-2" aria-label="Default select example">
                            <?php foreach ($topics as $topic): ?>
                                <option value="<?=$topic['id']; ?>" <?=($post['id_topic'] == $topic['id']) ? 'selected' : ''; ?>>
                                    <?=$topic['name'];?>
                                </option>
                            <?php endforeach; ?>
                        </select>                                        
                         <div class="form-check">
                            <?php if (empty($publish) && $publish == 0): ?>
                                <input name = "publish" class = "form-check-input" type = "checkbox" id = "flexCheckChecked">
                                <label class = "form-check-label" for="flexCheckChecked">
                                    Publish
                                </label>
                            <?php else: ?>
                                <input name = "publish" class = "form-check-input" type = "checkbox" id = "flexCheckChecked" checked>
                                <label class = "form-check-label" for="flexCheckChecked">
                                    Publish
                                </label>
                            <?php endif; ?>
                        </div>                        
                        <div class="col">
                            <button name="edit_post" class="btn btn-primary" type="submit">Сохранить запись</button>
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