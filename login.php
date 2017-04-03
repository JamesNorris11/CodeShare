<?php
/**
 * Created by PhpStorm.
 * User: James Norris
 * Date: 20/03/2017
 * Time: 14:47
 */

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CodeShare</title>
    <meta name="description" content="CodeShare">
    <meta name="author" content="JN">

    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/login.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="index.php">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <li class="navButton"><a href="profile.php">My Profile</a></li>
        <li class="navButton"><a href="login.php" id="active">Login</a></li>
        <li class="navButton"><a href="register.php">Register</a></li>
    </ul>
</header>
<main>
    <aside>
    </aside>
    <section>
        <form action="checklogin.php" method="post" class="detailsForm" name="loginForm">
            <span class="titlePhrase">Login</span>

            <label for="username">Username</label>
            <input name="username" type="text" class="input field">

            <label for="password">Password</label>
            <input name="password" type="password" class="input field">

            <input type="submit" name="Submit" class="submit" value="Login">

            <a href="forgot.php" class="forgot">Forgotten your username or password?</a>
        </form>
    </section>
</main>
<script src="js/getLangs.js"></script>
</body>
</html>
