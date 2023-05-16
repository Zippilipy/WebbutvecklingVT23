 <?php

if (isset($_POST["submit"])) {      // om formuläret skickas genom submit knappen

    // ["..."] hänvisar till attributet i formuläret
    $email = $_POST["email"];       // collecting the data from the input with name email
    $username = $_POST["uid"];
    $pwd = $_POST["pwd"];
    $pwdRepeat = $_POST["pwdrepeat"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    //ERRORHANDLING

    if (emptyInputSignup($email, $username, $pwd, $pwdRepeat) !== false) {     //if not (!) equal (==) to false, inte samma som == true!!
        //emptyInputSignup är en funktion som finns i funtions.inc.php
        $redirectUrl = '../index.php?register_error=emptyInput';
        header('Location: ' . $redirectUrl); //skickar användaren tillbaka till index.php med error meddelande
        exit(); //avslutar scriptet
    }

    if (invalidUid($username) !== false) {
        header("location: ../index.php?register_error=invalidUid");
        exit();
    }

    if (invalidEmail($email) !== false) {
        $redirectUrl = '../index.php?register_error=invalidEmail';
        header('Location: ' . $redirectUrl);
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        $redirectUrl = '../index.php?register_error=pwdMismatch';
        header('Location: ' . $redirectUrl);
        exit();
    }

    if (uidExists($conn, $email) !== false) {    //$conn i dbh.inc.php
        $redirectUrl = '../index.php?register_error=emailTaken';
        header('Location: ' . $redirectUrl);
        exit();
    }

    createUser($conn, $email, $username, $pwd); //om allt frid och fröjd; skapa användaren
}

else {
    header("location: ../#show_reg"); //if the user doesn't go the proper way, send back to register
    exit();
}