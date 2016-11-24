<?php
session_start(); 
//Sprawdzam czy użytkownik jest zalogowany - jeśli nie przerzucam go do strony logowania.
if(!isset($_SESSION['user']))
{
$_SESSION['error']="Brak użytkownika";
unset($_SESSION['user']);
header('Location: index.php');

}
echo "".$_SESSION['user']." is logged in";

$link = mysql_connect("localhost");
$flag = mysql_select_db("test_sb");

if(!$link || !$flag)
{
 echo("brak bazy");

 return false;
}
//pobranie wiadomości.
$messageIns=$_GET["messageIns"];

//Sprawdzenie wiadomości - czy pusta - i umieszczenie w bazie.
if(!empty($messageIns))
{
$query1 = "INSERT INTO message (text_msg, mod_time) VALUES ('".$messageIns."',NOW());"; 
$result1 = mysql_query($query1);

if (!($result1))
{
$_SESSION['error']="Problem z baza danych 1";
mysql_close($link);
header('Location: success.php');

return false;
}
else
{
   //Wyjmuję message_id żeby potem móc zapisać rekord w tabeli allowed_messages
   $query2 = "SELECT message_id FROM message WHERE text_msg = '".$messageIns."'";
   $result2 = mysql_query($query2);

   if (!($result2))
   {
   $_SESSION['error']="Problem z baza danych 2";
   mysql_close($link);
   header('Location: success.php');

   return false;
   }
   else
   {
       // Zapisuję rekord w tabeli.
       $row = mysql_fetch_row($result2); 
       $query3 = "INSERT INTO allowed_messages (user_id, message_id, owner) VALUES ('".$_SESSION['user']."','".$row[0]."', '1');"; 
       $result3 = mysql_query($query3);
	   if (!($result3))
       {
           $_SESSION['error']="Problem z baza danych 3";
           mysql_close($link);
           header('Location: success.php');

           return false;
       }
	   else
	      {

           $_SESSION['error']="Dodano wiadomość";
           mysql_close($link);
           header('Location: success.php');

       }

   }

}
}
else
{
$_SESSION['error']="Pusta wiadomość";
mysql_close($link);
header('Location: success.php');
}
?>