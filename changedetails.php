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

    if ($_POST['displayName']) {
        $displayName = $_POST['displayName'];

        if ((strlen($displayName) > 20) || (!preg_match('/^[a-zA-Z0-9 _]+$/', $displayName))) {
            header('Location: profile.php');
            exit;
        }

        // check if display name is already taken
        if (CS::checkFieldValueExists('Users', 'DisplayName', $displayName)) {
            header('Location: profile.php?m=1');
            exit;
        }

        CS::setUserField($userID, "DisplayName", $displayName);
    }
    else if ($_POST['email']) {
        $email = $_POST['email'];

        if ((strlen($email) > 100)) {
            header('Location: profile.php');
            exit;
        }

        // check if email address is already registered
        if (CS::checkFieldValueExists('Users', 'Email', $email)) {
            header('Location: profile.php?m=2');
            exit;
        }

        CS::setUserField($userID, "Email", $email);

    }
    else if (($_POST['password']) && ($_POST['repeatPassword'])) {
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];

        if ((strlen($password) > 100)) {
            header('Location: profile.php');
            exit;
        }

        if ($password == $repeatPassword) {
            $password = password_hash($password, PASSWORD_DEFAULT);
            CS::setUserField($userID, "Password", $password);

            header('Location: profile.php?m=3');
            exit;
        }
    }

    header('Location: profile.php');
