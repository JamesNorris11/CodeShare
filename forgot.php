<?php
/**
 * Created by PhpStorm.
 * User: James Norris
 * Date: 20/03/2017
 * Time: 14:47
 */

require_once('CS.php');
require_once('Session.php');

$session = new Session();

if ($session->get("loggedIn") == 1) {
    header('Location: index.php');
    exit;
}

// These if statement checks:
// 1) Code exists, 2) Code is in the right format
// 3) user is found with this forgot code 4) the forgot password request was made within the last 20 minutes
$offerChangePassword = null;
if ($_GET['code']) {
    $code = $_GET['code'];
    if (preg_match('/^[a-zA-Z0-9]+$/', $code)) {
        $forgotUser = CS::checkForgotString($code);
        if ($forgotUser['user']) {
            if ((time() - $forgotUser['time']) < 1200) {
                $offerChangePassword = 1;

                // If they have submitted a new password
                if ($_POST['password']) {
                    $password = $_POST['password'];
                    if (strlen($password) >= 6) {
                        $password = password_hash($password, PASSWORD_DEFAULT);
                        CS::setPassword($forgotUser['user']->getUserID(), $password);
                        $passwordChanged = true;
                    }
                }
            }
            else {
                // time expired
                $offerChangePassword = 2;
            }
        }
        else {
            // incorrect code
            $offerChangePassword = 3;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CodeShare</title>
    <meta name="description" content="CodeShare">
    <meta name="author" content="JN">

    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/forgot.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="index.php">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <li class="navButton"><a href="login.php" id="active">Login</a></li>
        <li class="navButton"><a href="register.php">Register</a></li>
    </ul>
</header>
<main>
    <aside>
    </aside>
    <section>
        <span class="titlePhrase">Forgotten Password</span>
        <?php
        if ($offerChangePassword == 1) {
            if ($passwordChanged === true) {
                echo '<span id="correctInfo">Your password has been changed!</span>';
            }
            else {
                ?>
                <form action="forgot.php?code=<?php echo $code; ?>" method="post" class="detailsForm" name="loginForm">

                    <div>
                        <label for="password">Please enter a new password:</label>
                        <input name="password" type="password" class="input field">
                        <span class="tip" id="tipPassword"></span>
                    </div>
                    <div>
                        <label for="repeatPassword">Repeat Password:</label>
                        <input name="repeatPassword" type="password" class="input field">
                        <span class="tip" id="tipRepeatPassword"></span>
                    </div>

                    <input type="submit" id="submitPassword" name="Submit" class="submit" value="Change Password">
                </form>
                <?php
            }
        }
        elseif ($offerChangePassword == 2) {
            ?>
            <div class="errorSection">
                <span id="correctInfo">This link has expired. Please click the link below to request an email with a new link</span>
                <a href="forgot.php" name="Submit" class="submit">Go Back</a>
            </div>
            <?php
        }
        elseif ($offerChangePassword == 3) {
            ?>
        <div class="errorSection">
            <span id="correctInfo">This link does not work. This might be because it is not the newest link you have recieved.
                Please click the link below to request an email with a new link</span>
            <a href="forgot.php" name="Submit" class="submit">Go Back</a>
        </div>
            <?php
        }
        else {
            if ($_GET['e'] == 2) {
                echo '<span id="correctInfo">You have been sent an email with a link to reset your password</span>';
            } else {
                if ($_GET['e'] == 1) {
                    echo '<span id="incorrectInfo">This email address does not exist!</span>';
                }
                ?>

                <form action="sendforgotemail.php" method="post" class="detailsForm" name="loginForm">

                    <div>
                        <label for="email">Please enter your email address. You will be emailed a link to reset your
                            password</label>
                        <input name="email" type="text" class="input field">
                        <span class="tip" id="tipEmail"></span>
                    </div>

                    <input type="submit" id="submitEmail" name="Submit" class="submit" value="Submit">
                </form>
                <?php
            }
        }
        ?>
    </section>
</main>
<script src="js/jquery-3.2.0.min.js"></script>
<script src="js/forgot.js"></script>
</body>
</html>
