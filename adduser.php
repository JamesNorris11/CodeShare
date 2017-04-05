<?php

require_once('CS.php');
require_once('Session.php');

//if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['quantity']) {
// if (is_int($_POST['quantity']) { $quantity= $_POST['quantity']; }
//}

$email = $_POST['email'];
$password =  password_hash($_POST['password]'], PASSWORD_DEFAULT);
$displayName = $_POST['displayName'];

// @TODO NEED TO CHECK IF EMAIL OR DISPLAY NAME ALREADY EXISTS!!!
// @TODO SO MANY POTENTIAL ERRORS LIKE THE ONE ABOVE THAT NEED TO GIVE FEEDBACK TO THE USER!


// @TODO display name can only be letters, numbers, underscores and spaces
// @TODO stop displayname from just being loads of spaces and underscores, maybe just only one of each next to each other?
if (strlen($displayName) > 20) {
    // something
}

$newUser = new User($email, $password, $displayName);
CS::addUser($newUser);

$session = new Session();
$session->set("loggedIn", 1);
$session->set("userID", $newUser->getUserID());

header('Location: index.php?m=1');
exit;
// @TODO should get welcome message when I've created an account!!
