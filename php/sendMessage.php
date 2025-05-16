<?php
require '../includes/db.php';

$currentUserID = $_POST['userID'];
$friendUserID = $_POST['friendID'];
$content = $_POST['content'];

$conn = getConnection();


$updateStmt = $conn->prepare("UPDATE contacts SET lastChatted = NOW() 
    WHERE (userID = ? AND friendID = ?) OR (userID = ? AND friendID = ?)");
$updateStmt->bind_param("iiii", $currentUserID, $friendUserID, $friendUserID, $currentUserID);
$updateStmt->execute();

$sql = "INSERT INTO messages(senderID, receiverID, content) VALUES (?, ? ,?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("iis", $currentUserID, $friendUserID, $content);

$stmt->execute();


?>
