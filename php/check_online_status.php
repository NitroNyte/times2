<?php
session_start();
require "../includes/functions.php";

$currentUserID = $_POST['userID'];
$conn = getConnection();

$sql = "SELECT u.userID, 
               IF(NOW() - INTERVAL 1 MINUTE < u.last_seen, 'Online', 'Offline') AS status 
        FROM contacts c 
        INNER JOIN users u 
            ON ((c.userID = ? AND u.userID = c.friendID) OR (c.friendID = ? AND u.userID = c.userID)) 
        WHERE c.status = 'accepted' 
        GROUP BY u.userID";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $currentUserID, $currentUserID);
$stmt->execute();
$result = $stmt->get_result();

$response = [];
while ($row = $result->fetch_assoc()) {
    $response[] = [
        'userID' => $row['userID'],
        'status' => $row['status']
    ];
}

header('Content-Type: application/json');
echo json_encode($response);
?>
