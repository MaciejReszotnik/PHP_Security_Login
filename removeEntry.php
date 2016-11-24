<?php
session_start(); 
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
	   
	   @$rMsg = $_GET['msgDrop'];
	   
       $query1="DELETE FROM allowed_messages WHERE message_id='".$rMsg."'";
       $result1 = mysql_query($query1);
	  
	   
	   if (!$result1)
       {
          $_SESSION['error']="Zapytanie 1 nie powiodło się";
		  mysql_close($link);
          header('Location: remove.php');
          
          return false;
       }
	   
	   $query2="DELETE FROM message WHERE message_id='".$rMsg."'";
       $result2 = mysql_query($query2);
	   
	   if (!$result2)
       {
          $_SESSION['error']="Zapytanie 2 nie powiodło się";
		  mysql_close($link);
          header('Location: remove.php');
          
          return false;
       }
	   
	   $_SESSION['error']="Usunięto wiadomość";
	   mysql_close($link);
       header('Location: remove.php');

?>