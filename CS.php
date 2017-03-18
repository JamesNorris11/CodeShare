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
        // @TODO DO I NEED TO HAVE THIS LINE AGAIN? WHEN DO I NEED new db()??
        $DB = new DB('Posts');
        $DB->insertPost($post);
    }

    public static function getPost($ID)
    {
        // @TODO DO I NEED TO HAVE THIS LINE AGAIN? WHEN DO I NEED new db()??
        $DB = new DB('Posts');
        // @TODO should return a post class variable?
        return $DB->selectPost($ID);
    }
}