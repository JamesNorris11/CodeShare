<?php

    require_once('CS.php');

    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity']) {
   // if (is_int($_POST['quantity']) { $quantity= $_POST['quantity']; }
    //}

    $language = $_POST['language'];
    $password =  password_hash($_POST['password]'], PASSWORD_DEFAULT);
    $description = $_POST['description'];
    $content = $_POST['content'];

    if (strlen($language) > 20) {
        // something
    }

    $newPost = new Post(null, $language, $password, $description, $content);
    CS::addPost($newPost);

    // PostID created in $newPost creation
    header('Location: paste.php?id=' . $newPost->getPostID());
