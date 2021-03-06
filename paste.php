<?php
    require_once('CS.php');
    require_once('geshi/geshi.php');
    require_once('Session.php');

    $session = new Session();

    if (!$_GET['id']) {
        header('Location: index.php');
        exit;
    }
    $postID = $_GET['id'];

    if (!preg_match('/^[a-zA-Z0-9]+$/', $postID)) {
        header('Location: index.php');
        exit;
    }

    // Get contents of post
    $post = CS::getPost($postID);

    if (!$post) {
        header('Location: index.php');
        exit;
    }

    // check if user entered post password correctly if there was one
    if (($_POST['password']) && ($post->getPassword())) {
        if (password_verify($_POST['password'], $post->getPassword())) {
            $session->addPostAccess($post->getPostID());
        }
    }
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
        <li class="navButton"><a href="index.php" id="active">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <?php
            echo $session->get("loggedIn") ? '<li class="navButton"><a href="profile.php">My Profile</a></li>' : '';
            echo !$session->get("loggedIn") ? '<li class="navButton"><a href="login.php">Login</a></li>' : '';
            echo !$session->get("loggedIn") ? '<li class="navButton"><a href="register.php">Register</a></li>' : '';
            echo $session->get("loggedIn") ? '<li class="navButton"><a href="logout.php">Logout</a></li>' : '';
        ?>
    </ul>
</header>
<main>
    <?php
        $postContents = $post->getContent();
        $postID = $post->getPostID();

        if ((CS::getPost($postID)->getPassword() != null) && (!$session->postAccess($postID))) {
            ?>
            <div id="passwordArea">
                <img id="lockImage" src="images/lock.png">

                <label for="password">
                    This post is protected by a password
                    Please enter the password below
                </label>

                <form action="paste.php?id=<?php echo $postID; ?>" method="post">
                    <input name="password" type="password" class="input field" id="passwordInput">

                    <input type="submit" name="submit" class="submit" value="Submit">
                </form>
            </div>
            <?php
        }
        else {
            ?>
            <aside>
                <span class="title stats">Post ID</span>
                <span class="info stats">
                        <?php
                        echo htmlentities(CS::getPost($postID)->getPostID(), ENT_QUOTES, "UTF-8");
                        ?>
                    </span>
                <span class="title stats">Posted by</span>
                <span class="info stats">
                        <?php
                        $userID = CS::getPost($postID)->getUserID();
                        echo htmlentities(CS::getDisplayNameFromID($userID), ENT_QUOTES, "UTF-8");
                        ?>
                    </span>
                <span class="title stats">Posted at</span>
                <span class="info stats">
                        <?php
                        $date = CS::getPost($postID)->getPostDate();
                        echo htmlentities(date("H:i:s", $date), ENT_QUOTES, "UTF-8")
                            . "<br>"
                            . htmlentities(date("d-m-y", $date), ENT_QUOTES, "UTF-8");
                        ?>
                    </span>
                <span class="title stats">Language</span>
                <span class="info stats">
                        <?php
                        echo htmlentities(ucwords(CS::getPost($postID)->getLanguage()), ENT_QUOTES, "UTF-8");
                        ?>
                    </span>
                <span class="title stats">Character Count</span>
                <span class="info stats">
                        <?php
                        $charCount = strlen($postContents);
                        echo htmlentities(number_format($charCount), ENT_QUOTES, "UTF-8");
                        ?>
                    </span>
            </aside>
            <section>
                    <span id="descriptionLabel">
                        <?php
                        echo htmlentities(CS::getPost($postID)->getDescription(), ENT_QUOTES, "UTF-8");
                        ?>
                    </span>
                <table id="outputTable">
                    <?php
                    $language = $post->getLanguage();

                    if (($language !== null) || ($language === "none")) {
                        $geshi = new GeSHi($postContents, $language);

                        // GeSHi does not require htmlentities() as it is included
                        $contentsArray = explode("\n", $geshi->parse_code());
                    }
                    else {
                        // encode it with htmlentities() for security so as not to execute user input
                        // explode each new line (\n) to insert each line of input onto a new table line
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
            ?>
        </table>
    </section>
</main>
</body>
</html>
