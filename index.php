<?php
require "includes/functions.php";
session_start();

if(isset($_SESSION['userID'])){
    header('Location: funky.php');
    
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['LoginBtn'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (!empty($email) && !empty($password)) {
        $user = loginUser($email, $password);

        if ($user) {
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];
            $_SESSION['email'] = $_POST['email'];

            setUserOnline($user['userID']);
            header("Location: funky.php");
        }else{
            header("Location: index.php?error=1");
        }
    }else{
        header("Location: index.php?error=2");
    }
        
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log In</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/centerForm.css">
    <link rel="stylesheet" href="assets/css/globalFont.css">
    <script src="JQuery.js"></script>

</head>
<body class="d-flex justify-content-center align-items-center" style='background-image:linear-gradient(to bottom right,#333333,#111111)'>
<main>

    
        <div id="formDivison" class="d-flex justify-content-center align-items-center flex-column">
            <form id="loginForm" action="" class="d-flex justify-content-center align-items-center flex-column p-5 rounded" method="post">
                <h1 class="pb-3" style="color:white">x2 Log In</h1>
                <div class="form-group ">
                    <label for="email" style="color:white">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Shenoni emailin">
                    <label for="password" class="pt-3" style="color:white">Password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Shenoni passwordin">
                </div>

                <?php
                 if(isset($_GET['error']) && $_GET['error']==1){ 
                    echo '<p style="color:#dd7777">Email or password is invalid</p>'; 
                 }else if(isset($_GET['error']) && $_GET['error']==2){
                    echo '<p style="color:#dd7777">Email or password is empty</p>'; 
                 }?>
                <input type="submit" class="btn btn-primary" value="Log In" id="Log In" name="LoginBtn">
                <a href="register.php" class="pt-3">Don't have an account, click here to register</a>

            </form>
        </div>

        
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</main>
</body>


</html>