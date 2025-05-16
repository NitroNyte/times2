<?php
session_start();
require "includes/functions.php";


$currentUserID = $_SESSION['userID'];

$conn = getConnection();
$stmt = $conn->prepare("SELECT u.userID, u.name, u.surname, u.status FROM contacts c JOIN users u 
    ON ((c.userID = ? AND u.userID = c.friendID) OR (c.friendID = ? AND u.userID = c.userID)) 
    WHERE c.status = 'accepted' GROUP BY u.userID ORDER BY c.lastChatted DESC");

$stmt->bind_param("ii", $currentUserID, $currentUserID);
$stmt->execute();
$result = $stmt->get_result();


echo "<div class='nameBox'>
        <p style='color: white; border-bottom: 1px solid white; padding-bottom: 10px;'>Messages</p>
      </div>";

if ($result->num_rows > 0) {
    echo "<ul style='list-style-type: none;'>";
    while ($row = $result->fetch_assoc()) {
        $fullName = $row['name'] . " " . $row['surname'];
        echo "
        <a href='funky.php?startChat=" . $row['userID'] . "' style='text-decoration:none;'>
            <li>
                <div class='node'>
                    <img src='assets/images/account.svg' alt='' width='60'>
                    <div class='info'>
                        <p>" . htmlspecialchars($fullName) . "</p>
                        <p class='text-secondary'>" . htmlspecialchars($row['status']) . "</p>
                    </div>
                </div>
            </li>
        </a>";
    }
    echo "</ul>";
} else {
    echo "<p style='color:white;'>No contacts found.</p>";
}
?>
