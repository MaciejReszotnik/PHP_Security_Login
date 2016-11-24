<?php
session_start(); 

?>
<html>
<head>
<title>Rejestracja</title>
</head>
<body>
  <h2>Rejestracja</h2>
  <form name="login" method="post" action="register.php">
  
     <?php
          require_once('recaptchalib.php');
          $publickey = "6Lcz-PQSAAAAADyZ3QN3hMIuXCNIWG1u-0QfdirV"; // you got this from the signup page
          echo recaptcha_get_html($publickey);
        ?>

  
   Nazwa użytkownika: <input type="text" name="username"><br>
   Hasło: <input type="password" name="password1"><br>
   Powtórz hasło: <input type="password" name="password2"><br>
   
   <input type="submit" name="submit" value="Rejestruj!">
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
<p><a href="registration.php">Rejestruj</a><p>
<p><a href="index.php">Zaloguj</a><p>
</body>
</html>