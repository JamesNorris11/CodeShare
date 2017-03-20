<?php

/**
 * Created by James Norris.
 * Date: 10/03/2017
 * Time: 15:02
 *
 * @ included methods:
 *  insertPost()
 *  selectPost()
 *  insertUser()
 *  selectUser()
 *  selectDisplayNameExists()
 *  selectUserPosts()
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
        $this->dbCon = null;
    }
    /*
     * @param $post of type Post class
     */
    public function insertPost($post)
    {

        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("
            INSERT INTO $this->table (PostID, UserID, PostDate, Language, Password, Description, Content) 
            VALUES (:ID, :UserID, :PostDate, :Language, :Password, :Description, :Content)");

            $postID = $post->getPostID();
            $userID = $post->getUserID();
            $postDate = $post->getPostDate();
            $language = $post->getLanguage();
            $password = $post->getPassword();
            $description = $post->getDescription();
            $content = $post->getContent();

            $stmt->bindParam(':ID', $postID);
            $stmt->bindParam(':UserID', $userID);
            $stmt->bindParam(':PostDate', $postDate);
            $stmt->bindParam(':Language', $language);
            $stmt->bindParam(':Password', $password);
            $stmt->bindParam(':Description', $description);
            $stmt->bindParam(':Content', $content);

            $stmt->execute();
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    // @return Post type variable if found, null if no result found
    public function selectPost($postID)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE PostID = :PostID");
            $stmt->bindParam(':PostID', $postID);
            $stmt->execute();

            $row = $stmt->fetch();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                $post = new Post(
                    $row['UserID'],
                    $row['Language'],
                    $row['Password'],
                    $row['Description'],
                    $row['Content'],
                    $row['PostDate'],
                    $row['PostID']
                );

                return $post;
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    public function insertUser($user)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("
            INSERT INTO $this->table (UserID, RegisterDate, Email, Password, DisplayName) 
            VALUES (:UserID, :RegisterDate, :Email, :Password, :DisplayName)");

            $userID = $user->getUserID();
            $registerDate = $user->getRegisterDate();
            $email = $user->getEmail();
            $password = $user->getPassword();
            $displayName = $user->getDisplayName();

            $stmt->bindParam(':UserID', $userID);
            $stmt->bindParam(':RegisterDate', $registerDate);
            $stmt->bindParam(':Email', $email);
            $stmt->bindParam(':Password', $password);
            $stmt->bindParam(':DisplayName', $displayName);

            $stmt->execute();
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    // @return User type variable if found, null if no result found
    public function selectUser($userID)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE UserID = :UserID");
            $stmt->bindParam(':UserID', $userID);
            $stmt->execute();

            $row = $stmt->fetch();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                $user = new User(
                    $row['Email'],
                    $row['Password'],
                    $row['DisplayName'],
                    $row['RegisterDate'],
                    $row['UserID']
                );

                return $user;
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    // @return true or false if display name already exists
    public function selectDisplayNameExists($displayName)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE DisplayName = :DisplayName");
            $stmt->bindParam(':DisplayName', $displayName);
            $stmt->execute();

            $row = $stmt->fetch();

            if ($stmt->rowCount() == 0) {
                return false;
            }
            else {
                return true;
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    // @return array of Post type objects if found, null if no result found
    public function selectUserPosts($userID)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE UserID = :UserID");
            $stmt->bindParam(':UserID', $userID);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                $posts = [];

                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    $post = new Post(
                        $row['UserID'],
                        $row['Language'],
                        $row['Password'],
                        $row['Description'],
                        $row['Content'],
                        $row['PostDate'],
                        $row['PostID']
                    );
                    array_push($posts, $post);
                }
                return $posts;
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    public function selectTotalPostsOrUsers()
    {
        try {
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table");
            $stmt->execute();

            return $stmt->rowCount();
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }



    public function setTable($T)
    {
        $this->table = $T;
    }

    private function connect()
    {
        try {
            $this->dbCon = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);
            // set the PDO error mode to exception
            $this->dbCon->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch (PDOException $E) {
        die('Error: ' . $E->getMessage());
        }
    }
}
