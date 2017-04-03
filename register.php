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
    <link rel="stylesheet" href="css/register.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="index.php">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <li class="navButton"><a href="profile.php">My Profile</a></li>
        <li class="navButton"><a href="login.php">Login</a></li>
        <li class="navButton"><a href="register.php" id="active">Register</a></li>
    </ul>
</header>
<main>
    <aside>
    </aside>
    <section>
        <form action="checkregister.php" method="post" class="detailsForm" name="registerForm">
            <span class="titlePhrase">Register</span>

            <div>
                <label for="username">Email</label>
                <input name="username" type="text" class="input field">
                <span class="help">?</span>
            </div>
            <div>
                <label for="displayName">Display Name</label>
                <input name="displayName" type="text" class="input field">
                <span class="help">?</span>
            </div>
            <div>
                <label for="password">Password</label>
                <input name="password" type="password" class="input field">
                <span class="help">?</span>
            </div>
            <div>
                <label for="repeatPassword">Repeat Password</label>
                <input name="repeatPassword" type="password" class="input field">
                <span class="help">?</span>
            </div>
            <input type="submit" name="Submit" class="submit" value="Register">
        </form>
    </section>
</main>
<script src="js/getLangs.js"></script>
</body>
</html>
