<?php
require '../includes/db.php'; 

$email = $_POST['email'];
$currentEmail = $_POST['currentEmail'];

$conn = getConnection();


$sql = "SELECT * FROM users WHERE email = ? AND email != ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $email, $currentEmail);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo "taken";
} else {
    echo "ok";
}
?>