

<?php
require "includes/db.php";

if(!empty($_POST['emri']) && !empty($_POST['mbiemri']) && !empty($_POST['email']) && !empty($_POST['password'])) {
  if(registerUser($_POST['emri'],$_POST['mbiemri'],$_POST['email'],$_POST['password'])) {
    echo "Emaili eshte i nxene";
  }
  else {
    header("Location: chatPage.php");
    exit();
  }
  
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
</head>
<body>
    
  <div id="formDivison" class="d-flex justify-content-center align-items-center flex-column">
    <form id="loginForm" action="" class="d-flex justify-content-center align-items-center flex-column p-5 rounded" method="post">
      <h1 class="pb-3">x2 Register</h1>
      <div class="form-group ">
        <label for="emri">Emri</label>
        <input type="text" class="form-control" name="emri" id="emri" aria-describedby="emri" placeholder="Shenoni emrin">
      </div>
      <div class="form-group ">
        <label for="mbiemri">Mbiemri</label>
        <input type="text" class="form-control" name="mbiemri" id="mbiemri" aria-describedby="mbiemri" placeholder="Shenoni mbiemrin">
      </div>
      <div class="form-group ">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Shenoni emailin">
      </div>
      <div class="form-group ">
        <label for="password">Password</label>
        <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Shenoni passwordin">
      </div>

      <input type="submit" class="btn btn-primary" value="Register">


      <a href="index.php">Have an account, click here to log in!</a>

    </form>
  </div>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>



</body>
</html>