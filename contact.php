<?php
require "includes/functions.php";

session_start();
if (!isset($_SESSION['userID'])) {
    header("Location: index.php");
}

$userID = $_SESSION['userID'];
//send's, accept's and delete's friend request's respectevly
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sendRequest'])) {
    $email = $_POST['email'];
    sendFriendRequest($userID, $email);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['accept'])) {
    acceptFriendRequest($_GET['accept'], $userID);
}

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reject'])) {
    deleteFriendRequest($userID,$_GET['reject']);
}


if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['startAChat'])) {
    header("Location: funky.php?startChat=".$userID);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacts</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/contact.css">
</head>

<body>

    <main class="d-flex" style="background-color:rgb(50, 53, 60);">

        <?php
        include "includes/header.php";
        ?>

        <section id="friendsTab">
            <div class="popUpBox" id="popUp">
                <div class="popUpBox-inner">
                    <h4 class="pb-5">Add friends using their email to send a request!</h4>
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                            <small id="emailHelp" class="form-text text-muted">Please be specific when entering your friends email</small>
                        </div>
                        <input type="submit" name="sendRequest" class="btn btn-primary mt-3 mb-3" value="Send request">
                    </form>
                    <button class="btn btn-primary" id="closePopUp">Close panel</button>
                </div>
            </div>

            <?php if (isset($_GET['clist'])) { ?>

                <div class="popUpBoxNotification open" id="popUpNotifications">
                    <div class="popUpBox-Notification">
                        <h4 class="pb-3 border-bottom">Friend requests</h4>
                        <ul>
                            <?php
                            $arrayOfFriendRequests = getPendingList($_SESSION['userID']);
                            if (!empty($arrayOfFriendRequests) && $arrayOfFriendRequests->num_rows > 0) {
                                while ($row = $arrayOfFriendRequests->fetch_assoc()) {
                                    $fullName = $row['name'] . $row['surname'];

                                    echo '<li>
                                    <div class="friendRequestGroup pl-3 pr-4 p-1">
                                        <img src="assets/images/account.svg" alt="" width="60">
                                        <div class="info">
                                            <p>' . htmlspecialchars($fullName) . '</p>
                                        </div>
                                        <div class="linkBox">
                                            <a href="contact.php?accept=' . $row['userID'] . '"><img src="assets/images/check.svg" alt="" width="30" title="Accept"></a>
                                            <a href="contact.php?reject=' . $row['friendID'] . '"><img src="assets/images/close.svg" alt="" width="30" title="Ignore"></a>
                                        </div>
                                    </div>
                                </li>';
                                }
                            } else {
                                echo "<li>You have no friend request's</li>";
                            }
                            ?>
                        </ul>
                        <button class="btn btn-primary" style="position:relative; top:8em;" id="closePopUpNotification">Close panel</button>
                    </div>
                    <script>
                        const closeNotificationsBtn = document.getElementById("closePopUpNotification");
                        const notificationsPane = document.getElementById("popUpNotifications");

                        closeNotificationsBtn.addEventListener("click", () => {
                            notificationsPane.classList.remove("open");
                            window.location.href = 'contact.php'
                        });
                    </script>
                </div>
            <?php } ?>

            <div class="floatingPart">
                <div class="imagePart">
                    <img src="assets/images/add.svg" alt="Add friend" id="friend" style="cursor: pointer;">
                    <img src="assets/images/notification.svg" alt="Notification" id="notifications" style="cursor: pointer;">
                </div>
            </div>

            <div class="friendsTabDesign">
                <ul style="text-decoration: none; list-style:none;">
                    <?php

                    $friendList = getFriendList($userID);
                    if (!empty($friendList)) {
                        while ($row = $friendList->fetch_assoc()) {
                            $fullName = $row['name'] . $row['surname'];
                            echo "<li>
                    <div class='friendsGroup pl-3 pr-4 p-1'>
                        <img src='assets/images/account.svg' alt='' width='60'>
                        <div class='info'>
                            <p>" . htmlspecialchars($fullName) . "</p>
                            <p>Last online</p>
                        </div>
                        <div class='linkBox'>
                            <a href='funky.php?startChat=". $row['userID'] . "'><img src='assets/images/chat.svg' alt='' width='30' title='Chat with friend'></a>
                            <a href='contact.php?reject=". $row['userID'] ."'><img src='assets/images/close.svg' alt='' width='30' title='Delete friend'></a>
                        </div>
                    </div>
                </li>";
                        }
                    }

                    ?>

                </ul>


            </div>
        </section>



        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="assets/js/contact.js">
            function sendData(userid) {
                $.ajax({
                    type: "POST",
                    url: "contact.php",
                    data: {
                        userID: userid
                    }
                });
            }
        </script>
    </main>
</body>

</html>