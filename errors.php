<?php
if (isset($_GET['login_error']) && $_GET['login_error'] == 'true') {
    $displayErrorlogin = true;
} else {
    $displayErrorlogin = false;
}

if (isset($_GET["register_error"])) {
    if ($_GET["register_error"] == "emptyInput") {
        $displayErrorregister = true;
        $display = "Fill in all fields!";
    } elseif ($_GET["register_error"] == "invalidUid") {
        $displayErrorregister = true;
        $display = "Choose a different username!";
    } elseif ($_GET["register_error"] == "invalidEmail") {
        $displayErrorregister = true;
        $display = "Enter a valid email address!";
    } elseif ($_GET["register_error"] == "pwdMismatch") {
        $displayErrorregister = true;
        $display = "Passwords did not match!";
    } elseif ($_GET["register_error"] == "emailTaken") {
        $displayErrorregister = true;
        $display = "The email address you chose is already taken.";
    } elseif ($_GET["register_error"] == "stmtfailed") {
        $displayErrorregister = true;
        $display = "Something went wrong. Please try again.";
    } elseif ($_GET["register_error"] == "invalidLogin") {
        $displayErrorregister = true;
        $display = "Login failed, please try again!";
    } elseif ($_GET["register_error"] == "wrongLogin") {
        $displayErrorregister = true;
        $display = "Login failed, please try again!";
    }
}
?>