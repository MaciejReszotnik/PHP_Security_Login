<?php
session_start(); 
//Sprawdzam czy użytkownik jest zalogowany.
if(!isset($_SESSION['user']))
{
$_SESSION['error']="Brak użytkownika";
unset($_SESSION['user']);
header('Location: index.php');

}



$link = mysql_connect("localhost");
$flag = mysql_select_db("test_sb");

if(!$link || !$flag)
{
 echo("brak bazy");

 return false;
}

@$noFails=$_GET['noFails'];


  $query1 = "UPDATE users SET no_allowed_fails='".$noFails."' WHERE user_id='".$_SESSION['user']."'"; 
  $result1 = mysql_query($query1);
  if (!($result1))
       {
           $_SESSION['error']="Problem z baza danych 1";
           mysql_close($link);
           header('Location: settings.php');

           return false;
       }
if($noFails!="0")
{  	   
   $_SESSION['error']="Operacja powiodła się. <br> Liczba dozwolonych, nieudanych logowań przed blokadą konta: ".$noFails."";
   mysql_close($link);
   header('Location: settings.php');
}
else
{
   $_SESSION['error']="Blokada została usunięta";
   mysql_close($link);
   header('Location: settings.php');
}

?>