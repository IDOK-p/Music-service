<?php
// контроллер
include_once SITE_ROOT . "/app/database/db.php";
$commentsForAdm = selectAll('comments');
session_start();

$page = $_GET['post'];
if (!$_SESSION){
    $email = '';
}else{
    $email = $_SESSION['email'];
}
$comment = '';
$errMsg = [];
$status = 0;
$comments = [];

if (!$_SESSION){
    array_push($errMsg, "Комментарии могут оставлять только авторизированные пользователи!");
}

// Код для формы создания комментария
if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['goComment'])){   

    $email = trim($_POST['email']);
    $comment = trim($_POST['comment']);


    if($email === '' || $comment === ''){
        array_push($errMsg, "Не все поля заполнены!");
        $comments = selectAll('comments', ['page' => $page, 'status' => 1] );
    }elseif($comment === '\'' || $comment === '№'){
        array_push($errMsg, "Нельзя использовать следующие символы: ', №");
        $comments = selectAll('comments', ['page' => $page, 'status' => 1] );
    }elseif (mb_strlen($comment, 'UTF8') < 2){
        array_push($errMsg, "Комментарий должен быть длинее 2 символов");
        $comments = selectAll('comments', ['page' => $page, 'status' => 1] );
    }else{
        $user = selectOne('users', ['email' => $email]);
        if ($user['email'] == $email){
            $status = 1;
        }

        $comment = [
            'status' => $status,
            'page' => $page,
            'email' => $email,
            'comment' => $comment
        ];

        $comment = insert('comments', $comment);
        $comments = selectAll('comments', ['page' => $page, 'status' => 1] );

    }
}
else{
    if (!$_SESSION){
        $email = '';
    }else{
        $email = $_SESSION['email'];
    }    
    $comment = '';
    $comments = selectAll('comments', ['page' => !empty($page) ? $page : 0, 'status' => 1]);    
    $comments = selectAll('comments', ['page' => isset($page) ? $page : 0, 'status' => 1]);


}
// Удаление комментария
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
    $id = $_GET['delete_id'];
    delete('comments', $id);
    header('location: ' . BASE_URL . 'admin/comments/index.php');
}

// Статус опубликовать или снять с публикации
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
    $id = $_GET['pub_id'];
    $publish = $_GET['publish'];

    $postId = update('comments', $id, ['status' => $publish]);

    header('location: ' . BASE_URL . 'admin/comments/index.php');
    exit();
}


// АПДЕЙТ СТАТЬИ
if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
    $oneComment = selectOne('comments', ['id' => $_GET['id']]);
    $id =  $oneComment['id'];
    $email =  $oneComment['email'];
    $text1 = $oneComment['comment'];
    $pub = $oneComment['status'];
}

if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_comment'])){
    $id =  $_POST['id'];
    $text = trim($_POST['content']);
    $publish = isset($_POST['publish']) ? 1 : 0;

    if($text === ''){
        array_push($errMsg, "Комментарий не имеет содержимого текста");
    }elseif (mb_strlen($text, 'UTF8') < 50){
        array_push($errMsg, "Количество символов внутри комментария меньше 50");
    }else{
        $com = [
            'comment' => $text,
            'status' => $publish
        ];

        $comment = update('comments', $id, $com);
        header('location: ' . BASE_URL . 'admin/comments/index.php');
    }
}