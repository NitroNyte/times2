<?php
require "includes/db.php";

$currentUserID = $_POST['userID'];
$currentFriendID = $_POST['friendID'];

$conn = getConnection();


$sql = "SELECT senderID, receiverID, content FROM messages WHERE (senderID = ? AND receiverID = ?) OR (receiverID = ? AND senderID = ?) ORDER BY timeCreated DESC LIMIT 10";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $currentUserID, $currentFriendID, $currentUserID, $currentFriendID);
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
                        <h6 style='color:gray; font-style:italic; padding-left: 10px'>Friend</h6>
                    </div>
                    <div class='contactBoxSentMessage'>
                        <p>".htmlspecialchars($row['content'])."</p>
                    </div>

                </div>
            </div>";
    }

}


?>