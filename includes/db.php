<?php
function getConnection()
{
    $conn = new mysqli("localhost", "root", "", "times2db");
    if ($conn) {
        return $conn;
    } else {
        echo "Db is not working";
    }
}


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
    $sql = "SELECT * FROM contacts WHERE userID = '$userID'";

    $result = $conn->query($sql);



    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            return [
                'userID' => $row['userID'],
                'name' => $row['name'],
                'surname' => $row['surname']
            ];
        }
    }
}

?>
