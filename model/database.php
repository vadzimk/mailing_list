<?php
// connect to database
$dsn = 'mysql:host=localhost;dbname=mailing_list';
$username = 'root';
$password = '123';
try{
    $db = new PDO($dsn, $username, $password);

} catch (PDOException $e){
    $error_message = $e->getMessage();
    include('../errors/error.php');
    exit();
}


//returns true when the email is already in the db
function emailExists($email){
    global $db;
    $query = 'select * from subscribers where email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $num_rows = $statement->fetchColumn(); // Returns a single column from the next row of a result set
    $statement->closeCursor();

    return $num_rows>0;
}

//returns true on success
function addRecord($email){
    global $db;
    $query = 'insert into subscribers (email) values (:email)';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $result = $statement->rowCount(); //returns the number of rows affected by the last DELETE, INSERT, or UPDATE statement executed by the corresponding PDOStatement object.
    $statement->closeCursor();

    return $result>0;

}

//returns true on success
function removeRecord($email){
    global $db;
    $query = 'delete from subscribers where email= :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $result = $statement->rowCount(); //returns the number of rows affected by the last DELETE, INSERT, or UPDATE statement executed by the corresponding PDOStatement object.
    $statement->closeCursor();

    return $result>0;
}

//return true on success
function suspendRecord($email){
    global $db;
    $query = 'update subscribers set suspended=1 where email = :email';
    $statement = $db->prepare($query);
    $statement->bindValue(':email', $email);
    $statement->execute();
    $result = $statement->rowCount(); //returns the number of rows affected by the last DELETE, INSERT, or UPDATE statement executed by the corresponding PDOStatement object.
    $statement->closeCursor();

    return $result>0;
}

//returns all rows from subscribes table
function getSubscribers(){
    global $db;
    $query = 'select * from subscribers';
    $statement = $db->prepare($query);
    $statement->execute();
    $subscribers = $statement->fetchAll(); //
    $statement->closeCursor();

    return $subscribers;
}
?>