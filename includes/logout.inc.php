<?php
    //completely destroy the current sessionvariables inside our session to logout the user
    session_start();
    session_unset();
    session_destroy();

    header("location:../index.php");
    exit();