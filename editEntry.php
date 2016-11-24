<?php
session_start(); 
//Sprawdzam czy użytkownik jest zalogowany.
if(!isset($_SESSION['user']))
{
$_SESSION['error']="Brak użytkownika";
unset($_SESSION['user']);
header('Location: index.php');

}

$msg_id=$_SESSION['msg_id'];

unset($_SESSION['msg_id']);


$link = mysql_connect("localhost");
$flag = mysql_select_db("test_sb");

if(!$link || !$flag)
{
 echo("brak bazy");

 return false;
}

$messageIns=$_GET["messageIns"];

//Sprawdzam czy wiadomość jest pusta i aktualizuję rekord w tabeli.
if(!empty($messageIns))
{
$query1 = "UPDATE message SET text_msg = '".$messageIns."', mod_time = NOW() WHERE message_id='".$msg_id."' ORDER BY mod_time"; 
$result1 = mysql_query($query1);

if (!($result1))
{
$_SESSION['error']="Problem z baza danych 1";
mysql_close($link);
header('Location: readEdit.php');

return false;
}
else
{
   // Sukces.
   $_SESSION['error']="Zmodyfikowano wiadomość";
   mysql_close($link);
   header('Location: readEdit.php');

}
}
else
{
$_SESSION['error']="Pusta wiadomość";
mysql_close($link);
header('Location: readEdit.php');
}
?>