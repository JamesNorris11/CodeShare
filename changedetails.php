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


    // @TODO NEED TO CHECK IF DISPLAYNAME/EMAIL ALREADY EXISTS>....

    if ($_POST['displayName']) {
        $displayName = $_POST['displayName'];

        // @TODO insert input checks here!!

        CS::setUserField($userID, "DisplayName", $displayName);
    }
    else if ($_POST['email']) {
        $email = $_POST['email'];

        // @TODO insert input checks here!!

        CS::setUserField($userID, "Email", $email);

    }
    else if (($_POST['password']) && ($_POST['repeatPassword'])) {
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];

        // @TODO insert input checks here!!

        if ($password == $repeatPassword) {

            $password = password_hash($password, PASSWORD_DEFAULT);
            CS::setUserField($userID, "Password", $password);
        }
    }

    header('Location: profile.php');