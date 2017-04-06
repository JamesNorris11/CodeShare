<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 06/04/2017
     * Time: 17:27
     */

    require_once('CS.php');
    require_once('Session.php');

    // @TODO DO SOME CHECKS ON USER INPUT LIKE ALL OTHER FILES... ADD JS CHECKS TO EMAIL FOR FORGOT.PHP?

    $session = new Session();

    if ($session->get("loggedIn") == 1) {
        header('Location: index.php');
        exit;
    }

    if (!$_POST['email']) {
        header('Location: forgot.php');
        exit;
    }

    if (CS::checkFieldValueExists("Users", "Email", $_POST['email'])) {
        // send email and stuff"!
    }
    else {
        header('Location: forgot.php?e=1');
    }
