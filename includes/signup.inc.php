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
        header("location: ../index.php?error=emptyInput");  //skickar användaren tillbaka till index.php med error meddelande
        exit(); //avslutar scriptet
    }

    if (invalidUid($username) !== false) {
        header("location: ../index.php?error=invalidUid");
        exit();
    }

    if (invalidEmail($email) !== false) { 
        header("location: ../index.php?error=invalidEmail");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../index.php?error=pwdMismatch");
        exit();
    }

    if (uidExists($conn, $email) !== false) {    //$conn i dbh.inc.php
        header("location: ../index.php?error=emailTaken");
        exit();
    }

    createUser($conn, $email, $username, $pwd); //om allt frid och fröjd; skapa användaren
}

else {
    header("location: ../#show_reg"); //if the user doesn't go the proper way, send back to register
    exit();
}