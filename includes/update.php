<?php

session_start();

if (isset($_POST["submit"])) {      // om formuläret skickas genom submit knappen

    $email = $_POST["cemail"];       // collecting the data from the input with name email
    $username = $_POST["cuser"];
    $pwd = $_POST["cpassword"];
    $pwdRepeat = $_POST["cpasswordconf"];
    $oldPwd = $_POST["cpasswordold"];
    $ID = $_SESSION["userid"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    var_dump($username);

    if (invalidUid($username) !== false) {
        header("location: ../index.php?error=invalidUid");
        exit();
    }

    if (invalidEmail($email) !== false) {
        header("location: ../index.php?error=invalidEmail");
        exit();
    }

    if (uidExists($conn, $email) !== false && $email !== $_SESSION["userEmail"]) {    //$conn i dbh.inc.php
        header("location: ../index.php?error=emailTaken");
        exit();
    }

    if (pwdMatch($pwd, $pwdRepeat) !== false) {
        header("location: ../index.php?error=pwdMismatch");
        exit();
    }

    $uidExists = uidExists($conn, $_SESSION["userEmail"]); //ena för username, andra för epost

    $pwdHashed = $uidExists["usersPwd"]; //grab the data from the column usersPwd in the database
    $checkPwd = password_verify($oldPwd, $pwdHashed); //if these match it returns at true

    if ($checkPwd === false) {
        header("location: ../index.php?error=wrongLogin");
        exit();
    }

    $sql = "UPDATE users SET usersUid='$username', usersEmail='$email' WHERE usersID='$ID'";

    if (mysqli_query($conn, $sql)) {
        echo "Record updated successfully";
        var_dump($ID);
    } else {
        echo "Error updating record: " . mysqli_error($conn);
    }

    //$sql = "UPDATE users SET usersEmail='$email' WHERE usersID='$ID'";

    //if (mysqli_query($conn, $sql)) {
    //    echo "Record updated successfully";
    //    var_dump($ID);
    //} else {
    //    echo "Error updating record: " . mysqli_error($conn);
    //}

    mysqli_close($conn);

    if ($checkPwd === true) {
        session_start();
        //create session variables (superglobals)
        $_SESSION["userUid"] = $username;
        $_SESSION["userEmail"] = $email;
        header("location: ../index.php");
    }
}

?> 