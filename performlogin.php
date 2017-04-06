<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 05/04/2017
     * Time: 14:19
     */

    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    if ($session->get("loggedIn") == 1) {
        header('Location: index.php');
        exit;
    }

    //@TODO SO MUCH PHP USER INPUT VALIDATION NEEDS ADDING EVERYWHERE
    //@TODO ADD JS THAT TELLS USER IF PW OR USERNAME IS WRONG

    if ((!$_POST['email']) || (!$_POST['password'])) {
        header('Location: login.php');
        exit;
    }

    $userID = CS::performLogin($_POST['email'], $_POST['password']);
    if (!$userID) {
        header('Location: login.php?e=1');
        exit;
    }

    $session->set("loggedIn", 1);
    $session->set("userID", $userID);

    header('Location: index.php');