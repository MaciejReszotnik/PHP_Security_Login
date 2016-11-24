<?php
session_start(); 

?>
<html>
<head>
<title>Zmiana hasła</title>
</head>
<body>
  <h2>Zmiana hasła</h2>
  <form name="login" method="post" action="passChanger.php">
  
     

   Hasło: <input type="password" name="password1"><br>
   Powtórz hasło: <input type="password" name="password2"><br>
   
   <?php
          require_once('recaptchalib.php');
          $publickey = "6Lcz-PQSAAAAADyZ3QN3hMIuXCNIWG1u-0QfdirV"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>
   
   <input type="submit" name="submit" value="Zmień hasło!">
  </form>
  <br>
  <br>
  
  <?php
if (isset($_SESSION['error']))
{
   echo " ".$_SESSION['error'];
   unset($_SESSION['error']);
}

?>
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
</body>
</html>