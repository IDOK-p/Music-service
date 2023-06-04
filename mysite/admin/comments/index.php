<?php
    include "../../path.php";
    include "../../app/controllers/commentaries.php";

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

        <title>Комментарии</title>
    </head>
    <body>
        <?php include("../../app/include/header-admin.php"); ?>
        <div class="container">
            <div class="row">
                <?php include "../../app/include/sidebar-admin.php"; ?>
                <div class="posts col-9">
                    <div class="row title-table">
                        <h2>Управление комментариями</h2>
                        <div class="col-1">ID</div>
                        <div class="col-5">Текст</div>
                        <div class="col-2">Автор</div>
                        <div class="col-4">Управление</div>
                    </div>
                    <?php foreach ($commentsForAdm as $key => $comment): ?>
                        <div class="row post">
                            <div class="id col-1"><?=$key + 1; ?></div>
                            <?php if (strlen($comment['comment']) <= 10): ?>
                                <div class="title col-5"><?=mb_substr($comment['comment'], 0, 10, 'UTF-8') ?></div>
                            <?php else: ?>
                                <div class="title col-5"><?=mb_substr($comment['comment'], 0, 10, 'UTF-8') . '...'  ?></div>
                            <?php endif; ?>
                            <?php
                                $user = $comment['email'];
                                $user = explode('@', $user);
                                $user = $user[0];
                            ?>
                            <div class="author col-3"><?=$user; ?></div>
                            <div class="red col-1"><a href="edit.php?id=<?=$comment['id'];?>">edit</a></div>
                            <div class="del col-1"><a href="edit.php?delete_id=<?=$comment['id'];?>">delete</a></div>
                            <?php if ($comment['status']): ?>
                                <div class="status col-1"><a href="edit.php?publish=0&pub_id=<?=$comment['id'];?>">unpublish</a></div>
                            <?php else: ?>
                                <div class="status col-1"><a href="edit.php?publish=1&pub_id=<?=$comment['id'];?>">publish</a></div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>        
            </div>                
        </div>

        <!-- footer -->
        <?php include("../../app/include/footer.php"); ?>
        <!-- end footer -->

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
