<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 18/03/2017
 * Time: 15:31
 */
class post
{
    private $id;
    private $user;
    private $dateTime;
    private $lang;
    private $password;
    private $description;
    private $content;

    public function __construct($user, $lang, $password, $description, $content, $dateTime = null, $id = null)
    {
        $this->user = $user;
        $this->lang = $lang;
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

        if ($id != null) {
            $this->id = $id;
        }
        else {
            $this->id = $this->createID();
        }
    }

    public function createPost($dt)
    {
        $this->dateTime = $dt;
    }

    public function createID() {
        return '4g6';
    }
}