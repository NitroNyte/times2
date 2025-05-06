<?php
require "includes/functions.php";
session_start();


$userID = $_SESSION['userID'];

$emailCurr = $_SESSION['email'];

$personDetails = getUserInfoByID($userID);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit information</title>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css' integrity='sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T' crossorigin='anonymous'>
    <link rel="stylesheet" href="assets/css/account.css">
    <script src="JQuery.js"></script>
</head>

<body>

    <main class='d-flex' style='background-color:rgb(50, 53, 60);'>
        <?php
        include "includes/header.php";
        ?>

        <section id="accountTab">
            <form id="editForm" class="d-flex justify-content-center align-items-center flex-column" method="post">
            <div class="imgBox pb-5">
                <img src="assets/images/account.svg" alt="Profile Picture">
            </div>
                <div class="form-group ">
                    <label for="name">Emri</label>
                    <input type="text" class="form-control" name="name" id="name" aria-describedby="name" value="<?php echo $personDetails['name']; ?>">
                    <label for="surname" class="pt-3">Mbiemri</label>
                    <input type="text" class="form-control" name="surname" id="surname" aria-describedby="surname" value="<?php echo $personDetails['surname']; ?>">
                    <label for="email" class="pt-3">Emaili</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" value="<?php echo $personDetails['email']; ?>">
                    <input type="hidden" id="currentEmail" value="<?php echo $personDetails['email']; ?>">
                    <label  for="password" class="pt-3">Passwordi</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="email" placeholder="" value="<?php echo $personDetails['password']; ?>">
                    <input type="hidden" value="<?php echo $userID; ?>" name="userID" id="userID">
                </div>
                <small id="emailHelp" class="form-text"></small>
                <button type="submit" class="btn btn-primary mt-3">Ruaj</button>
                <a href="account.php" class="btn btn-primary mt-3">Kthehu mbrapa</a>
            </form>
        </section>
    </main>
    

</body>
<script src='https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js' integrity='sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1' crossorigin='anonymous'></script>
<script src='https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js' integrity='sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM' crossorigin='anonymous'></script>
<script>

    //This adds the user and prevent's him from entering the same email
    $(document).ready(function(){
    $("#editForm").submit(function(event){
        event.preventDefault();

        let name = $("#name").val();
        let surname = $("#surname").val();
        let email = $("#email").val();
        let password = $("#password").val();
        let userID = $("#userID").val();
        let currentEmail = $("#currentEmail").val();

        $.post('check_email.php', { email: email, currentEmail: currentEmail }, function(response) {
            if (response.trim() === 'taken') {
                $("#emailHelp").text("Email is already taken!");
            } else {
                $.post('update_user.php', {
                    name: name,
                    surname: surname,
                    email: email,
                    password: password,
                    userID: userID
                }, function(updateResponse) {
                    if (updateResponse === 'success') {
                        $("#emailHelp").text("Updated profile with succsess");
                    }
                    else if(updateResponse === 'empty'){
                        $("#emailHelp").text("Please don't leave any text inputs empty");
                    }
                     else {
                        alert("Failed to update user.");
                    }
                });
            }
        });
    });
});

</script>
</html>