<?php
session_start(); 
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

@$user=$_GET["userDrop"];
@$messageId=$_GET["msgDrop"];

$query1 = "SELECT COUNT(*) FROM allowed_messages WHERE user_id='".$user."' AND message_id='".$messageId."' AND owner='0'"; 
$result1 = mysql_query($query1);
$row1=mysql_fetch_row($result1); 

if ($row1[0]=="0")
{
$_SESSION['error']="Użytkownik nie ma uprawnień, więc ich nie usunięto";
mysql_close($link);
header('Location: grantRights.php');
          
return false;

}


$query2 = "DELETE FROM allowed_messages WHERE user_id ='".$user."' AND message_id='".$messageId."' AND owner='0'";
$result2 = mysql_query($query2);

if (!$result2)
{
$_SESSION['error']="Zapytanie 2 nie powiodło się";
mysql_close($link);
header('Location: grantRights.php');
          
return false;
}

$_SESSION['error']="Usunięto uprawnienia";
mysql_close($link);
header('Location: grantRights.php');
	   



?>