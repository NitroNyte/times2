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
    $sql = "SELECT users.name, users.surname, contacts.userID FROM users INNER JOIN contacts ON users.userID = contacts.friendID WHERE contacts.friendID = '$userID' AND contacts.status = 'pending' GROUP BY contacts.friendID";

    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        return $result;
    } else {
        return null;
        //echo "<script>alert('{$userID}');</script>";
    }
}


function acceptFriendRequest($userID){;
    $conn = getConnection();
    $sqlCheck = "SELECT * FROM contacts WHERE userID=$userID AND friendID=".$_SESSION['userID'];

    if($conn->query($sqlCheck)->num_rows > 0){
        $sql = "UPDATE contacts SET status = 'accepted' WHERE friendID = ".$_SESSION['userID']." AND userID = '$userID'";

        $conn->query($sql);
        header("Location: contact.php?clist=true");
    }   
}


function getFriendList() {
    $conn = getConnection();
    $sql = "SELECT u.userID, u.name, u.surname FROM contacts c JOIN users u 
    ON ((c.userID = ".$_SESSION['userID']." AND u.userID = c.friendID) OR (c.friendID = ".$_SESSION['userID']." AND u.userID = c.userID)) 
    WHERE c.status = 'accepted' GROUP BY u.name, u.surname";

    $result = $conn -> query($sql);

    if($result -> num_rows > 0) {
        return $result;
    }
    else {
        return null;
    }
}


function getFriendListDESC() {
    $conn = getConnection();
    $sql = "SELECT u.userID, u.name, u.surname FROM contacts c JOIN users u 
    ON ((c.userID = ".$_SESSION['userID']." AND u.userID = c.friendID) OR (c.friendID = ".$_SESSION['userID']." AND u.userID = c.userID)) 
    WHERE c.status = 'accepted' GROUP BY u.name, u.surname ORDER BY c.lastChatted DESC";

    $result = $conn -> query($sql);

    if($result -> num_rows > 0) {
        return $result;
    }
    else {
        return null;
    }
}






?>
