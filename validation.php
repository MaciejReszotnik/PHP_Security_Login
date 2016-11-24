<?php
//Otwiera sesję - konieczne do przechowywanie zmiennych globalnych między stronami.
session_start(); 
if(empty($_GET["username"]))
{
$_SESSION['error']="Podano puste pole";
 header('Location: index.php');
 
 return false;
}


?>
<html>
<head>
<title>Logowanie, cz. 2</title>
</head>
<body>
  <h2>Logowanie, cz. 2</h2>
  <form name="login" method="get" action="login.php">
  
   <?php 
$link = mysql_connect("localhost");
$flag = mysql_select_db("test_sb");


@$user = $_GET["username"];
/*if (!isset($_SESSION["user"]))
{

@$user = $_GET["username"];
$_SESSION["user"]=$user;

}
else
{
$user = $_SESSION["user"];
}*/

$query = "SELECT count(*) FROM users WHERE user_id = '".$user."'";
$result = mysql_query($query);

$rows = mysql_fetch_array($result); 

// jeśli nie znaleziono takiego użytkownika... udajemy, że znaleziono :P
if($rows[0]==0)
{

$fakeMask="";
$fakeLength=rand(5, 8);
$fakeWholeArray = range(1, 16);
$fakeArray = array();
shuffle($fakeWholeArray);


// Sprawdzenie czy sesje zawiera wcześniejszą maskę.
if (isset($_SESSION['mask_8']))
{
   $fakeArray=unserialize($_SESSION['mask_8']);
}
else
{
for($i=0;$i<$fakeLength;$i++)
{
   $fakeArray[$i]=$fakeWholeArray[$i];
}
}

sort($fakeArray);


for($i=0;$i<count($fakeArray);$i++)
{

   $fakeMask = $fakeMask.", ".$fakeArray[$i];

}

$fakeMask = substr($fakeMask, 1);
echo "<span><b>Podaj znaki z hasła odpowiadające liczbom: ".$fakeMask."</b></span><br>";

$_SESSION["mask_8"]=serialize($fakeArray);

}
else
{
   $randFlag=rand(0,9);
   $trueMask = "";
   
   //echo $randFlag;
   
   //return false;
   
   $query = "SELECT mask FROM hashed_passes WHERE user_id = '".$user."' order by pass_id LIMIT ".$randFlag.", 1";
   $result = mysql_query($query);
   
   $trueRow=mysql_fetch_row($result);
   
   if (!$result)
  {
     echo mysql_error();
  }   
   //echo "mask value: ".$trueRow[0]."<br>";
   
   if(!isset($_SESSION['mask_8']))
   {
   
      $passArray=$trueRow[0];
      $trueArray=unserialize($trueRow[0]);
   }
   else
   {
      $passArray=$_SESSION['mask_8'];
      $trueArray=unserialize($_SESSION['mask_8']);
   }
   
   //echo "all chars together value: ";
   foreach($trueArray as $trueCharacter)
   {
      $trueCharacter=$trueCharacter+1;
      $trueMask = $trueMask.", ".$trueCharacter;
	  
      //echo "".$trueCharacter.", ";
   }
   $_SESSION["mask_8"]=$passArray;
   $trueMask = substr($trueMask, 1);
   echo "<span><b>Podaj znaki z hasła odpowiadające liczbom: ".$trueMask."</b></span><br>";
   
}
   echo "mask contents: ".$_SESSION["mask_8"];
   ?>
   
   <br>
   
   Użytkownik: <label><?php echo "".$_GET["username"]; ?></label><input type="hidden" value="<?php echo "".$_GET["username"]; ?>" name="username">
   Hasło: <input type="text" name="password"><br>
   
   <input type="submit" name="submit" value="Login!">
  </form>
  <br>
  <br>
  
  <?php
 //Sprawdza czy sesja istnieje i wyświetla komunikat.
if (isset($_SESSION['error']))
{
   echo " ".$_SESSION['error'];
   unset($_SESSION['error']);
}

?>
<br>
<p><a href="registration.php">Rejestruj</a><p>
</body>
</html>