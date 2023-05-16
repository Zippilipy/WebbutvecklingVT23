<?php

session_start();

if (isset($_POST["submit"])) {      // om formuläret skickas genom submit knappen

    $email = $_POST["cemail"];       // collecting the data from the input with name email
    $username = $_POST["cuser"];
    $pwd = $_POST["cpassword"];
    $pwdRepeat = $_POST["cpasswordconf"];
    $oldPwd = $_POST["cpasswordold"];
    $ID = $_SESSION["userid"];
    $share = $_POST["sharelist"];

    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

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

    if(isset($pwd) && $pwd !== '') {
        $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);

        $sql = "UPDATE users SET usersUid='$username', usersEmail='$email', usersPwd='$hashedPwd' WHERE usersID='$ID'";

        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    //$sql = "UPDATE users SET usersEmail='$email' WHERE usersID='$ID'";

    //if (mysqli_query($conn, $sql)) {
    //    echo "Record updated successfully";
    //    var_dump($ID);
    //} else {
    //    echo "Error updating record: " . mysqli_error($conn);
    //}



    if(isset($share) && $share !== ''){
        if (invalidEmail($share) !== false) {
            header("location: ../index.php?error=invalidEmail");
            exit();
        }
        $query = "SELECT usersID FROM users WHERE usersEmail = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s", $share);
        $stmt->execute();
        $result = $stmt->get_result();
        $newid = $result->fetch_assoc();
        $newid = $newid['usersID'];

        if(isset($newid)) {

            //Add into shared array
            $query = "SELECT userShared FROM users WHERE usersID = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("i", $newid);
            $stmt->execute();
            $result = $stmt->get_result();
            $sharedarray = [];
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $sharedarray = json_decode($row["userShared"], true);
            }
            // Remove item from array and update in database
            if (in_array($ID, $sharedarray)){
                    $index = array_search($ID, $sharedarray);
                    if ($index !== false) {

                        array_splice($sharedarray, $index, 1);
                    }
                    $query = "UPDATE users SET userShared = ? WHERE usersID = ?";
                $stmt = $conn->prepare($query);
                $variable = json_encode($sharedarray);
                $stmt->bind_param("si", $variable, $newid);
                $stmt->execute();
                $stmt->close();
                echo "<script>window.location.reload();</script>";
                header("location: ../index.php");
                exit();
            }else{// Add item from array and update in database
                $sharedarray[] = $ID;
                $query = "UPDATE users SET userShared = ? WHERE usersID = ?";
            $stmt = $conn->prepare($query);
            $variable = json_encode($sharedarray);
            $stmt->bind_param("si", $variable, $newid);
            $stmt->execute();
            $stmt->close();
        }}else{
            header("location: ../index.php?error=invalidEmail");
            exit();
        }

    }

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