<?php
  if (isset($_GET["error"])) {   //checking for data inside the URL that we CAN see, a "get method"
      if ($_GET["error"] == "emptyInput") {     
          echo "<p class=\"errors\">Fyll i alla fält!</p>";
      }
      elseif ($_GET["error"] == "invalidUid") {
          echo "<p class=\"errors\">Välj ett annat användarnamn!</p>";
      }
      elseif ($_GET["error"] == "invalidEmail") {
          echo "<p class=\"errors\">Skriv korrekt e-post!</p>";
      }
      elseif ($_GET["error"] == "pwdMismatch") {
          echo "<p class=\"errors\">Lösenorden matchades inte!</p>";
      }
      elseif ($_GET["error"] == "emailTaken") {
          echo "<p class=\"errors\">E-post adressen du valde är upptagen..</p>";
      }
      elseif ($_GET["error"] == "stmtfailed") {
          echo "<p class=\"errors\">Något gick snett. Försök på nytt..</p>";
      }
      elseif ($_GET["error"] == "invalidLogin") {
        echo "<p class=\"errors\">Det gick inte, testa igen!</p>";
    }
      elseif ($_GET["error"] == "wrongLogin") {
          echo "<p class=\"errors\">Det gick inte, testa igen!</p>";
      }
      
  }