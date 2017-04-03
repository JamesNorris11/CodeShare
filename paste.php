<?php
/**
 * Created by PhpStorm.
 * User: James Norris
 * Date: 20/03/2017
 * Time: 14:47
 */

require_once('CS.php');
require_once('geshi/geshi.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>CodeShare</title>
    <meta name="description" content="CodeShare">
    <meta name="author" content="JN">

    <link rel="stylesheet" href="css/all.css">
    <link rel="stylesheet" href="css/paste.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="" id="active">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <li class="navButton"><a href="profile.php">My Profile</a></li>
        <li class="navButton"><a href="login.php">Login</a></li>
        <li class="navButton"><a href="register.php">Register</a></li>
        <li class="navButton"><a href="logout.php">Logout</a></li>
    </ul>
</header>
<main>
    <?php
        if ($_GET['id']) {

        // Get contents of post
        $postContents = CS::getPost($_GET['id'])->getContent();
    ?>
        <aside>
            <span class="title stats">Post ID</span>
            <span class="info stats"><?php echo CS::getPost($_GET['id'])->getPostID(); ?></span>
            <span class="title stats">Posted by</span>
            <span class="info stats">
                <?php
                    $userID = CS::getPost($_GET['id'])->getUserID();
                    echo CS::getDisplayNameFromID($userID);
                ?>
            </span>
            <span class="title stats">Posted at</span>
            <span class="info stats">
                <?php
                $date = CS::getPost($_GET['id'])->getPostDate();
                echo date("H:i:s", $date) . "<br>" . date("d-m-y", $date);
                ?>
            </span>
            <span class="title stats">Language</span>
            <span class="info stats"><?php echo CS::getPost($_GET['id'])->getLanguage(); ?></span>
            <span class="title stats">Character Count</span>
            <span class="info stats">
                <?php
                $charCount = strlen($postContents);
                echo number_format($charCount);
                ?>
            </span>
        </aside>
        <section>
            <table id="outputTable">
                <?php
                    // Comes from DB details in the end
                    $language = 'html5';
                    if ($language !== null) {
                        $geshi = new GeSHi($postContents, $language);

                        // encode it with htmlentities() for security so as not to execute user input
                        // explode each new line (\n) to insert each line of input onto a new table line
                        $contentsArray = explode("\n", $geshi->parse_code());
                    }
                    else {
                        $contentsArray = explode("\n", htmlentities($postContents, ENT_QUOTES, "UTF-8"));
                    }

                    echo '<tr><td id="numberCell">';
                    $x = 1;
                    foreach ($contentsArray as $a) {
                        echo $x . "\n";
                        $x++;
                    }
                    echo "</td><td id='contentCell'>";
                    $x = 1;
                    foreach ($contentsArray as $a) {
                        echo $a . "\n";
                        $x++;
                    }
                    echo '</td></tr>';
        }
        else {
            // header(Location: index.php);
        }
            ?>
        </table>
    </section>
</main>
<script src="js/script.js"></script>
</body>
</html>
