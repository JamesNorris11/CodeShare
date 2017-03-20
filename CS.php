<?php

/**
 * cs stands for CodeShare
 * Created by PhpStorm.
 * User: user
 * Date: 10/03/2017
 * Time: 17:38
 */
require_once('DB.php');

class CS
{
    public static function addPost($post)
    {
        // @TODO DO I NEED TO HAVE THIS LINE AGAIN? WHEN DO I NEED new db()?? Could make non static and have class variable of $DB?
        $DB = new DB('Posts');
        $DB->insertPost($post);
    }

    public static function getPost($ID)
    {
        // @TODO DO I NEED TO HAVE THIS LINE AGAIN? WHEN DO I NEED new db()?? Could make non static and have class variable of $DB?
        $DB = new DB('Posts');
        return $DB->selectPost($ID);
    }

    public static function addUser($user)
    {
        $DB = new DB('Users');
        $DB->insertUser($user);
    }

    public static function getUser($ID)
    {
        $DB = new DB('Users');
        return $DB->selectUser($ID);
    }
}
