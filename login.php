<?php
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
    <link rel="stylesheet" href="css/login.css">

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
        <span class="titlePhrase">Login</span>
        <?php
            if ($_GET['e'] == 1) {
                echo '<span id="incorrectInfo">Incorrect email or password!</span>';
            }
        ?>

        <form action="performlogin.php" method="post" class="detailsForm" name="loginForm">

            <div>
                <label for="email">Email</label>
                <input name="email" type="text" class="input field">
                <span class="tip" id="tipEmail"></span>
            </div>
            <div>
                <label for="password">Password</label>
                <input name="password" type="password" class="input field">
                <span class="tip" id="tipPassword"></span>
            </div>

            <input type="submit" name="Submit" class="submit" value="Login">

            <a href="forgot.php" class="forgot">Forgotten your username or password?</a>
        </form>
    </section>
</main>
<script src="js/jquery-3.2.0.min.js"></script>
<script src="js/all.js"></script>
<script src="js/login.js"></script>
</body>
</html>
