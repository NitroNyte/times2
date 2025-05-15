<?php
require 'includes/db.php';

$name = $_POST['emri'];
$surname = $_POST['mbiemri'];
$email = $_POST['email'];
$password = $_POST['password'];


$conn = getConnection();



$stmtDuplicate = $conn->prepare("SELECT userID FROM users where email = ?");
$stmtDuplicate->bind_param("s", $email);
$stmtDuplicate -> execute();
$check = $stmtDuplicate->get_result();

if ($check->num_rows > 0) {
     echo "emailTaken";
} else {
    $stmt = $conn->prepare("INSERT INTO users(name, surname, email, password) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $surname, $email, $password);
    $stmt->execute();
    header("Location: index.php");
}


?>