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
    <link rel="stylesheet" href="css/search.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="index.php">New Upload</a></li>
        <li class="navButton"><a href="search.php" id="active">Search</a></li>
        <li class="navButton"><a href="profile.php">My Profile</a></li>
        <li class="navButton"><a href="login.php">Login</a></li>
        <li class="navButton"><a href="register.php">Register</a></li>
        <li class="navButton"><a href="logout.php">Logout</a></li>
    </ul>
</header>
<main>
    <aside>
    </aside>
    <section>

        <span class="titlePhrase<?php echo ($_GET['e'] == 1 ? ' redTitle' : ''); ?>">
            <?php echo 'Search ' . ($_GET['e'] == 1 ? '- No Results found!' : ''); ?>
        </span>


        <form action="results.php" method="post" class="detailsForm" name="loginForm">

            <label for="postsByDescription">Search posts by description</label>
            <input name="postsByDescription" type="text" class="input field">

            <input type="submit" name="submit" class="submit" value="Search">

            <label for="postsByDisplayName">Search posts by user display name</label>
            <input name="postsByDisplayName" type="text" class="input field">

            <input type="submit" name="Submit" class="submit" id="submitDisplayName" value="Search">

            <label for="submitAll">Show all posts</label>
            <input type="submit" name="SubmitAll" class="submit" id="submitAll" value="Search">
        </form>
    </section>
</main>
<script src="js/script.js"></script>
</body>
</html>
