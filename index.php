<?php
//Otwiera sesję - konieczne do przechowywanie zmiennych globalnych między stronami.
session_start(); 
unset($_SESSION['user']);




?>
<html>
<head>
<title>Logowanie</title>
</head>
<body>
  <h2>Logowanie</h2>
  <form name="login" method="get" action="validation.php">
   Użytkownik: <input type="text" name="username"><br>
   
   <input type="submit" name="submit" value="Walidacja">
  </form>
  <br>
  <br>
  
  <?php
 //Sprawdza czy sesja istnieje i wyświetla komunikat.
if (isset($_SESSION['error']))
{
   echo " ".$_SESSION['error'];
   unset($_SESSION['error']);
}

?>
<br>
<p><a href="registration.php">Rejestruj</a><p>
</body>
</html>