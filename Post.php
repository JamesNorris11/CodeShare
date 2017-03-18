<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/03/2017
 * Time: 15:31
 */
class Post
{
    private $ID;
    private $userID;
    private $dateTime;
    private $language;
    private $password;
    private $description;
    private $content;

    public function __construct($userID, $lang, $password, $description, $content, $dateTime = null, $ID = null)
    {
        $this->userID = $userID;
        $this->language = $lang;
        $this->password = $password;
        $this->description = $description;
        $this->content = $content;

        if ($dateTime != null) {
            $this->dateTime = $dateTime;
        }
        else {
            // @TODO use datetime function
            $this->dateTime = '5';
        }

        if ($ID != null) {
            $this->ID = $ID;
        }
        else {
            $this->ID = $this->createID();
        }
    }

    public function getID() {
    return $this->ID;
}

    public function getUserID() {
        return $this->userID;
    }

    public function getDateTime() {
        return $this->dateTime;
    }

    public function getLanguage() {
        return $this->language;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getContent() {
        return $this->content;
    }

    public function createID() {
        return '4g6';
    }
}