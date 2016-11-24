<?php
session_start(); 
date_default_timezone_set('Europe/Warsaw');
//Sprawdzam czy użytkownik jest zalogowany - jeśli nie, przerzucam go do strony logowania.
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
  
  <?php 
  date_default_timezone_set("Europe/Warsaw");
  function ifDateDif ($lastFailedLogin, $blockMultiplier)
{
	$curDate = date('Y-m-d H:i:s', strtotime('-9 hours'));
	$timeDif = strtotime($curDate) - strtotime($lastFailedLogin);
	
	$blockPeriod = ($blockMultiplier * 30);
	
	echo "".$timeDif."<br>";
	echo "".$blockPeriod;
}
  //Ustanowienie połączenia z bazą.
     $link = mysql_connect("localhost");
     $flag = mysql_select_db("test_sb");
	 
	 //Czy się udało?
      if(!$link || !$flag)
      {
         echo("brak bazy");

         return false;
      }
	  
		$query = "SELECT last_login, last_failed_login, no_fails, no_fails_display FROM users WHERE user_id = '".$_SESSION['user']."'";
		$result = mysql_query($query);
		if (!$result)
		{
			//$_SESSION['error']="Błąd sprawdzania";
			//header('Location: index.php');
			echo "Błąd sprawdzania";
			mysql_close($link);
			return false;
		}
		
		$row=mysql_fetch_array($result);
	 
     echo "<h4>Data ostatniego logowania: <span>".$row['last_login']."</span></h4>";
	 echo "<h4>Data ostatniego nieudanego logowania: <span>".$row['last_failed_login']."</span></h4>";
	 $curDate = date('Y-m-d H:i:s', strtotime('-9 hours'));
	 echo "<h4>Teraz: <span>".$curDate."</span></h4>";
	 $timeDif=strtotime($curDate) - strtotime($row['last_failed_login']);
	 echo "<h4>Czas od ostatniego nieudanego logowania: <span>".$timeDif."</span></h4>";
	 echo "<h4>Liczba nieudanych logowań od ostatniego nieudanego: <span>".$row['no_fails_display']."</span></h4>";

	 ifDateDif ($row['last_failed_login'], 3);
	 
	 $query = "UPDATE users SET no_fails_display='0' WHERE user_id = '".$_SESSION['user']."'";
     $result = mysql_query($query);
	 
	 mysql_close($link);
	 
  ?>
  
  <form name="newEntry" method="get" action="newEntry.php">
  <h3>Dodaj nowy wpis</h3>
<textarea rows="10" cols="30" name="messageIns">
</textarea>

   
   <input type="submit" name="submit" value="Dodaj wpis!">
  </form>
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