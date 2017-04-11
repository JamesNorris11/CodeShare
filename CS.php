<?php

/**
 * cs stands for CodeShare
 * Created by James Norris
 * Date: 10/03/2017
 * Time: 17:38
 */
require_once('DB.php');

class CS
{
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
    public static function performLogin($email, $password)
    {
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

    // @return sets time and random string for user's forgotten password request
    public static function setForgotPassword($email, $forgotString)
    {
        $DB = new DB('Users');
        $DB->updateForgotPassword($email , $forgotString);
    }

    // @return user object
    public static function checkForgotString($code)
    {
        $DB = new DB('Users');
        return $DB->selectForgotPasswordCheck($code);
    }

    public static function setUserField($userID, $field, $password)
    {
        $DB = new DB('Users');
        $DB->updateUserField($userID, $field, $password);
    }
    public static function addPost($post)
    {
        $DB = new DB('Posts');
        $DB->insertPost($post);
    }

    public static function getPost($postID)
    {
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

    // @return array of Post objects
    public static function getUserPosts($userID)
    {
        $DB = new DB('Posts');
        return $DB->selectUserPosts($userID);
    }
}
