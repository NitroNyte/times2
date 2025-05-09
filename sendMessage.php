<?php
require 'includes/db.php';

$currentUserID = $_POST['userID'];
$friendUserID = $_POST['friendID'];
$content = $_POST['content'];

$conn = getConnection();
$sql = "INSERT INTO messages(senderID, receiverID, content) VALUES (?, ? ,?)";
$stmt = $conn->prepare($sql);

$stmt->bind_param("iis", $currentUserID, $friendUserID, $content);

$stmt->execute();

echo "Something is wrong";

?>