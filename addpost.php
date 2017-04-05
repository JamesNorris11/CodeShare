<?php

    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    if ($session->get("loggedIn") != 1) {
        header('Location: index.php');
        exit;
    }
    else {
        $userID = $session->get("userID");
    }

    //if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity']) {
   // if (is_int($_POST['quantity']) { $quantity= $_POST['quantity']; }
    //}

    // set description limit to 100 chars, this should be enforced in the index.php form

    $language = $_POST['language'];
    $password = $_POST['password'];

    if (strlen($description) > 100) {
        header('Location: index.php');
        exit;
    }

    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }
    $description = $_POST['description'];
    $content = $_POST['content'];


    if (!$content) {
        header('Location: index.php');
        exit;
    }

    //check language is just characters or numbers (check list of langs to see if trhat's all that's needed

    $newPost = new Post($userID, $language, $password, $description, $content);
    CS::addPost($newPost);

    // PostID created in $newPost creation
    header('Location: paste.php?id=' . $newPost->getPostID());
    exit;