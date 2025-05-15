<?php

require "db.php";

function getUserID($email, $password)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("SELECT userID from users WHERE email = ? AND password = ?");
    $stmt ->bind_param("ss", $email, $password);
    $stmt -> execute();

    $result = $stmt -> get_result();

    while ($row = $result ->fetch_assoc()) {
        return $row['userID'];
    }
    $stmt -> close();
}

function setUserOnline($currentUserID)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("UPDATE users SET status = 'online' WHERE userID = ?");
    $stmt ->bind_param("i", $currentUserID);

    $stmt ->execute();
    $stmt -> close();
}

//Set enum function to offline, will be used as a counter function to the upper one ^^
function setUserOffline($currentUserID)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("UPDATE users SET status = 'offline' WHERE userID = ?");
    $stmt ->bind_param("i", $currentUserID);

    $stmt ->execute();
    $stmt -> close();
}

//Get inforamtion by id
function getUserInfoByID($currentUserID)
{
    $conn = getConnection();

    $stmt = $conn -> prepare("SELECT name, surname, email, password FROM users WHERE userID = ?");

    $stmt -> bind_param("i", $currentUserID);
    $stmt -> execute();


    $result = $stmt -> get_result();

    $row = $result->fetch_assoc();

    return $row;
}

//register
function registerUser($name, $surname, $email, $password)
{
    $conn = getConnection();
    $stmtDuplicate = $conn -> prepare("SELECT userID FROM users where email = ?");
    $stmtDuplicate -> bind_param("s", $email);
    $stmtDuplicate -> execute();

    $check = $stmtDuplicate -> get_result();

    if ($check->num_rows > 0) {
        return true;
    } else {
        $stmt = $conn -> prepare("INSERT INTO users(name, surname, email, password) VALUES (?, ?, ?, ?)");
        $stmt -> bind_param("ssss", $name, $surname, $email, $password);
        $stmt -> execute();
    }
}

//Login
function loginUser($email, $password)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt -> bind_param("ss", $email, $password);
    $stmt -> execute();

    $result = $stmt -> get_result();
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

//Find if user exists in db
function userExists($email, $password)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("SELECT * FROM users WHERE email = ? AND password = ?");
    $stmt ->bind_param("ss", $email, $password);
    $stmt -> execute();

    $result = $stmt -> get_result();
    if ($result->num_rows > 0) {
        return true;
    } else {
        return null;
    }
}

//As name suggests
function getFriendName($friendID)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("SELECT name, surname FROM users WHERE userID =?");
    $stmt -> bind_param("i", $friendID);
    $stmt -> execute();


    $result = $stmt -> get_result();
    return $result;
}


//Function such that if the user sees the text it will apear on the page as read

//This function might change, so im gonna leave it in normal query form for now

//TODO 
//This is gonna have to change
function seenText($currentUserID, $currentFriendID)
{
    $conn = getConnection();
    $stmtFriendOnline = "SELECT * FROM users WHERE status = 'online' AND userID = '$currentFriendID'";
    $result = $conn->query($stmtFriendOnline);
    if ( $result -> num_rows > 0) {
        $stmt = "UPDATE messages set status = 'seen' WHERE (senderID = '$currentFriendID' AND receiverID = '$currentUserID')";
        $conn->query($stmt);
    }
}



//Contacts functions

//Check if user exists with the email

function sendFriendRequest($userID, $email)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("SELECT userID from users WHERE email = ?");
    $stmt -> bind_param("s", $email);
    $stmt -> execute();


    $result = $stmt -> get_result();
    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();
        $rowID = $row['userID'];
        $stmtFriendQuery = $conn -> prepare("INSERT INTO contacts(userID, friendID) VALUES (?,?)");
        $stmtFriendQuery -> bind_param("ii", $userID, $rowID);
        

        echo "<script>alert('{$rowID}');</script>";

        if ($stmtFriendQuery -> execute()) {
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
    $stmt = $conn -> prepare("SELECT users.name, users.surname, contacts.userID, contacts.friendID 
    FROM users INNER JOIN contacts ON users.userID = contacts.friendID 
    WHERE contacts.friendID = ? AND contacts.status = 'pending' 
    GROUP BY contacts.friendID");
    $stmt -> bind_param("i", $userID);
    $stmt -> execute();


    $result = $stmt -> get_result();

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
        //echo "<script>alert('{$userID}');</script>";
    }
}

//Methods for accepting and deleting the user
function acceptFriendRequest($sentID, $currentUserID)
{
    $conn = getConnection();
    $stmtCheck = $conn -> prepare("SELECT * FROM contacts WHERE userID = ? AND friendID = ? ");
    $stmtCheck -> bind_param("ii", $sentID, $currentUserID);
    $stmtCheck -> execute();


    if ($stmtCheck -> get_result()->num_rows > 0) {
        $stmt = $conn -> prepare("UPDATE contacts SET status = 'accepted' WHERE friendID = ? AND userID = ?");

        $stmt -> bind_param("ii", $currentUserID, $sendID);
        $stmt -> execute();


        header("Location: contact.php?clist=true");
    }
}

function deleteFriendRequest($currentUserID, $currentFriendID)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("DELETE FROM contacts WHERE userID=? AND friendID=?");
    $stmt -> bind_param("ii", $currentFriendID, $currentUserID);
    $stmt -> execute();


}


//Gets current user friendList, he might be sender or sended, this was done to remove duplicates in database
function getFriendList($currentUserID)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("SELECT u.userID, u.name, u.surname, c.friendID, u.status FROM contacts c JOIN users u 
    ON ((c.userID = ? AND u.userID = c.friendID) OR (c.friendID = ? AND u.userID = c.userID)) 
    WHERE c.status = 'accepted' GROUP BY u.name, u.surname");

    $stmt -> bind_param("ii", $currentUserID, $currentUserID);
    $stmt -> execute();

    $result = $stmt -> get_result();

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
    }
}


function getFriendListDESC($currentUserID)
{
    $conn = getConnection();
    $stmt = $conn -> prepare("SELECT u.userID, u.name, u.surname, u.status FROM contacts c JOIN users u 
    ON ((c.userID = ? AND u.userID = c.friendID) OR (c.friendID = ? AND u.userID = c.userID)) 
    WHERE c.status = 'accepted' GROUP BY u.name, u.surname ORDER BY c.lastChatted DESC");

    $stmt -> bind_param("ii", $currentUserID, $currentUserID);
    $stmt -> execute();
    
    $result = $stmt -> get_result();

    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
    }
}


//Sends message to the database, where we can get with the messages with getMessagePrivate method 
function sendMessage($currentUserID, $currentFriendID, $currentMessage)
{
    $conn = getConnection();

    $stmt = $conn -> prepare("INSERT INTO messages(senderID, receiverID, content) VALUES (?,?,?)");
    $stmt -> bind_param("iis", $currentUserID, $currentFriendID, $currentMessage);
    $stmt -> execute(); 
}



//Function regarding deleting the messages if older than 24 hours
//This really should be done by the server, but server service isn't avaliable

function deleteMessageOverTime() {
    $conn = getConnection();

    $stmt = $conn -> prepare("DELETE FROM messages WHERE timeCreated < NOW() - INTERVAL 1 DAY");
    $stmt -> execute();
}

//Function regarding the user for saving information


//Switched to PreparedStatement for anti-sql injection
