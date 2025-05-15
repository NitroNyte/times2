<?php
include "includes/functions.php";
session_start();
if (isset($_SESSION['userID'])) {
  header("Location: funky.php");
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="assets/css/centerForm.css">
  <link rel="stylesheet" href="assets/css/globalFont.css">

</head>

<body>
  <main>
    <div id="formDivison" class="d-flex justify-content-center align-items-center flex-column" style='background-image:linear-gradient(to bottom right,#333333,#111111)'>
      <form id="registerForm" action="" class="d-flex justify-content-center align-items-center flex-column p-5 rounded" method="post">
        <h1 class="pb-3">x2 Register</h1>
        <div class="form-group ">
          <label for="emri">Name</label>
          <input type="text" class="form-control" name="emri" id="emri" aria-describedby="emri" placeholder="Enter name">
        </div>
        <div class="form-group ">
          <label for="mbiemri">Surname</label>
          <input type="text" class="form-control" name="mbiemri" id="mbiemri" aria-describedby="mbiemri" placeholder="Enter surname">
        </div>
        <div class="form-group ">
          <label for="email">Email</label>
          <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Enter email">
        </div>
        <div class="form-group ">
          <label for="password">Password</label>
          <input type="password" class="form-control" name="password" minlength="8" id="password" aria-describedby="password" placeholder="Enter password">
        </div>
        <p id="registerMessage"></p>

        <input type="submit" class="btn btn-primary" value="Register">


        <a href="index.php" class="pt-3">Have an account, click here to log in!</a>

      </form>
    </div>

    <script src="assets/js/JQuery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="assets/js/register.js"></script>
  </main>

</body>

</html>