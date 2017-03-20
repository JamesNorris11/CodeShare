<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/03/2017
 * Time: 15:31
 */
class User
{
    private $userID;
    private $registerDate;
    private $email;
    private $password;
    private $displayName;

    public function __construct($email, $password, $displayName, $registerDate = null, $userID = null)
    {
        $this->email = $email;
        $this->password = $password;
        $this->displayName = $displayName;

        if ($registerDate != null) {
            $this->registerDate = $registerDate;
        }
        else {
            // time() gives seconds since epoch of 00:00 1/1/1970
            $this->registerDate = time();
        }

        if ($userID != null) {
            $this->userID = $userID;
        }
        else {
            $this->userID = $this->createID();
        }
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setRegisterDate($registerDate) {
        $this->registerDate = $registerDate;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setDisplayName($displayName) {
        $this->displayName = $displayName;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getRegisterDate() {
        return $this->registerDate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getDisplayName() {
        return $this->displayName;
    }

    private function createID() {
        return substr(md5(rand()), 0, 9);
    }
}
