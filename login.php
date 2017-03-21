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

    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="new.php">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <li class="navButton"><a href="login.php" id="active">Login</a></li>
        <li class="navButton"><a href="register.php">Register</a></li>
    </ul>
</header>
<main>
    <aside>
        <img src="images/notebook.jpg" id="noteBookImage" />
    </aside>
    <section>
        <form action="checklogin.php" method="post" id="loginForm" name="loginForm">
            <span class="titlePhrase">Login</span>span>
            Username:
            <input name="myusername" type="text" id="myusername">
            Password:
            <input name="mypassword" type="password" id="mypassword">
            <input type="submit" name="Submit" value="Login">
        </form>
    </section>
</main>
<script src="js/script.js"></script>
</body>
</html>
