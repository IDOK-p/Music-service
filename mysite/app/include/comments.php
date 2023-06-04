<?php
    include SITE_ROOT . "/app/controllers/commentaries.php";
?>
<div class="col-md-12 col-12 comments">
    <h3>Оставить комментарий</h3>   

    <form action="<?=BASE_URL . "single.php?post=$page"?>" method="post">
        <input type="hidden" name="page" value="<?=$page;?>">
        <div class="col-md-6 err">
              <!-- Вывод массива с ошибками -->
              <?php include("app/helps/errorInfo.php"); ?>
          </div>
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Email адрес</label>
            <input name="email" value="<?=$email;?>" type="text" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" readonly>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Напишите ваш отзыв</label>
            <?php if (!$_SESSION): ?>
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4" disabled></textarea>
            <?php else:?>
                <textarea name="comment" class="form-control" id="exampleFormControlTextarea1" rows="4"></textarea>
            <?php endif;?>
        </div>
        <div class="col-12">
            <button type="submit" name="goComment" class="btn btn-primary">Отправить</button>
        </div>
    </form>
    <?php if(count($comments) > 0): ?>
        <div class="row all-comments">
            <h3 class="col-12">Комментарии к записи</h3>
            <?php foreach ($comments as $comment): ?>
                <div class="one-comment col-12">                    
                    <span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope" viewBox="0 0 16 16">
                            <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4Zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2Zm13 2.383-4.708 2.825L15 11.105V5.383Zm-.034 6.876-5.64-3.471L8 9.583l-1.326-.795-5.64 3.47A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.741ZM1 11.105l4.708-2.897L1 5.383v5.722Z"/>
                        </svg>
                        <i class=""></i><?=$comment['email'];?>
                    </span>                    
                    <div class="col-12 text">
                        <?=$comment['comment']  ?>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    <?php endif; ?>
</div>
