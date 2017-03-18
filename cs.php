<?php

/**
 * cs stands for CodeShare
 * Created by PhpStorm.
 * User: user
 * Date: 10/03/2017
 * Time: 17:38
 */
require_once('db.php');

class cs
{
    public static function addPost($post)
    {
        // @TODO DO I NEED TO HAVE THIS LINE AGAIN? WHEN DO I NEED new db()??
        $db = new db('Posts');
        // @TODO Get Current time and date
        $dateTime = 5;
        $post->setDateTime($dateTime);
        $db->insertPost($post);
    }

    public static function getPost($id)
    {
        // @TODO DO I NEED TO HAVE THIS LINE AGAIN? WHEN DO I NEED new db()??
        $db = new db('Posts');
        $postInfo = $db->selectPost($id);
    }
}
