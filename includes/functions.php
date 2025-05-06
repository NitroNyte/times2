<?php

    require "db.php";

function getUserID($email, $password)
{
    $conn = getConnection();
    $sql = "SELECT userID from users WHERE email = '$email' AND password = '$password'";

    $result = $conn->query($sql);

    while ($row = $result->fetch_assoc()) {
        return $row['userID'];
    }
}


function getUserInfoByID($currentUserID) {
    $conn = getConnection();

    $sql = "SELECT name, surname, email, password FROM users WHERE userID = '$currentUserID'";

    $result = $conn -> query($sql);

    $row = $result -> fetch_assoc();

    return $row;
}

function registerUser($name, $surname, $email, $password)
{
    $conn = getConnection();
    $sqlDuplicate = "SELECT userID FROM users where email = '$email'";
    $check = $conn->query($sqlDuplicate);

    if ($check->num_rows > 0) {
        return true;
    } else {
        $sql = "INSERT INTO users(name, surname, email, password) VALUES ('$name', '$surname', '$email', '$password')";

        if ($conn->query($sql) === TRUE) {
            echo "Useri u regjistrua me sukses";
        } else {
            echo "Useri nuk u regjistrua";
        }
    }
}

function loginUser($email, $password)
{
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return [
            'userID' => $row['userID'],
            'name' => $row['name'],
            'surname' => $row['surname']
        ];
    } else {
        return null;
    }
}

function userExists($email, $password)
{
    $conn = getConnection();
    $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        return true;
    } else {
        return null;
    }
}

function getFriendName($friendID){
    $conn = getConnection();
    $sql = "SELECT name, surname FROM users WHERE userID ='$friendID'";

    $result = $conn->query($sql);
    return $result;
}





//Contacts functions

//Check if user exists with the email

function sendFriendRequest($userID, $email)
{
    $conn = getConnection();
    $sql = "SELECT userID from users WHERE email = '$email'";

    $result = $conn->query($sql);
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $rowID = $row['userID'];
        $sqlFriendQuery = "INSERT INTO contacts(userID, friendID) VALUES ('$userID','$rowID')";

        echo "<script>alert('{$rowID}');</script>";

        if ($conn->query($sqlFriendQuery)) {
            return true;
        } else {
            return false;
        }
    }
}



//Get list of users who sent friend request

function getPendingList($userID)
{
    $conn = getConnection();
    $sql = "SELECT users.name, users.surname, contacts.userID 
    FROM users INNER JOIN contacts ON users.userID = contacts.friendID 
    WHERE contacts.friendID = '$userID' AND contacts.status = 'pending' 
    GROUP BY contacts.friendID";

    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
        //echo "<script>alert('{$userID}');</script>";
    }
}


function acceptFriendRequest($sentID, $currentUserID){;
    $conn = getConnection();
    $sqlCheck = "SELECT * FROM contacts WHERE userID='$sentID' AND friendID=$currentUserID";

    if($conn->query($sqlCheck)->num_rows > 0){
        $sql = "UPDATE contacts SET status = 'accepted' WHERE friendID = '$currentUserID' AND userID = '$sentID'";

        $conn->query($sql);
        header("Location: contact.php?clist=true");
    }   
}

//Gets current user friendList, he might be sender or sended, this was done to remove duplicates in database
function getFriendList($currentUserID) {
    $conn = getConnection();
    $sql = "SELECT u.userID, u.name, u.surname FROM contacts c JOIN users u 
    ON ((c.userID = '$currentUserID' AND u.userID = c.friendID) OR (c.friendID = '$currentUserID' AND u.userID = c.userID)) 
    WHERE c.status = 'accepted' GROUP BY u.name, u.surname";

    $result = $conn -> query($sql);

    if($result -> num_rows > 0) {
        return $result;
    }
    else {
        return null;
    }
}


function getFriendListDESC($currentUserID) {
    $conn = getConnection();
    $sql = "SELECT u.userID, u.name, u.surname FROM contacts c JOIN users u 
    ON ((c.userID = '$currentUserID' AND u.userID = c.friendID) OR (c.friendID = '$currentUserID' AND u.userID = c.userID)) 
    WHERE c.status = 'accepted' GROUP BY u.name, u.surname ORDER BY c.lastChatted DESC";

    $result = $conn -> query($sql);

    if($result -> num_rows > 0) {
        return $result;
    }
    else {
        return null;
    }
}



//Getting the messages for the user and friend



//Sends message to the database, where we can get with the messages with getMessagePrivate method 
function sendMessage($currentUserID, $currentFriendID, $currentMessage){
    $conn = getConnection();

    $sql = "INSERT INTO messages(senderID, receiverID, content) VALUES ('$currentUserID','$currentFriendID','$currentMessage')";

    $conn -> query($sql);

}


//Function regarding the user for saving information




?>
