<?php
    include(SITE_ROOT . "/app/database/db.php");    

    if (!$_SESSION){
        header('location: ' . 'http://localhost/mysite/log.php');                     
    }

    $errMsg = [];
    $id = '';
    $title = '';
    $content = '';
    $img = '';
    $topic = '';

    $topics = selectAll('topics');
    $posts = selectAll('posts');
    $postsAdm = selectAllFromPostsWithUsers('posts', 'users');   


    // Код для формы создания записи
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_post'])){

        if(!empty($_FILES['img']['name'])){
            $imgName = time(). "_" . $_FILES['img']['name'];
            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileType = $_FILES['img']['type'];
            $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;
            
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result){
                $_POST['img'] = $imgName;
            }else{                
                array_push($errMsg, "Ошибка загрузки файла на сервер.");
            }
                  
        }else{            
            array_push($errMsg, "Ошибка получения файла.");
        }
            
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0;

        

        if($title === '' || $content === '' || $topic === ''){
            array_push($errMsg, "Не все поля заполнены!");
        }elseif(mb_strlen($title, 'UTF8') < 7){
            array_push($errMsg, "Название статьи должно быть более 7 символов.");
        }else{
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],                        
                'status' => $publish,
                'id_topic' => $topic
            ];
            
            $id = insert('posts', $post);
            $post = selectOne('posts', ['id' => $id]);
            header('location: ' . 'http://localhost/mysite/admin/posts/index.php');                     
        }  
    }else{  
        $id = '';      
        $title = '';
        $content = ''; 
        $publish = '';
        $topic = '';
    }


    //Редактирование статьи
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])){
        $post = selectOne('posts', ['id' => $_GET['id']]);
    
        $id =  $post['id'];
        $title =  $post['title'];
        $content = $post['content'];
        $topic = $post['id_topic'];
        $publish = $post['status'];
    }
    
    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_post'])){
        $id =  $_POST['id'];
        $title = trim($_POST['title']);
        $content = trim($_POST['content']);
        $topic = trim($_POST['topic']);
        $publish = isset($_POST['publish']) ? 1 : 0;
    
        if(!empty($_FILES['img']['name'])){
            $imgName = time(). "_" . $_FILES['img']['name'];
            $fileTmpName = $_FILES['img']['tmp_name'];
            $fileType = $_FILES['img']['type'];
            $destination = ROOT_PATH . "\assets\img\posts\\" . $imgName;
            
            $result = move_uploaded_file($fileTmpName, $destination);

            if ($result){
                $_POST['img'] = $imgName;
            }else{                
                array_push($errMsg, "Ошибка загрузки файла на сервер.");
            }
                  
        }else{            
            array_push($errMsg, "Ошибка получения файла.");
        }
    
    
        if($title === '' || $content === '' || $topic === ''){
            array_push($errMsg, "Не все поля заполнены!");
        }elseif (mb_strlen($title, 'UTF8') < 7){
            array_push($errMsg, "Название статьи должно быть более 7-ми символов");
        }else{   
            
            $post = [
                'id_user' => $_SESSION['id'],
                'title' => $title,
                'content' => $content,
                'img' => $_POST['img'],
                'status' => $publish,
                'id_topic' => $topic
            ];
    
            
            $post = update('posts', $id, $post);            
            header('location: ' . BASE_URL . 'admin/posts/index.php');
        }
    }

    // Статус опубликовать или снять с публикации
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['pub_id'])){
        $id = $_GET['pub_id'];
        $publish = $_GET['publish'];

        $postId = update('posts', $id, ['status' => $publish]);

        header('location: ' . BASE_URL . 'admin/posts/index.php');
        exit();
    }

    // Удаление статьи
    if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['delete_id'])){
        $id = $_GET['delete_id'];
        delete('posts', $id);
        header('location: ' . BASE_URL . 'admin/posts/index.php');
    }
?>