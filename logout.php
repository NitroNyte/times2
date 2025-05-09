<?php
require "includes/functions.php";
session_start();
setUserOffline($_SESSION['userID']);
session_unset();
session_destroy();
header('Location: index.php');
?>