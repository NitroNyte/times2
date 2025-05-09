<?php
require "../includes/functions.php";

$currentUserID = $_POST['userID'];
$currentFriendID = $_POST['friendID'];
$friendName = getFriendName($currentFriendID);
$friend = $friendName -> fetch_assoc();


$conn = getConnection();

$sql = "SELECT * FROM (
        SELECT senderID, receiverID, content, timeCreated FROM messages WHERE 
            (senderID = ? AND receiverID = ?) 
            OR 
            (receiverID = ? AND senderID = ?) 
        ORDER BY timeCreated DESC LIMIT 10) AS recentMessages ORDER BY timeCreated ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iiii", $currentUserID, $currentFriendID, $currentUserID, $currentFriendID);
$stmt->execute();
$result = $stmt->get_result();

while($row = $result -> fetch_assoc()){
    if($row['senderID'] == $currentUserID){

    echo "<div class='sender'><div class='senderBoxMessage'><p>".htmlspecialchars($row['content'])."</p></div></div>";
    }
    else {
        echo "<div class='contact'>
                <div class='contactBoxMessage'>
                    <div class='contactBoxName'>
                        <h6 style='color:gray; font-style:italic; padding-left: 10px'>".htmlspecialchars($friend['name'])."</h6>
                    </div>
                    <div class='contactBoxSentMessage'>
                        <p>".htmlspecialchars($row['content'])."</p>
                    </div>

                </div>
            </div>";
    }

}


?>