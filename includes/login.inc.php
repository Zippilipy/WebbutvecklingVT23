<?php

    if (isset($_POST["submit"])) {    //checking if the user acceses this page the proper way, superglobal POST
        
        $email = $_POST["logemail"];  //if the user passed in a uid
        $pwd = $_POST["logpwd"];

        require_once 'dbh.inc.php';
        require_once 'functions.inc.php';

        //some errorhandling
        if (emptyInputLogin($email, $pwd) !== false) {     //if not (!) equal (==) to false, inte samma som == true!!
            //emptyInputLogin är en funktion som finns i funtions.inc.php
            $redirectUrl = '../index.php?login_error=true';
            header('Location: ' . $redirectUrl);
            exit(); //avslutar scriptet
        }

        loginUser($conn, $email, $pwd);
     
    }
    else {   //if its not done the proper way, send the user back.
        header("location: ../#show_log");
        exit();
    }