<?php

    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity']) {
   // if (is_int($_POST['quantity']) { $quantity= $_POST['quantity']; }
    //}

    // @TODO set description limit to 100 chars, this should be enforced in the index.php form
    // @TODO set content limit to 1,000,000 chars - do this in the javascript form check etc? maybe not for content

    $language = $_POST['language'];
    $password = $_POST['password'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    if (strlen($description) > 100) {
        header('Location: index.php');
        exit;
    }

    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }


    if (!$content) {
        header('Location: index.php');
        exit;
    }

    //check language is just characters or numbers (check list of langs to see if trhat's all that's needed

    $newPost = new Post($session->get("userID"), $language, $password, $description, $content);
    CS::addPost($newPost);

    $newPostID = $newPost->getPostID();

    if ($password) {
        $session->addPostAccess($newPostID);
    }

    // PostID created in $newPost creation
    header('Location: paste.php?id=' . $newPostID);