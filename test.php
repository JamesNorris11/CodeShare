<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/02/2017
 * Time: 15:22
 */

require_once('CS.php');
require_once('Post.php');
require_once('User.php');

echo 'socks<br>';

$userID = 'Jds3f';
$lang = '1';
$password = '20';
$description = '3';
$content = '4';

$newPost = new Post($userID, $lang, $password, $description, $content);
CS::addPost($newPost);

echo "<br><br><br>";

$post = CS::getPost('5f07df43d');

if ($post == null) {
    print "Not Found";
}
else {
    print_r($post);
}

echo "<br><br><br>";

$email = 'lol@ok.com';
$password = '30';
$displayName = "are you sure?";

$newUser = new User($email, $password, $displayName);
CS::addUser($newUser);

$user = CS::getUser('5f07df43d');

if ($user == null) {
    print "Not Found";
}
else {
    print_r($user);
}
