<?php

include_once("config/url.php");

session_start();

unset($_SESSION['user_token']);
unset($_SESSION['username']);

header("Location: " . $BASE_URL . "/login.php");
exit();
?>