<?php

/**
 * Created by James Norris.
 * Date: 10/03/2017
 * Time: 15:02
 */
require_once('../../db-codeshare/dbConfig.php');

class DB
{
    /** @var Database **/
    private $dbCon;

    private $table;

    public function __construct($T)
    {
        $this->table = $T;
        $this->connect();
    }

    public function __destruct()
    {
        $this->dbCon->close();
    }
    /*
     * @param $post from Post class
     */
    public function insertPost($post)
    {
        $SQL = "INSERT INTO $this->table (ID,UserID,DateTime,Language,Password,Description,Content)
                      VALUES ('"
                      . $post->getID() . "', '"
                      . $post->getUserID() . "', '"
                      . $post->getDateTime() . "', '"
                      . $post->getLanguage() . "', '"
                      . $post->getPassword() . "', '"
                      . $post->getDescription() . "', '"
                      . $post->getContent() .
                      "')";
        $this->dbCon->query($SQL);

        //@TODO ADD ERROR CHECKING HERE FOR IF SQL INSERT DOESN'T WORK - AND SAME FOR ALL OTHER SQL STATEMENTS
    }

    public function selectPost($ID)
    {
        $SQL = "SELECT * FROM $this->table WHERE ID='$ID'";
        $result = $this->dbCon->query($SQL);

        //@TODO ADD ERROR CHECKING FOR IF NO SQL RESULT FDOUND - FOR ALL OTHER SQL STATEMENTS TOO
        $row = mysqli_fetch_assoc($result);

        $post = new Post(
            $row['UserID'],
            $row['Language'],
            $row['Password'],
            $row['Description'],
            $row['Content'],
            $row['DateTime'],
            $row['ID']
        );

        return $post;
    }

    public function setTable($T)
    {
        $this->table = $T;
    }

    private function connect()
    {
        $this->dbCon = new mysqli(DB_HOST, DB_USER, DB_PASSWORD)
        or die('<p>Error connecting to the database<br />' . mysqli_connect_error() .'</p>');
        $this->dbCon->select_db(DB_NAME)
        or die('<p>Error selecting the database<br /></p>');
    }
}
