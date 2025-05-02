<?php
require "includes/functions.php";
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['LoginBtn'])) {
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';

    if (!empty($email) && !empty($password)) {
        $user = loginUser($email, $password);

        if ($user) {
            $_SESSION['userID'] = $user['userID'];
            $_SESSION['name'] = $user['name'];
            $_SESSION['surname'] = $user['surname'];

            header("Location: chatPage.php");
            exit();
        } else {
            $echo = "Email ose fjalëkalim i pasaktë.";
        }
    } else {
        $echo = "Ju lutem plotësoni të gjitha fushat.";
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
</head>

<main>

    <body class="d-flex justify-content-center align-items-center">
        <div id="formDivison" class="d-flex justify-content-center align-items-center flex-column">
            <form id="loginForm" action="" class="d-flex justify-content-center align-items-center flex-column p-5 rounded" method="post">
                <h1 class="pb-3">x2 Log In</h1>
                <div class="form-group ">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email" aria-describedby="email" placeholder="Shenoni emailin">
                    <label for="password" class="pt-3">Password</label>
                    <input type="password" class="form-control" name="password" id="password" aria-describedby="password" placeholder="Shenoni passwordin">
                </div>

                <input type="submit" class="btn btn-primary" value="Log In" id="Log In" name="LoginBtn">
                <a href="register.php">Don't have an account, click here to register</a>

            </form>
        </div>

        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</main>

</body>

</html>