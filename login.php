<?php session_start(); 
// Nie czyta właściwej strefy czasowej. Nie wiem dlaczego.
date_default_timezone_set("Europe/Warsaw");

function ifDateDif ($lastFailedLogin, $blockMultiplier)
{ 
    //ustawiam aktualny czas ręcznie -9 hours
	$curDate = date('Y-m-d H:i:s', strtotime('-9 hours'));
	$timeDif = strtotime($curDate) - strtotime($lastFailedLogin);
	
	$blockPeriod = ($blockMultiplier * 30);
	
	if ($blockPeriod>$timeDif)
	{
		return true;
	}
	else
	{
		return false;
	}
}

if(!isset($_SESSION['user']))
{
   unset($_SESSION['user']);
}
//Gety z formularza
@$pass = $_GET["password"];
@$user = $_GET["username"];

if(empty($user)||empty($pass))
{
$_SESSION['error']="Podano puste pole";
 header('Location: index.php');
 
 return false;
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
// Zapytanie o dane do wstępnego uwierzytelnienia.
$query = "SELECT count(*), last_login, last_failed_login, no_allowed_fails, no_fails FROM users WHERE user_id = '".$user."'";
$result = mysql_query($query);
if (!$result)
{
$_SESSION['error']="Podano nieprawidłowe dane";
header('Location: index.php');
mysql_close($link);
return false;
}

$rows = mysql_fetch_array($result); 

//Sprawdzam czy w ogóle w bazie znaleziono rekord.
if($rows[0]==0)
{
    $fake_count="SELECT Count(*) FROM non_existent_users WHERE fake_user='".$user."'";
	$fake_count_query=mysql_query($fake_count);

	$fake_row=mysql_fetch_array($fake_count_query);

if($fake_row[0]==0)
{
    
	$fake_query_insert = "INSERT INTO non_existent_users (fake_user, last_login, no_allowed_fails, no_fails) VALUES ('".$user."', NOW(), '".rand(3, 10)."', '1')";
	$fake_result = mysql_query($fake_query_insert);
}
else
{
    $fake_query_select = "SELECT last_login, no_allowed_fails, no_fails FROM non_existent_users WHERE fake_user='".$user."'";
	$fake_result_select = mysql_query($fake_query_select);
	
	$fake_rows=mysql_fetch_array($fake_result_select);
	
	$fake_query_update = "UPDATE non_existent_users SET last_login=NOW(), no_fails=no_fails+1 WHERE fake_user='".$user."'";
	$fake_result_update = mysql_query($fake_query_update);
	
	//if (ifDateDif ($rows['last_failed_login'], $rows['no_fails']))
	if(($fake_rows['no_allowed_fails']!=0)&&($fake_rows['no_allowed_fails']<=$fake_rows['no_fails']))
	{
	   if(ifDateDif ($fake_rows['last_login'], $fake_rows['no_fails']))
	   {
			mysql_close($link);
			//Kasowanie zapamiętanej maski.
			unset($_SESSION['mask_8']);
			$_SESSION['error']="Przekroczono limit błędnych logowań. Proszę spróbować później";
			header('Location: index.php');
			return false;
	   }
	   else
	   {
	       $fake_query_update = "UPDATE non_existent_users SET last_login=NOW(), no_fails='0' WHERE fake_user='".$user."'";
	       $fake_result_update = mysql_query($fake_query_update);
	   }
	}
	
}

mysql_close($link);
$_SESSION['error']="Podano nieprawidłowe dane";
header('Location: index.php');
return false;
}
//if (!ifDateDif ($rows['last_failed_login'], $rows['no_fails']))
//
//else
//Sprawdzenie limitu logowań.
if(($rows['no_allowed_fails']!=0)&&($rows['no_allowed_fails']<=$rows['no_fails'])&&(ifDateDif ($rows['last_failed_login'], $rows['no_fails'])))
{
  
  

  if (ifDateDif ($rows['last_failed_login'], $rows['no_fails']))
  {
     //Traktuje logowanie na zablokowane konto jako nieudaną próbę logowania. W ten sposób hacker lub użytkownik
	 //który cały czas będzie próbował się zalogować nie dostanie się na stronę.
     $queryUpdate = "UPDATE users SET last_failed_login=NOW(), no_fails=no_fails+1 WHERE user_id = '".$user."'";
     $resultUpdate = mysql_query($queryUpdate);
     mysql_close($link);
	 //Kasowanie zapamiętanej maski.
	 unset($_SESSION['mask_8']);
     $_SESSION['error']="Przekroczono limit błędnych logowań. Proszę spróbować później";
     header('Location: index.php');
     return false;
  }
  else
  {
     //W sytuacji gdy okres blokady minie znoszę blokadę.
	 $queryUpdate = "UPDATE users SET no_fails='0' WHERE user_id = '".$user."'";
     $resultUpdate = mysql_query($queryUpdate);
  }
  
}

/*
//Zapytanie i sprawdzenie. 
$query = "SELECT password_hash, salt FROM users WHERE user_id = '".$user."'";
$result = mysql_query($query);
if (!$result)
{
$_SESSION['error']="Podano nieprawidłowe dane";

 header('Location: index.php');
mysql_close($link);
return false;
}
//Odczytanie rekordów z tabeli
$row = mysql_fetch_row($result); 

//Sprawdzam czy w ogóle w bazie znaleziono rekord.
if (!$row)
{
echo("puste zapytanie");
// Wstawiam login użytkownika, który nie istnieje.

mysql_close($link);
$_SESSION['error']="Podano nieprawidłowe dane";
header('Location: index.php');
return false;
}*/



//Zapytanie o fragment hasła i sól. 

//echo "przekazana maska: ".$_SESSION["mask_8"];
//return false;

$query = "SELECT pass_hash, pass_salt FROM hashed_passes WHERE mask = '".$_SESSION["mask_8"]."'";
$result = mysql_query($query);
if (!$result)
{
$_SESSION['error']="Zła maska";

 header('Location: index.php');
mysql_close($link);
return false;
}
//Odczytanie rekordów z tabeli
$row = mysql_fetch_row($result); 

//Sprawdzam czy w ogóle w bazie znaleziono rekord.
if (!$row)
{
echo("puste zapytanie");
// Wstawiam login użytkownika, który nie istnieje.

mysql_close($link);
$_SESSION['error']="Podano nieprawidłowe dane";
header('Location: index.php');
return false;
}

//
$databaseHash=$row[0];
$salt=$row[1];
$pw_hash_to_check = sha1($salt.$pass);



//
/*echo "retrieved database pass: ".$databaseHash."<br>"; 
echo "database salt: ".$salt."<br>";
echo "provided pass, salted: ".$pw_hash_to_check."<br>";

return false;*/


//Sprawdzenie poprawności hasła
if ($databaseHash!=$pw_hash_to_check)
{
 $_SESSION['error']="Podano nieprawidłowe dane";
 //Aktualizacja informacji o nieudanym logowaniu.
 $queryUpdate = "UPDATE users SET last_failed_login=NOW(), no_fails=no_fails+1 WHERE user_id = '".$user."'";
 $resultUpdate = mysql_query($queryUpdate);

   if (!$resultUpdate)
   {
      $_SESSION['error']="Błąd bazy danych";
   }
   
 mysql_close($link);
 header('Location: index.php');
 return false;
}
else
{
//Szybki update ostatniego logowania.
$insertQuery="UPDATE users SET last_login=NOW(), no_fails='0', no_fails_display=".$rows['no_fails']." WHERE user_id = '".$user."'";
$insertResult = mysql_query($insertQuery);

//kasowanie zapamiętanej maski.
unset($_SESSION['mask_8']);

if (!$insertResult)
{
$_SESSION['error']="Błąd bazy 2";

mysql_close($link);
header('Location: index.php');

return false;
}


 $_SESSION['user']=$user;
 mysql_close($link);
 header('Location: success.php');
}

?>