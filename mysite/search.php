<?php 
  include("path.php");  
  include SITE_ROOT . "/app/database/db.php";
  if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['search-term'])){
    $posts = seacrhInTitileAndContent($_POST['search-term'], 'posts', 'users');
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
    <link rel="stylesheet" href="assets/css/style.css">

    <title>Поиск</title>
  </head>
  <body>
    <!--header start-->
    <?php include("app/include/header.php");?>
    <!--header end-->
    
    <!-- блок MAIN -->
    <div class="container">
      <div class="content row">
        <!--Main Content-->
        <div class="main-content col-12">
          <h2>Результаты поиска</h2>
          <?php foreach ($posts as $post): ?>
            <div class="post row">
              <div class="img col-12 col-md-4">
                <?php                  
                  $file_extension = pathinfo($post['img'], PATHINFO_EXTENSION);
                  if (in_array($file_extension, ['mp4', 'avi', 'mov'])): 
                ?>
                  <video class="d-block w-100" controls>
                    <source src="<?= BASE_URL . 'assets/img/posts/' . $post['img'] ?>" type="video/mp4">
                    Your browser does not support the video tag.
                  </video>
                <?php 
                  elseif (in_array($file_extension, ['mp3', 'wav'])): 
                ?>
                  <audio class="d-block w-100" controls>
                      <source src="<?= BASE_URL . 'assets/img/posts/' . $post['img'] ?>" type="audio/mp3">
                  </audio>
                <?php else: ?>
                  <img src="<?= BASE_URL . 'assets/img/posts/' . $post['img'] ?>" alt="<?=$post['title']?>" class="d-block w-100">
                <?php endif; ?>
              </div>
              <div class="post_text col-12 col-md-8">
                <h3>
                  <a href="<?=BASE_URL . 'single.php?post=' . $post['id'];?>"><?=substr($post['title'], 0, 98) . '...'?></a>
                </h3>

                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-circle" viewBox="0 0 16 16">
                  <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"/>
                  <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z"/>
                </svg>
                <i class=""><?=$post['username']?></i>
                
                <p class="preview-text">
                  <?=mb_substr($post['content'], 0, 80, 'UTF-8') . '...'?>
                </p>
              </div>
            </div>
          <?php endforeach; ?>
        </div>        
    </div>    
    <!-- блок MAIN END -->
    
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