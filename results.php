<?php
    require_once('CS.php');
    require_once('Session.php');

    $session = new Session();

    $arrayOfPosts = null;

    if ($_GET['d']) {
        $arrayOfPosts = CS::getAllPostsByDescription($_GET['d']);
    }
    else if ($_GET['n']) {
        $name = $_GET['n'];
        if (preg_match('/^[a-zA-Z0-9 _]+$/', $name)) {
            $arrayOfPosts = CS::getAllPostsByDisplayName($name);
        }
    }
    else {
        $arrayOfPosts = CS::getAllPosts();
    }

    if (!$arrayOfPosts) {
        header('Location: search.php?e=1');
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
    <link rel="stylesheet" href="css/results.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="index.php">New Upload</a></li>
        <li class="navButton"><a href="search.php" id="active">Search</a></li>
        <?php
            echo $session->get("loggedIn") ? '<li class="navButton"><a href="profile.php">My Profile</a></li>' : '';
            echo !$session->get("loggedIn") ? '<li class="navButton"><a href="login.php">Login</a></li>' : '';
            echo !$session->get("loggedIn") ? '<li class="navButton"><a href="register.php">Register</a></li>' : '';
            echo $session->get("loggedIn") ? '<li class="navButton"><a href="logout.php">Logout</a></li>' : '';
        ?>
    </ul>
</header>
<main>
    <aside>
    </aside>
    <section>
        <span class="titlePhrase">Search Results</span>

        <a href="search.php" type="button" class="submit">New Search</a>


            <table id="resultsTable">
                <tr>
                    <th id="IDHeader">Post ID</th>
                    <th id="PWHeader">PW</th>
                    <th id="postedByHeader">Posted By</th>
                    <th id="postedAtHeader">Posted At</th>
                    <th id="languageHeader">Language</th>
                    <th>Description</th>
                </tr>
                <?php
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
                        echo '<td>' . htmlentities(ucwords($a->getLanguage()), ENT_QUOTES, "UTF-8") . '</td>';
                        echo '<td>' . htmlentities($a->getDescription(), ENT_QUOTES, "UTF-8") . '</td>';
                    echo '</tr>';
                    $x++;
                }
            echo '</table>';
        ?>
    </section>
</main>
</body>
</html>
