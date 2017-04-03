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
    <link rel="stylesheet" href="css/profile.css">

    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
</head>
<body>
<header>
    <a id="bannerLink" href="index.php"><span class="dots">&bull;</span> CodeShare <span class="dots">&bull;</span></a>

    <ul id="navList">
        <li class="navButton"><a href="index.php">New Upload</a></li>
        <li class="navButton"><a href="search.php">Search</a></li>
        <li class="navButton"><a href="profile.php" id="active">My Profile</a></li>
        <li class="navButton"><a href="logout.php">Logout</a></li>
    </ul>
</header>
<main>
    <aside>

            <?php
            if ($_GET['id']) {

                ?>
                <div id="userInfoArea">
                    <span class="titlePhraseSmall">User Info</span>
                    <table class="userTable userInfoTable">
                    <?php
                        // Get user details
                        $user = CS::getUser($_GET['id']);
                        $date = $user->getRegisterDate();
                        ?>
                        <tr>
                            <th id="dispNameColLabel">Display Name</th>
                            <td id="dispNameColValue"><?php echo $user->getDisplayName() ?></td>
                        </tr>
                        <tr>
                            <th>Email</th>
                            <td><?php echo $user->getEmail() ?></td>
                        </tr>
                        <tr>
                            <th>Password</th>
                            <td>Not Shown</td>
                        </tr>
                        <tr>
                            <th>Registration Date</th>
                            <td><?php echo date("H:i:s d-m-y", $date) ?></td>
                        </tr>
                    </table>
                    <input type="button" name="changeDisplayName" id="input1" class="submit" value="Change"/>
                    <input type="button" name="changeEmail" id="input2" class="submit" value="Change"/>
                    <input type="button" name="changePassword" id="input3" class="submit" value="Change"/>
                </div>
        </aside>
        <span class="titlePhrase">User Profile</span>
        <section>
                <span class="titlePhraseSmall">User Posts</span>
                <table class="userTable postsTable">
                    <tr>
                        <th id="IDHeader">Post ID</th>
                        <th id="PWHeader">PW</th>
                        <th id="postedAtHeader">Posted At</th>
                        <th>Description</th>
                    </tr>
                <?php
                // Get contents of PHP post for user
                $arrayOfPosts = CS::getUserPosts($_GET['id']);

                foreach ($arrayOfPosts as $a) {
                    $postID = $a->getPostID();
                    $postDate = $a->getPostDate();
                    $formatPostDate = date("H:i:s d-m-y", $postDate);
                    $passwordSet = (($a->getPassword() != null) ? '<img src="images/miniLock.png">' : '');
                    echo '<tr>';
                    echo '<td><a href="paste.php?id=' . $postID . '" class="IDLinkCell">';
                    echo $postID . '</a></td>';
                    echo '<td class="imageCell">' .$passwordSet . '</td>';
                    echo '<td>' . $formatPostDate . '</td>';
                    echo '<td>' . $a->getDescription() . '</td>';
                    echo '</tr>';
                    $x++;
                }
            ?>
            </table>
            <?php
                }
                else {
                    // header(Location: index.php);
                }
            ?>
    </section>
</main>
<script src="js/getLangs.js"></script>
</body>
</html>