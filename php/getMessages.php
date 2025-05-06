<?php
require "includes/db.php";

function getMessagesPrivate($currentUserID, $currentFriendID){
    $conn = getConnection();

    $sql = "SELECT content, timeCreated FROM messages WHERE senderID = '$currentUserID' AND receiverID = '$currentFriendID'";

    $result = $conn -> query($sql);

    if(!empty($result)) {
        return $result;
    }
    else {
        return null;
    }
}



?>