<?php

require('./functions.php');

require_once('includes/config.php');
require_once('includes/classes/Account.php');
require_once('includes/classes/Constants.php');
require_once('includes/classes/FormSanitizer.php');

$account = new Account($con);


if (isset($_POST['submitButton'])) {
    // Form validation
    $username = FormSanitizer::sanitizeFormString($_POST['username']);
    $password = FormSanitizer::sanitizeFormString($_POST['password']);

    $success = $account->login($username, $password);

    // Store session
    if ($success) {
        $_SESSION['userLoggedIn'] = $username;
        header('Location: index.php');
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="assets/images/favicon.ico">
    <title>Sign In to KamilFlix 🍿 Movies, TV shows, and more!</title>
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
                <h3>Sign In</h3>
                <span>to continue to KamilFlix</span>
            </div>
            <form method="POST">
                <input type="text" name="username" id="username" placeholder="Username" value="<?php getInputValue("username") ?>" required>
                <input type="password" name="password" id="password" placeholder="Password" required>
                <?php echo $account->getError(Constants::$loginFailed) ?>
                <input type="submit" name="submitButton" id="submitButton" name="SUBMIT">
            </form>
            <div>
                <span>New to KamilFlix? Sign up <a href='register.php' class='signInMessage'>here!</a></span>
            </div>

        </div>
    </div>
</body>

</html>