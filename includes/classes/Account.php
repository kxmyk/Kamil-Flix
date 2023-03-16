<?php

class Account
{

  private $con;
  private $errorArray = array();

  public function __construct($con)
  {
    $this->con = $con;
  }

  // Calling functions
  public function register($fn, $ln, $un, $em, $em2, $pw, $pw2)
  {
    $this->validateFirstName($fn);
    $this->validateLastName($ln);
    $this->validateUsername($un);
    $this->validateEmails($em, $em2);
    $this->validatePasswords($pw, $pw2);

    if (empty($this->errorArray)) {
      return $this->insertUserDetails($fn, $ln, $un, $em, $pw);
    }
    return false;
  }

  public function login($un, $pw)
  {
    $pw = hash('sha512', $pw);
    $query = $this->con->prepare("SELECT * FROM users WHERE username=:un AND password=:pw");
    $query->bindValue(':un', $un);
    $query->bindValue(':pw', $pw);

    $query->execute();

    if ($query->rowCount() == 1) {
      return true;
    }
    array_push($this->errorArray, Constants::$loginFailed);
    return false;
  }

  private function insertUserDetails($fn, $ln, $un, $em, $pw)
  {
    $pw = hash('sha512', $pw);

    $query = $this->con->prepare("INSERT INTO users (firstName, lastName, username, email, password) VALUES (:fn, :ln, :un, :em, :pw)");
    $query->bindValue(':fn', $fn);
    $query->bindValue(':ln', $ln);
    $query->bindValue(':un', $un);
    $query->bindValue(':em', $em);
    $query->bindValue(':pw', $pw);

    return $query->execute();
  }

  // First Name Validation
  private function validateFirstName($fn)
  {
    // First name must be between 2 and 25 char
    if (strlen($fn) < 2 || strlen($fn) > 25) {
      array_push($this->errorArray, Constants::$firstNameCharacters);
    }
  }

  // Last Name Validation
  private function validateLastName($ln)
  {
    // Last name must be between 2 and 50 char
    if (strlen($ln) < 2 || strlen($ln) > 50) {
      array_push($this->errorArray, Constants::$lastNameCharacters);
      return;
    }
  }

  // Username Validation
  private function validateUsername($un)
  {
    // Username must be between 2 and 25 char
    if (strlen($un) < 5 || strlen($un) > 25) {
      array_push($this->errorArray, Constants::$usernameCharacters);
      return;
    }

    // Checks if username is not taken
    $query = $this->con->prepare("SELECT * FROM users WHERE username=:un");
    $query->bindValue(":un", $un);

    $query->execute();

    if ($query->rowCount() != 0) {
      array_push($this->errorArray, Constants::$usernameTaken);
    }
  }

  // Email Validation
  private function validateEmails($em, $em2)
  {
    // Checks if emails do match
    if ($em != $em2) {
      array_push($this->errorArray, Constants::$emailsDontMatch);
      return;
    }

    // Checks if $em is a valid email
    if (!filter_var($em, FILTER_VALIDATE_EMAIL)) {
      array_push($this->errorArray, Constants::$emailInvalid);
      return;
    }

    // Checks if email is not taken
    $query = $this->con->prepare("SELECT * FROM users WHERE email=:em");
    $query->bindValue(":em", $em);

    $query->execute();

    if ($query->rowCount() != 0) {
      array_push($this->errorArray, Constants::$emailTaken);
    }
  }

  private function validatePasswords($pw, $pw2)
  {
    // Checks if passwords do match
    if ($pw != $pw2) {
      array_push($this->errorArray, Constants::$passwordsDontMatch);
      return;
    }
    // Password must be between 8 and 50char
    if (strlen($pw) < 8 || strlen($pw) > 50) {
      array_push($this->errorArray, Constants::$passwordLength);
    }
  }

  public function getError($error)
  {
    // Returns error so it can be shown to the user
    if (in_array($error, $this->errorArray)) {
      return "<span>$error</span>";
    }
  }
}
