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

        <link rel="stylesheet" href="css/style.css">
   </head>
   <body>
        <header>
            <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

                <ul id="navList">
                    <li class="navButton"><a href="new.php" id="active">New Upload</a></li>
                    <li class="navButton"><a href="search.php">Search</a></li>
                    <li class="navButton"><a href="login.php">Login</a></li>
                    <li class="navButton"><a href="register.php">Register</a></li>
                    <li class="navButton"><a href="logout.php">Logout</a></li>
                </ul>
        </header>
        <main>
            <aside>
                <span class="title stats">Total Users</span>
                <span class="number stats"><?php echo CS::getStats('Jds3f')['users']; ?></span>
                <span class="title stats">Total Posts</span>
                <span class="number stats"><?php echo CS::getStats('Jds3f')['posts']; ?></span>

                <img src="images/notebook.jpg" id="noteBookImage" />
            </aside>
            <section>
                    <form action="add.php" method="post" id="addPostForm" name="mainForm">

                        Text to Upload:
                        <textarea name="content" class="textarea" id="main" cols=""></textarea>

                        Description:
                        <textarea id="description" name="description" cols="" class="textarea"></textarea>

                        Post Password:
                        <input type="Password" class="input" id="password" name="password">

                        Syntax Highlighting:
                        <select class="input" name="language">
                            <option label="abap" value="abap">abap</option>
                            <option label="actionscript" value="actionscript" selected="selected">actionscript</option>
                            <option label="actionscript3" value="actionscript3">actionscript3</option>
                        </select>

                        <img src="captcha.php" />
                        <input type="text" class="input" id="security" name="security">
                        <input type="submit" name="submit" id="submit" value="Submit"/>
                    </form>
            </section>
        </main>
   <script src="js/script.js"></script>
   </body>
</html>
