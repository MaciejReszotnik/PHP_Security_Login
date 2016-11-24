<?php
session_start(); 
//Sprawdzam czy użytkownik jest zalogowany - jeśli nie przerzucam go do strony logowania.
if(!isset($_SESSION['user']))
{
$_SESSION['error']="Brak użytkownika";
unset($_SESSION['user']);
header('Location: index.php');

}

?>

<html>
<head>
<title>Witaj!</title>
</head>
<body>
  <h2><?php echo "Witaj ".$_SESSION['user']."!"; ?></h2>
  <form name="newEntry" method="get" action="processSettings.php">
  <h3>Ustawienia</h3>
  
<h3>Blokowanie konta </h3>
Liczba nieudanych logowań: <select name="noFails"><option value="0">Brak limitu</option><option value="2">2</option><option value="3">3</option><option value="5">5</option></select>

<br>

<a href="changePassword.php">Zmień hasło</a>

   
   <input type="submit" name="submit" value="Zmień ustawienia!">
  </form>
  <br>
  <a href="changePassword.php">Zmień hasło</a>
  <br>
  <br>
  <a href="success.php">Dodaj nowy wpis</a>
  <a href="read.php">Wyświetl wiadomość</a>
  <a href="readEdit.php">Modyfikuj</a>
  <a href="remove.php">Usuń wpis</a>
  <a href="grantRights.php">Nadaj uprawnienia</a>
  <a href="settings.php">Ustawienia</a>
  <a href="logOut.php">Wyloguj</a>
  <br>
  <?php
if (isset($_SESSION['error']))
{
   echo " ".$_SESSION['error'];
   unset($_SESSION['error']);
}

?>
</body>
</html>