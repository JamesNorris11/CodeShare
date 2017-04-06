<?php
    /**
     * Created by PhpStorm.
     * User: user
     * Date: 24/03/2017
     * Time: 11:29
     */
    require_once('Session.php');

    $session = new Session();
    $session->end();
    header('Location: index.php');
    exit;
