<?php
/**
 * Created by PhpStorm.
 * User: James Norris
 * Date: 20/03/2017
 * Time: 14:47
 */

require_once('CS.php');
?>
<!DOCTYPE html>
<html lang="en">
   <head>
        <title>CodeShare</title>
        <meta name="description" content="CodeShare">
        <meta name="author" content="JN">

        <link rel="stylesheet" href="css/all.css">
        <link rel="stylesheet" href="css/index.css">

       <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
   </head>
   <body>
    <div include-html="langlist.html"></div>
    <header>
            <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

                <ul id="navList">
                    <li class="navButton"><a href="index.php" id="active">New Upload</a></li>
                    <li class="navButton"><a href="search.php">Search</a></li>
                    <li class="navButton"><a href="profile.php">My Profile</a></li>
                    <li class="navButton"><a href="login.php">Login</a></li>
                    <li class="navButton"><a href="register.php">Register</a></li>
                    <li class="navButton"><a href="logout.php">Logout</a></li>
                </ul>
        </header>
        <main>
            <aside>
                <span class="title stats">Total Users</span>
                <span class="number stats"><?php echo number_format(CS::getStats('Jds3f')['users']); ?></span>
                <span class="title stats">Total Posts</span>
                <span class="number stats"><?php echo number_format(CS::getStats('Jds3f')['posts']); ?></span>

                <img src="images/notebook.jpg" id="noteBookImage" />
            </aside>
            <section>
                    <form action="addpost.php" method="post" id="addPostForm" name="mainForm">

                        <label for="content" class="labelAbove">Text to Upload</label>
                        <textarea name="content" class="textarea" id="content" cols=""></textarea>

                        <label for="description" class="labelAbove">Description *</label>
                        <textarea id="description" name="description" cols="" class="textarea"></textarea>

                        <label for="password">Post Password *</label>
                        <input type="Password" class="input horizontalInput" id="password" name="password">

                        <label for="language">Syntax Highlighting *</label>
                        <select class="input horizontalInput" name="language">
                            <script>
                                includeHTML();
                            </script>
                        </select>

                        <label for="language">Captcha</label>
                        <!-- <img src="captcha.php" /> -->
                        <input type="text" class="input horizontalInput" id="security" name="security">
                        <input type="submit" name="submit" class="submit" value="Submit"/>
                        * Optional
                    </form>
            </section>
        </main>
   <script src="js/getLangs.js"></script>
   </body>
</html>
