<?php

    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    $language = $_POST['language'];
    $password = $_POST['password'];
    $description = $_POST['description'];
    $content = $_POST['content'];

    // validate user input
    if (
        (strlen($language) > 100) ||
        (strlen($password) > 100) ||
        (strlen($description) > 150) ||
        (strlen($content) > 1000000) ||
        (!$content) ||
        (!preg_match('/^[a-zA-Z0-9_-]+$/', $language))
    ) {
        header('Location: index.php');
        exit;
    }

    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // create new post
    $newPost = new Post($session->get('userID'), $language, $password, $description, $content);
    // add post to database
    CS::addPost($newPost);

    $newPostID = $newPost->getPostID();

    if ($password) {
        $session->addPostAccess($newPostID);
    }

    // PostID created in $newPost creation
    header('Location: paste.php?id=' . $newPostID);
