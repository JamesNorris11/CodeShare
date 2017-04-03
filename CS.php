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

    public static function getPost($postID)
    {
        // @TODO DO I NEED TO HAVE THIS LINE AGAIN? WHEN DO I NEED new db()?? Could make non static and have class variable of $DB?
        $DB = new DB('Posts');
        return $DB->selectPost($postID);
    }

    public static function addUser($user)
    {
        $DB = new DB('Users');
        $DB->insertUser($user);
    }

    public static function getUser($userID)
    {
        $DB = new DB('Users');
        return $DB->selectUser($userID);
    }

    // @return true or false
    public static function displayNameExists($displayName) {
        $DB = new DB('Users');
        return $DB->selectDisplayNameExists($displayName);
    }

    // @return array of Post objects
    public static function getUserPosts($userID)
    {
        $DB = new DB('Posts');
        return $DB->selectUserPosts($userID);
    }

    // @return array with two elements [Posts => #, Users => #]
    public static function getStats()
    {
        $stats = [];
        $DB = new DB('Posts');
        $stats['posts'] = $DB->selectTotalPostsOrUsers();
        $DB->setTable("Users");
        $stats['users'] = $DB->selectTotalPostsOrUsers();
        return $stats;
    }

    // @return array of Post objects
    public static function getAllPosts()
    {
        $DB = new DB('Posts');
        return $DB->selectAllPosts();
    }

    // @return DisplayName
    public static function getDisplayNameFromID($userID)
    {
        $DB = new DB('Users');
        return $DB->selectDisplayNameByUserID($userID);
    }

    public static function registerUser() {
        // @TODO maybe methods should be more overall like this - and then things like addUser in DB or somewhere else?
        // this function would then do other stuff as well as calling addUser() method
    }
}
