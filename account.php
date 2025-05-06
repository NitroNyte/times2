<?php
session_start();
require "includes/functions.php";

$userID = $_SESSION['userID'];

$personDetails = getUserInfoByID($userID);

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <link rel="stylesheet" href="assets/css/account.css">
</head>

<body>

    <main class='d-flex' style='background-color:rgb(50, 53, 60);'>
        <?php
        include "includes/header.php";
        ?>

        <section id="accountTab">
            <div class="infoBox">
                <div class="imgBox pb-5 d-flex justify-content-center align-items-center">
                    <img src="assets/images/account.svg" alt="Profile Picture">
                </div>
                <div class="form-group d-flex justify-content-center align-items-center flex-column">
                    <label for="nameSurname">Emri dhe mbiemri</label>
                    <input type="text" class="form-control" name="nameSurname" id="nameSurname" aria-describedby="nameSurname" value="<?php echo $personDetails['name'] . " " . $personDetails['surname']; ?>" disabled>
                    <label for="email" class="pt-3">Emaili</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="" value="<?php echo $personDetails['email']; ?>" disabled>
                </div>
                <a href="editAccount.php" class="btn btn-primary mt-3 ">Edit information</a>
            </div>
        </section>
    </main>


</body>

<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js' integrity='sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>

</html>