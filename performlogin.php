<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 05/04/2017
     * Time: 14:19
     */

    require_once('CS.php');
    require_once('Session.php');

    //@TODO SO MUCH PHP USER INPUT VALIDATION NEEDS ADDING EVERYWHERE
    //@TODO ADD JS THAT TELLS USER IF PW OR USERNAME IS WRONG

    if ((!$POST['email']) || (!$_POST['password'])) {
        header('Location: login.php');
        //@TODO need error message with this?
    }

    $userID = CS::performLogin($POST['email'], $_POST['password']);
    if (!$userID) {
        header('Location: index.php');
        exit;
    }
    else {
        $session = new Session();
        $session->set("loggedIn", 1);
        $session->set("userID", $userID);
    }