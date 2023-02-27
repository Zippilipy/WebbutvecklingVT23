<?php   
    //$ = variable 
    $serverName = "localhost";  //xampp
    $dBUsername = "root";
    $dBPassword = "";           // tom 'on default' 
    $dBName = "DB";  // databas i php myadmin

    //mysqli_connect opens a connection to the MySQL Server.
    $conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName); // function & uppkoppling

    if(!$conn) {    //om uppkoppling (!) INTE funkar
        die("Uppkoppling misslyckades: " . mysqli_connect_error()); //'kill it' och visa meddelande
    }
    //mysqli_connect_error() returns the error message from the last connection attempt, no parameters.

    //die() = exit()

/* när dokumentet enbart innehåller php avslutar vi inte php taggen med ?>, 
alltså lämna det öppet! */ 