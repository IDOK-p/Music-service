<?php
    include "../../path.php";
    include "../../app/controllers/commentaries.php";

    // session_start();

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

        <title>Редактирование комментария</title>
    </head>
    <body>
        <?php include("../../app/include/header-admin.php"); ?>
        <div class="container">
            <div class="row">
                <?php include "../../app/include/sidebar-admin.php"; ?>
                <div class="posts col-9">
                    <div class="row title-table">
                        <h2>Редактирование комментария</h2>
                    </div>
                    <div class="row add-post">
                        <div class="mb-12 col-12 col-md-12 err">
                            <!-- Вывод массива с ошибками -->
                            <?php include "../../app/helps/errorInfo.php"; ?>
                        </div>
                        <form action="edit.php" method="post">
                            <input type="hidden" name="id" value="<?=$id; ?>">
                            <div class="col mb-4">
                                <label for="editor" class="form-label">Автор</label>
                                <input value="<?=$email?>" name="title" type="text" disabled class="form-control" placeholder="Title" aria-label="Название статьи">
                            </div>
                            <div class="col">
                                <label for="editor" class="form-label">Комментарий</label>
                                <textarea name="content" id="editor" class="form-control" rows="6">
                                    <?=$text1?>
                                </textarea>
                            </div>
                            <div class="form-check">
                                <?php if($pub) $checked = "checked"; else $checked = "";?>
                                <input name="publish" class="form-check-input" type="checkbox" id="flexCheckChecked" <?=$checked;?> >
                                <label class="form-check-label" for="flexCheckChecked">
                                    Publish
                                </label>
                            </div>
                            <div class="col col-6">
                                <button name="edit_comment" class="btn btn-primary" type="submit">Сохранить</button>
                            </div>
                        </form>
                    </div>            
                </div>
            </div>    
        </div>

        <!-- footer -->
        <?php include("../../app/include/footer.php"); ?>
        <!-- // footer -->


        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
        <!-- Добавление визуального редактора к текстовому полю админки -->
        <script src="https://cdn.ckeditor.com/ckeditor5/27.0.0/classic/ckeditor.js"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
        -->

        <script src="../../assets/js/scripts.js"></script>
    </body>
</html>