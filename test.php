<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/02/2017
 * Time: 15:22
 */

require_once('CS.php');
require_once('Post.php');

echo 'socks';

$userID = 'Jds3f';
$lang = '1';
$password = '20';
$description = '3';
$content = '4';

$post = new Post($userID, $lang, $password, $description, $content);
CS::addPost($post);

CS::getPost('4g6');