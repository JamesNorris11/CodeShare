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
    <link rel="stylesheet" href="css/register.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="index.php">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <li class="navButton"><a href="login.php">Login</a></li>
        <li class="navButton"><a href="register.php" id="active">Register</a></li>
    </ul>
</header>
<main>
    <aside>
    </aside>
    <section>
        <span class="titlePhrase">Register</span>
        <form action="adduser.php" method="post" class="detailsForm" name="registerForm">

            <div>
                <label for="email">Email</label>
                <input name="email" type="text" class="input field">
                <span class="hoverHelp" id="helpEmail">?</span>
                <span class="tip" id="tipEmail"></span>
                <span id="helpMessage"></span>
            </div>
            <div>
                <label for="displayName">Display Name</label>
                <input name="displayName" type="text" class="input field">
                <span class="hoverHelp" id="helpDisplayName">?</span>
                <span class="tip" id="tipDisplayName"></span>
            </div>
            <div>
                <label for="password">Password</label>
                <input name="password" type="password" class="input field">
                <span class="hoverHelp" id="helpPassword">?</span>
                <span class="tip" id="tipPassword"></span>
            </div>
            <div>
                <label for="repeatPassword">Repeat Password</label>
                <input name="repeatPassword" type="password" class="input field">
                <span class="hoverHelp" id="helpRepeatPassword">?</span>
                <span class="tip" id="tipRepeatPassword"></span>
            </div>
            <input type="submit" name="Submit" class="submit" value="Register">
        </form>
    </section>
</main>
<script src="js/jquery-3.2.0.min.js"></script>
<script src="js/register.js"></script>
</body>
</html>
