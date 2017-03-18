<?php

/**
 * Created by James Norris.
 * Date: 10/03/2017
 * Time: 15:02
 */
require_once('../../db-codeshare/dbConfig.php');

class db
{
    /** @var Database **/
    private $dbCon;

    private $table;

    public function __construct($t)
    {
        $this->table = $t;
        $this->connect();
    }

    public function __destruct()
    {
        $this->dbCon->close();
    }

    public function insertPost($user, $dateTime, $lang, $password, $description, $content)
    {
        $sql = "INSERT INTO $this->table (Username,DateTime,Language,Password,Description,Content)
                      VALUES (
                      '$user',
                      '$dateTime',
                      '$lang',
                      '$password',
                      '$description',
                      '$content'
                      )";
        $this->dbCon->query($sql);
    }

    public function selectPost($id)
    {
        return '';
    }

    public function setTable($t)
    {
        $this->table = $t;
    }

    private function connect()
    {
        $this->dbCon = new mysqli(DB_HOST, DB_USER, DB_PASSWORD)
        or die('<p>Error connecting to the database<br />' . mysqli_connect_error() .'</p>');
        $this->dbCon->select_db(DB_NAME)
        or die('<p>Error selecting the database<br /></p>');
    }
}
