<?php

require_once('includes/config.php');
require_once('includes/classes/Account.php');
require_once('includes/classes/Constants.php');
require_once('includes/classes/FormSanitizer.php');

$account = new Account($con);

if (isset($_POST['submitButton'])) {
    // Form validation
    $firstName = FormSanitizer::sanitizeFormString($_POST['firstName']);
    $lastName = FormSanitizer::sanitizeFormString($_POST['lastName']);
    $username = FormSanitizer::sanitizeFormString($_POST['username']);
    $email = FormSanitizer::sanitizeFormString($_POST['email']);
    $email2 = FormSanitizer::sanitizeFormString($_POST['email2']);
    $password = FormSanitizer::sanitizeFormString($_POST['password']);
    $password2 = FormSanitizer::sanitizeFormString($_POST['password2']);

    $account->register($firstName, $lastName, $username, $email, $email2, $password, $password2);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to NetflixClone</title>
    <!-- css -->
    <link rel='stylesheet' type='text/css' href='assets/style/style.css'>
    <!-- fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

</head>

<body>
    <div class="signInContainer">
        <div class="column">
            <div class="header">
                <img src='assets/images/logo.png' title='logo' alt='site logo'>
                <h3>Sign Up</h3>
                <span>to continue to KamilFlix</span>
            </div>
            <form method="POST">
                <input type="text" name="firstName" id="firstName" placeholder="First Name" required>
                <?php echo $account->getError(Constants::$firstNameCharacters); ?>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name" required>
                <?php echo $account->getError(Constants::$lastNameCharacters); ?>
                <input type="text" name="username" id="username" placeholder="Username" required>
                <?php echo $account->getError(Constants::$usernameCharacters); ?>
                <?php echo $account->getError(Constants::$usernameTaken); ?>
                <input type="email" name="email" id="email" placeholder="Email Address" required>
                <input type="email" name="email2" id="email2" placeholder="Confirm Email" required>
                <?php echo $account->getError(Constants::$emailsDontMatch); ?>
                <?php echo $account->getError(Constants::$emailInvalid); ?>
                <?php echo $account->getError(Constants::$emailTaken); ?>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <input type="password" name="password2" id="password2" placeholder="Confirm password" required>
                <?php echo $account->getError(Constants::$passwordsDontMatch); ?>
                <?php echo $account->getError(Constants::$passwordLength); ?>
                <input type="submit" name="submitButton" id="submitButton" name="SUBMIT">
            </form>
            <div>
                <span>Already have an account? Sign in <a href='login.php' class='signInMessage'>here!</a></span>
            </div>

        </div>
    </div>
</body>

</html>