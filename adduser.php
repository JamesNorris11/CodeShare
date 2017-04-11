<?php

    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    if ($session->get('loggedIn') == 1) {
        header('Location: index.php');
        exit;
    }

    if ((!isset($_POST['email'])) || (!isset($_POST['password'])) || (!isset($_POST['displayName']))) {
        header('Location: register.php');
        exit;
    }

    $email = $_POST['email'];
    $password = $_POST['password'];
    $displayName = $_POST['displayName'];

    // validate user input
    if ((strlen($displayName) > 20) ||
        (strlen($password) > 100) ||
        (strlen($email) > 100) ||
        (!preg_match('/^[a-zA-Z0-9 _]+$/', $displayName)) ||
        (!preg_match('/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+$/', $email))
        ) {
        header('Location: index.php');
        exit;
    }

    // check if email address is already registered
    if (CS::checkFieldValueExists('Users', 'Email', $email)) {
        header('Location: register.php?m=2');
        exit;
    }

    // check if display name is already taken
    if (CS::checkFieldValueExists('Users', 'DisplayName', $displayName)) {
        header('Location: register.php?m=3');
        exit;
    }

    if ($password) {
        $password = password_hash($password, PASSWORD_DEFAULT);
    }

    // create new user object
    $newUser = new User($email, $password, $displayName);
    // add user to database
    CS::addUser($newUser);

    // create session to log user in
    $session->set("loggedIn", 1);
    $session->set("userID", $newUser->getUserID());

    header('Location: index.php?m=1');
