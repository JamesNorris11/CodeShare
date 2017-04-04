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
    <link rel="stylesheet" href="css/results.css">

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
        <input type="button" name="newSearch" class="submit" value="New Search"/>
    </aside>
    <section>
        <span class="titlePhrase">Search Results</span>
        <table id="resultsTable">
            <tr>
                <th id="IDHeader">Post ID</th>
                <th id="PWHeader">PW</th>
                <th id="postedByHeader">Posted By</th>
                <th id="postedAtHeader">Posted At</th>
                <th>Description</th>
            </tr>
            <?php
            // Get contents of PHP post
            if ($_GET['search']) {
                // Do specific searches
            }
            else {
                $arrayOfPosts = CS::getAllPosts();

                foreach ($arrayOfPosts as $a) {
                    $postID = $a->getPostID();
                    $postDate = $a->getPostDate();
                    $formatPostDate = date("H:i:s d-m-y", $postDate);
                    $passwordSet = (($a->getPassword() != null) ? '<img src="images/miniLock.png">' : '');
                    echo '<tr>';
                    echo '<td><a href="paste.php?id=' . htmlentities($postID, ENT_QUOTES, "UTF-8") . '" class="IDLinkCell">';
                    echo htmlentities($postID, ENT_QUOTES, "UTF-8") . '</a></td>';
                    echo '<td class="imageCell">' . $passwordSet . '</td>';
                    echo '<td>' . CS::getDisplayNameFromID(htmlentities($a->getUserID(), ENT_QUOTES, "UTF-8")) . '</td>';
                    echo '<td>' . htmlentities($formatPostDate, ENT_QUOTES, "UTF-8") . '</td>';
                    echo '<td>' . htmlentities( $a->getDescription(), ENT_QUOTES, "UTF-8") . '</td>';
                    echo '</tr>';
                    $x++;
                }
            }
            ?>
        </table>
    </section>
</main>
<script src="js/script.js"></script>
</body>
</html>
