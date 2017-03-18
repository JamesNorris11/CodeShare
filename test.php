<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28/02/2017
 * Time: 15:22
 */

require_once('cs.php');

echo 'socks';

$user = 'J';
$lang = '1';
$password = '2';
$description = '3';
$content = '4';

$post = new post($user, $lang, $password, $description, $content);
cs:addPost($post);
