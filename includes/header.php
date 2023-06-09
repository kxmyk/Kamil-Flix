<?php

require_once('./vendor/autoload.php');
require_once('./includes/config.php');


if (!isset($_SESSION['userLoggedIn'])) {
  header('location: register.php');
}
$userLoggedIn = $_SESSION['userLoggedIn'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="../assets/images/favicon.ico">
  <title>KamilFlix 🍿 Movies, TV shows, and more!</title>
  <!-- css -->
  <link rel='stylesheet' type='text/css' href='assets/style/style.css'>
  <!-- fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
  <!-- icons -->
  <script src="https://kit.fontawesome.com/564395c8f0.js" crossorigin="anonymous"></script>
  <!-- jquery -->
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <!-- javascript -->
  <script src='assets/js/script.js'></script>
</head>

<body>
  <div class="wrapper">

    <?php
    if (!isset($hideNav)) {
      include_once("includes/navBar.php");
    }
    ?>