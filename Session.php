<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 04/04/2017
 * Time: 15:17
 */
class Session
{
    public function __construct()
    {
        session_start();

        if ($_SESSION['posts'] === NULL) {
            $_SESSION['posts'] = [];
        }
    }

    public function end() {
        // remove all session variables
        session_unset();

        // destroy the session
        session_destroy();
    }

    public function set($key, $val) {
        $_SESSION[$key] = $val;
    }

    public function get($key) {
        return $_SESSION[$key];
    }

    public function addPostAccess($postID) {
        array_push($_SESSION['posts'], $postID);
    }

    // @return true if user has gained access to this post ID, false if not
    public function postAccess($postID) {
        return (in_array($postID, $_SESSION['posts']) ? true : false);
    }

}
