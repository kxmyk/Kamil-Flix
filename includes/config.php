<?php

include('/Users/kamillukasiuk/Desktop/webDev/netflix-clone/prod/cc.php');

ob_start(); // Turns on output buffering
session_start();

date_default_timezone_set('Europe/Warsaw');

try {
  $con = new PDO("mysql:dbname=netflix_clone;host=localhost", $username, $password);
  $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
} catch (PDOException $e) {
  exit("Connection failed: " . $e->getMessage());
}
