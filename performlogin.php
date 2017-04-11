<?php

    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    if ($session->get("loggedIn") == 1) {
        header('Location: index.php');
        exit;
    }

    if ((!isset($_POST['email'])) || (!isset($_POST['password']))) {
        header('Location: login.php');
        exit;
    }
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!preg_match('/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+$/', $email)) {
        header('Location: login.php');
        exit;
    }

    $userID = CS::performLogin($email, $password);
    if (!$userID) {
        header('Location: login.php?e=1');
        exit;
    }

    $session->set("loggedIn", 1);
    $session->set("userID", $userID);

    header('Location: index.php');