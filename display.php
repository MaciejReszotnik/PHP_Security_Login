<?php
session_start(); 
if(!isset($_SESSION['user']))
{
$_SESSION['error']="Brak użytkownika";
unset($_SESSION['user']);
header('Location: index.php');

}

@$drop = $_GET["msgDrop"];

?>

<html>
<head>
<title>Witaj!</title>
</head>
<body>
  <h2><?php echo "Witaj ".$_SESSION['user']."!"; ?></h2>
  <form name="readMsg" method="get" action="display.php">
  <h3>Wyświetl wpis</h3>
  
  <select name="msgDrop">
   <?php

       $link = mysql_connect("localhost");
       $flag = mysql_select_db("test_sb");
	   if(!$link || !$flag)
       {
          echo("brak bazy");

          return false;
       }
	   
	   
       $query="SELECT message.message_id, message.text_msg FROM allowed_messages INNER JOIN message ON allowed_messages.message_id=message.message_id WHERE allowed_messages.user_id = '".$_SESSION['user']."' ORDER BY message.mod_time";
       $result = mysql_query($query);
	   if (!$result)
       {
          $_SESSION['error']="Zapytanie nie powiodło się";
          header('Location: read.php');
          mysql_close($link);
          return false;
       }
	   
	   while($row = mysql_fetch_array($result))
	   {
	      $msg = explode(" ", $row['text_msg']);
          echo "<option value='".$row['message_id']."'>" . $msg[0]." ".$msg[1]."... "."</option>";
	   }
	   mysql_close($link);
	       

?>
    </select>
   
   <input type="submit" name="submit" value="Wyświetl!">
  </form>
  

  <h3>Zawartość wpisu:</h3>
    <p>
<?php 
	      $link = mysql_connect("localhost");
          $flag = mysql_select_db("test_sb");
	      if(!$link || !$flag)
          {
             echo("brak bazy");

             return false;
          }
		  @$drop = $_GET["msgDrop"];
		  $query="SELECT text_msg FROM message WHERE message_id = '".$drop."'";
          $result = mysql_query($query);
	      if (!$result)
          {
             echo "Zapytanie nie powiodło się";
             mysql_close($link);
             return false;
          }
		  $row=mysql_fetch_row($result);
		  echo "".$row[0];
		  
		  mysql_close($link);
		  $_SESSION['msg_id']="".$_GET["msgDrop"];
	   
	   ?>
    </p>
 
   <br>

  
  <br>
  <br>
  <a href="success.php">Dodaj nowy wpis</a>
  <a href="read.php">Wyświetl wiadomość</a>
  <a href="readEdit.php">Modyfikuj</a>
  <a href="remove.php">Usuń wpis</a>
  <a href="grantRights.php">Nadaj uprawnienia</a>
  <a href="logOut.php">Wyloguj</a>
  <?php
if (isset($_SESSION['error']))
{
   echo " ".$_SESSION['error'];
   unset($_SESSION['error']);
}

?>
</body>
</html>