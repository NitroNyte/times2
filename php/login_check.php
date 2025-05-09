<?php
require '../includes/db.php';

$email = $_POST['email'];
$password = $_POST['password'];


$conn = getConnection();

$sql = "SELECT userID, name, surname, email WHERE email = ? AND password = ?";
$stmt = $conn->prepare($sql);

$stmt->bind_param("ss", $email, $password);


if ($stmt->execute()) {
    echo "success";
} else {
    echo "error";
}

?>