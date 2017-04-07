<?php

/**
 * Created by James Norris.
 * Date: 10/03/2017
 * Time: 15:02
 *
 * @ included methods:
 *
 * __construct()
 * __destruct()
 *
 *  insertPost()
 *  selectPost()
 *  insertUser()
 *  selectUser()
 *  selectUserPosts()
 *  selectTotalPostsOrUsers()
 *  selectAllPosts()
 *  selectAllPostsByDescription()
 *  selectDisplayNameByUserID()
 *  selectUserIDByDisplayName()
 *  selectUserByEmail()
 *  updateForgotPassword()
 *  selectForgotPasswordCheck()
 *  updatePassword()
 *  selectFieldValueExists()
 *
 *  selectTable()
 *  connect()
 */
require_once('../../db-codeshare/dbConfig.php');
require_once('Post.php');
require_once('User.php');

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
                return $this->createPostObject($stmt);
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

    public function selectAllPosts()
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table");
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                return $this->createPostObject($stmt);
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    // @return array of Post type objects if found, null if no result found
    public function selectAllPostsByDescription($description)
    {
        try {
            $description = '%' . $description . '%';

            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE Description LIKE :DescriptionSearch");
            $stmt->bindParam(':DescriptionSearch', $description);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                return $this->createPostObject($stmt);
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    public function selectDisplayNameByUserID($userID)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT DisplayName FROM $this->table WHERE UserID = :UserID");
            $stmt->bindParam(':UserID', $userID);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                $row = $stmt->fetch();

                return $row['DisplayName'];
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    public function selectUserIDByDisplayName($displayName)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT UserID FROM $this->table WHERE DisplayName = :DisplayName");
            $stmt->bindParam(':DisplayName', $displayName);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                $row = $stmt->fetch();

                return $row['UserID'];
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    // @return Person object, null if not found
    public function selectUserByEmail($email)
    {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE Email = :Email");
            $stmt->bindParam(':Email', $email);
            $stmt->execute();

            if ($stmt->rowCount() == 0) {
                return null;
            }
            else {
                $row = $stmt->fetch();

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

    public function selectFieldValueExists($field, $value)
    {
        try {
            $listOfFields = array(
                "Email", "Password", "DisplayName", "UserID",
                "Language", "Description", "Content", "PostDate", "PostID"
                );

            if (!in_array($field, $listOfFields)) {
                return null;
            }

            // this is secure for $field as it never comes from the user
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE " . $field . " = :Val");
            $stmt->bindParam(':Val', $value);
            $stmt->execute();

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

    public function updateForgotPassword($email , $forgotString) {
        try {
            // prepare sql and bind parameters
            $time = time();
            $stmt = $this->dbCon->prepare("UPDATE $this->table SET ForgotCode = :Code, ForgotTime = :Time WHERE Email = :Email");
            $stmt->bindParam(':Code', $forgotString);
            $stmt->bindParam(':Time', $time);
            $stmt->bindParam(':Email', $email);

            $stmt->execute();
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    public function selectForgotPasswordCheck($code) {
        try {
            // prepare sql and bind parameters
            $stmt = $this->dbCon->prepare("SELECT * FROM $this->table WHERE ForgotCode = :Code");
            $stmt->bindParam(':Code', $code);
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

                // Done this as forgot password is feature added late and therefore ForgotTime is not in User object
                return array("user" => $user, "time" => $row['ForgotTime']);
            }
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }


    public function updatePassword($userID, $password) {
        try {
            // prepare sql and bind parameters
            $time = time();
            $stmt = $this->dbCon->prepare("UPDATE $this->table SET Password = :Password WHERE UserID = :UserID");
            $stmt->bindParam(':UserID', $userID);
            $stmt->bindParam(':Password', $password);

            $stmt->execute();
        }
        catch(PDOException $E)
        {
            echo 'Error: ' . $E->getMessage();
        }
    }

    private function createPostObject($stmt)
    {
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
