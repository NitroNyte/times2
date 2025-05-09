<?php
require '../includes/db.php';

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$password = $_POST['password'];
$userID = $_POST['userID'];

$conn = getConnection();
if (empty($name)) {
    echo "empty";
} else {

    $sql = "UPDATE users SET name = ?, surname = ?, email = ?, password = ? WHERE userID = ?";
    $stmt = $conn->prepare($sql);

    $stmt->bind_param("ssssi", $name, $surname, $email, $password, $userID);

    if ($stmt->execute()) {
        echo "success";
    } else {
        echo "error";
    }
}

?>