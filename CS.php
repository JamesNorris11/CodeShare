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

    // @return array of Post objects
    public static function getAllPostsByDisplayName($displayName)
    {
        $DB = new DB('Users');
        $userID = $DB->selectUserIDByDisplayName($displayName);
        if ($userID) {
            $DB->setTable("Posts");
            return $DB->selectUserPosts($userID);
        }
        else {
            return null;
        }
    }

    // @return array of Post objects
    public static function getAllPostsByDescription($description)
    {
        $DB = new DB('Posts');
        return $DB->selectAllPostsByDescription($description);
    }

    // @return DisplayName
    public static function getDisplayNameFromID($userID)
    {
        $DB = new DB('Users');
        $name = $DB->selectDisplayNameByUserID($userID);
        if ($name == null) {
            return "Anonymous";
        }
        else {
            return $name;
        }
    }

    // @return boolean
    public static function checkFieldValueExists($table, $field, $value)
    {
        if (($table != 'Users') && ($table != 'Posts')) {
            return null;
        }
        $DB = new DB($table);
        return $DB->selectFieldValueExists($field, $value);
    }

    // @return userID if successful, null if not
    public static function performLogin($email, $password) {
        $DB = new DB('Users');
        $user = $DB->selectUserByEmail($email);
        if (($user == null) || ($user->getPassword() == null)) {
            return null;
        }
        if (!password_verify($password, $user->getPassword())) {
            return null;
        }
        return $user->getUserID();
    }

    public static function registerUser()
    {
        // @TODO maybe methods should be more overall like this - and then things like addUser in DB or somewhere else?
        // this function would then do other stuff as well as calling addUser() method

        // @TODO DO I NEED THIS FUNCTION?
    }
}
