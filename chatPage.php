<?php
require 'includes/functions.php';
session_start();
$userID = $_SESSION['userID'];
//ska use qtu niher

?>


<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>x2Chat</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <link rel='stylesheet' href='assets/css/chatPage.css'>
</head>

<body>

    <main class='d-flex' style='background-color:rgb(50, 53, 60);'>
    <?php
    include 'includes/header.php';
    ?>

    <section id='chatPanel' class='pl-3 pr-3 pt-3'>
    <div class='nameBox'>
            <p style='color: white; border-bottom: 1px solid white; padding-bottom: 10px;'>Messages</p>
        </div>

        <?php
        $friendsList = getFriendListDESC($userID);
        if(!empty($friendsList)){
            echo'<ul style="list-style-type: none;">';
            while($row = $friendsList -> fetch_assoc()){
                $fullName = $row['name'] . " ". $row['surname'];
                echo "
                <a href='chatPage.php?startChat=". $row['userID'] ."' style='text-decoration:none;'>
                <li>
                        <div class='node'>
                        <img src='assets/images/account.svg' alt='' width='60'>
                        <div class='info'>
                            <p>".htmlspecialchars($fullName)."</p>
                            <p class='text-secondary'>Last online</p>
                        </div>
                        </div>
                        </li>
                        </a>";
            }
        } 
        
            
        echo"</ul>";
        ?>
    </section>


    <section id='messagePanel' class='messagePanelEdit'>
        <?php
        if(isset($_GET['startChat'])) {
            $fullNameList = getFriendName($_GET['startChat']);
            $row = $fullNameList -> fetch_assoc();
       echo "<div class='infoBox'>
            <img src='assets/images/account.svg' alt='picture' width='60'>
            <div id='nameAndSurname' class='nameBox'>
                <p>".$row['name']. " ".$row['surname']."</p>
            </div>
        </div>

        <div class='textAreaMessages' id='chatArea'>

            <div class='sender'>
                <div class='senderBoxMessage'>
                    <p>Hello</p>
                </div>
            </div>

            <div class='contact'>
                <div class='contactBoxMessage'>
                    <div class='contactBoxName'>
                        <h6 style='color:gray; font-style:italic; padding-left: 10px'>Friend</h6>
                    </div>
                    <div class='contactBoxSentMessage'>
                        <p>What's up</p>
                    </div>

                </div>
            </div>

        </div>

        <div class='messageBox'>
            <input id='msgTypeBox' type='text' placeholder='Type your here...'>
        </div>";

        }
        else {
            echo"<h1 style='display:flex;justify-content:center;align-items:center; flex:1; color: white; font-weight:bold; font-style:italic;'>Select a friend to chat with</h1>";
        }

        ?>
    </section>



    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
    <script src="assets/js/chatPage.js"></script>



</main>
</body>

</html>