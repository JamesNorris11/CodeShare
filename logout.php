<?php
    require_once('Session.php');

    $session = new Session();
    $session->end();
    header('Location: index.php');