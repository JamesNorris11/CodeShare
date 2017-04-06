<?php
/**
 * Created by PhpStorm.
 * User: James Norris
 * Date: 20/03/2017
 * Time: 14:47
 */

require_once('Session.php');

$session = new Session();

if ($session->get("loggedIn") == 1) {
    header('Location: index.php');
    exit;
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
        if ($_GET['e'] == 1) {
            echo '<span id="incorrectInfo">This email address does not exist!</span>';
        }
        ?>

        <form action="sendforgotemail.php" method="post" class="detailsForm" name="loginForm">

            <label for="email">Please enter your email address. You will be emailed a link to reset your password</label>
            <input name="email" type="text" class="input field">

            <input type="submit" name="Submit" class="submit" value="Login">
        </form>
    </section>
</main>
</body>
</html>
