<?php
session_start(); 
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


  <form name="grantRights" method="get" action="grantRightsToEntry.php">
  <h3>Nadaj uprawnienia</h3>
  
  <h4>Wybierz wiadomość:</h4>
  
  <select name="msgDrop">
   <?php

       $link = mysql_connect("localhost");
       $flag = mysql_select_db("test_sb");
	   if(!$link || !$flag)
       {
          echo("brak bazy");

          return false;
       }
	   
	   
       $query="SELECT message.message_id, message.text_msg FROM allowed_messages INNER JOIN message ON allowed_messages.message_id=message.message_id WHERE allowed_messages.user_id = '".$_SESSION['user']."' AND allowed_messages.owner='1' ORDER BY message.mod_time";
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
	
	<br>
	<br>
	<h4>Wybierz użytkownika:</h4>
	<br>
	<select name="userDrop">
   <?php

       $link = mysql_connect("localhost");
       $flag = mysql_select_db("test_sb");
	   if(!$link || !$flag)
       {
          echo("brak bazy");

          return false;
       }
	   
	   
       $query="SELECT user_id FROM users ORDER BY user_id";
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
	      if($row['user_id']!=$_SESSION['user'])
		  {
             echo "<option value='".$row['user_id']."'>"."Użytkownik: ". $row['user_id']."</option>";
		  }
	   }
	   mysql_close($link);
	       

?>
    </select>
   
   <input type="submit" name="submit" value="Dodaj uprawnienia!">
  </form>
  <br>
  <form name="removeRights" method="get" action="removeRightsToEntry.php">
  <h3>Odbierz uprawnienia</h3>
  
  <h4>Wybierz wiadomość:</h4>
  
  <select name="msgDrop">
   <?php

       $link = mysql_connect("localhost");
       $flag = mysql_select_db("test_sb");
	   if(!$link || !$flag)
       {
          echo("brak bazy");

          return false;
       }
	   
	   
       $query="SELECT message.message_id, message.text_msg FROM allowed_messages INNER JOIN message ON allowed_messages.message_id=message.message_id WHERE allowed_messages.user_id = '".$_SESSION['user']."' AND allowed_messages.owner='1' ORDER BY message.mod_time";
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
	
	<br>
	<br>
	<h4>Wybierz użytkownika:</h4>
	<br>
	<select name="userDrop">
   <?php

       $link = mysql_connect("localhost");
       $flag = mysql_select_db("test_sb");
	   if(!$link || !$flag)
       {
          echo("brak bazy");

          return false;
       }
	   
	   
       $query="SELECT user_id FROM users ORDER BY user_id";
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
	      if($row['user_id']!=$_SESSION['user'])
		  {
             echo "<option value='".$row['user_id']."'>"."Użytkownik: ". $row['user_id']."</option>";
		  }
	   }
	   mysql_close($link);
	       

?>
    </select>
   
   <input type="submit" name="submit" value="Odbierz uprawnienia!">
  </form>
  <br>
  <?php
if (isset($_SESSION['error']))
{
   echo "".$_SESSION['error'];
   unset($_SESSION['error']);
}

?>
  <br>
  <a href="success.php">Dodaj nowy wpis</a>
  <a href="read.php">Wyświetl wiadomość</a>
  <a href="remove.php">Usuń wpis</a>
  <a href="grantRights.php">Nadaj uprawnienia</a>
  <a href="logOut.php">Wyloguj</a>
  
</body>
</html>