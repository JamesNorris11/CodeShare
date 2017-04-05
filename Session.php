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
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
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
}
