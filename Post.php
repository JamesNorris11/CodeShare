<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/03/2017
 * Time: 15:31
 */
class Post
{
    private $postID;
    private $userID;
    private $postDate;
    private $language;
    private $password;
    private $description;
    private $content;

    public function __construct($userID, $lang, $password, $description, $content, $postDate = null, $postID = null)
    {
        $this->userID = $userID;
        $this->language = $lang;
        $this->password = $password;
        $this->description = $description;
        $this->content = $content;

        if ($postDate != null) {
            $this->postDate = $postDate;
        }
        else {
            // time() gives seconds since epoch of 00:00 1/1/1970
            $this->postDate = time();
        }

        if ($postID != null) {
            $this->postID = $postID;
        }
        else {
            $this->postID = $this->createID();
        }
    }

    public function setPostID($postID) {
        $this->postID = $postID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setPostDate($postDate) {
        $this->postDate = $postDate;
    }

    public function setLanguage($language) {
        $this->language = $language;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setContent($content) {
        $this->content = $content;
    }

    public function getPostID() {
    return $this->postID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getPostDate() {
        return $this->postDate;
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

    private function createID() {
        return substr(md5(rand()), 0, 9);
    }
}
