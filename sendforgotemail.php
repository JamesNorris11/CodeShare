<?php

    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    if (!$_POST['email']) {
        header('Location: forgot.php');
        exit;
    }

    $email = $_POST['email'];

    if (($session->get("loggedIn") == 1) || (!validMail($email))) {
        header('Location: index.php');
        exit;
    }

    if (CS::checkFieldValueExists("Users", "Email", $email)) {

        $randString = substr(md5(rand()), 0, 20);
        sendEmail($email, $randString);

        CS::setForgotPassword($email, $randString);

        header('Location: forgot.php?e=2');
        exit;
    }
    else {
        header('Location: forgot.php?e=1');
    }

    function validMail($email)
    {
        return preg_match('/^[a-zA-Z0-9_-]+@[a-zA-Z0-9_-]+\.[a-zA-Z0-9_-]+$/', $email);
    }

    function sendEmail($email, $randString)
    {
        $subject = "Forgotten Password";

        $message = "
            <html>
            <head>
            <title>Forgotten Password</title>
            </head>
            <body>
            <p>This email is in response to your request to reset your password.
            <br>Please use the following link:</p>
            http://www.randomdandy.co.uk/codeshare/forgot.php?code=" . $randString . "
            <p>Thank you,<br><br>randomdandy.co.uk</p>
            </body>
            </html>
            ";

        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: <info@randomdandy.co.uk>' . "\r\n";

        mail($email,$subject,$message,$headers);
    }

    function testMail() {
        $arr = array("hello@ok.com", "really", ";hello@ok.com", "@ok.com", "ok.com", "rofl_cake@ok", "rofl_cake@ok.com"
        ,"really_ok@ok_.com", "@f", "4344@323.com", "r&@g.c");
        foreach ($arr as $a) {
            echo $a . " : " . (validMail($a) ? "Match" : "No Match") . "<br>\n";
        }
    }