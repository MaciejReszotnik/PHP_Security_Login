<?php

session_start(); 

//generator masek
function generateMask ($min, $max, $length)
{
   // tworzymy tablice o podanym zakresie.
   $allChars = range($min, $max);
   
   // tasujemy - zapewnia randomizację.
   shuffle($allChars);
   $maskArray=array();
   
   // przepisywanie fragmentu tablicy.
   for ($x=0; $x<$length; $x++)
   {
      $maskArray[$x]=$allChars[$x];
   }
   
   //sortowanie - aby otrzymać spójne fragmenty.
   sort($maskArray); 
   
   //serializowanie - aby móc zapisać jako varchar w bazie.
   $maskString=serialize($maskArray);
   
   return $maskString;

}

//test jednostkowy
/*
$mask=generateMask(0,16,9);

echo "generated serialized mask: ".$mask."<br><br>";

$maskAr = unserialize($mask);


foreach($maskAr as $maskUnit)
{
   echo "generated unserialized mask: ".$maskUnit."<br>";
}

return false;*/

require_once('recaptchalib.php');
  $privatekey = "6Lcz-PQSAAAAAIINBhlKXDA8n1jiNl6RQ8hcXpOt";
  $resp = recaptcha_check_answer ($privatekey,
                                $_SERVER["REMOTE_ADDR"],
                                $_POST["recaptcha_challenge_field"],
                                $_POST["recaptcha_response_field"]);

  if (!$resp->is_valid) {
    // What happens when the CAPTCHA was entered incorrectly
    die ("The reCAPTCHA wasn't entered correctly. Go back and try it again." .
         "(reCAPTCHA said: " . $resp->error . ")");
    }
	else{

if(!isset($_SESSION['user']))
{
   unset($_SESSION['user']);
}

@$user = $_SESSION["user"];
@$pass1 = $_POST["password1"];
@$pass2 = $_POST["password2"];

if(empty($user)||empty($pass1)||empty($pass2))
{
$_SESSION['error']="Podano puste pola";
 header('Location: changePassword.php');
 mysql_close($link);
 return false;
}

if($pass1!=$pass2)
{
$_SESSION['error']="Hasła różnią się";
 header('Location: changePassword.php');
 mysql_close($link);
 return false;
}

//rozbijanie hasla na pojedyncze znaki.
$brokenPass=str_split($pass1);

//liczenie znaków.
$brokenPassCount=count($brokenPass);

/*echo "l znaków: ".$brokenPassCount;
return false;*/

if($brokenPassCount<8)
{
 $_SESSION['error']="Hasło nie może mieć mniej niż 8 znaków";
 header('Location: changePassword.php');
 mysql_close($link);
 return false;
}
else if($brokenPassCount>16)
{
 $_SESSION['error']="Hasło nie może mieć więcej niż 16 znaków";
 header('Location: changePassword.php');
 mysql_close($link);
 return false;
}

//generowanie masek

$arrayOfMasks = array();

//polowa hasła zaokrąglona
$halfPassCount = ceil($brokenPassCount / 2);

//echo "$halfPassCount: ".$halfPassCount."<br>";

//minimalna długość maski.
$maskLength=5;

//tworzenie 10 zestawów masek
for($i=0;$i<10;$i++)
{
   // randomizowanie długości maski.
   if($halfPassCount>5)
   {
      $maskLength=rand(5,$halfPassCount);
   }
   
   //generowanie serialu maski.
   $arrayOfMasks[$i]=generateMask(0,$brokenPassCount-1,$maskLength);

}

//test - sprawdzanie czy maski są tworzone.
/*foreach($arrayOfMasks as $maskUnit)
{
   echo "generated serialized mask: ".$maskUnit."<br>";
}

return false;*/

$arrayOfPasses = array();
$Mask=array();
$passFragment="";

for($i=0;$i<count($arrayOfMasks);$i++)
{
   $Mask[$i]=unserialize($arrayOfMasks[$i]);
   
}

//echo "mask count : ".count($Mask)."<br>";
//return false;


// Tworzenie fragmentów haseł.
for ($i=0;$i<count($Mask);$i++){
$passFragment="";
foreach($Mask[$i] as $maskUnit)
{
   $passFragment=$passFragment.$brokenPass[$maskUnit];
  // echo "generated unserialized mask ".$i.": ".$maskUnit."<br>";
  // echo "current passFragment ".$i.": ".$passFragment."<br>";
}
$arrayOfPasses[$i]="".$passFragment;
//echo "<br>generated serialized mask: ".$arrayOfMasks[$i]."<br>";
//echo "FULL passFragment ".$i.": ".$arrayOfPasses[$i]."<br><br>";
}

//return false;


$link = mysql_connect("localhost");
$flag = mysql_select_db("test_sb");

if(!$link || !$flag)
{
 echo("brak bazy");
 mysql_close($link);

 return false;
}

/*$query = "SELECT COUNT(*) FROM users WHERE user_id = '".$user."'";
$result = mysql_query($query);

if (!$result)
{
$_SESSION['error']="Błąd bazy 1";

mysql_close($link);
header('Location: changePassword.php');

return false;
}

$row=mysql_fetch_row($result);

if ($row[0]!="0")
{
$_SESSION['error']="Podany użytkownik już istnieje";

mysql_close($link);
header('Location: changePassword.php');

return false;
}
*/
mysql_close($link);

//solenie i hashowanie nowego hasła
 $salt = uniqid(mt_rand(), true);
 $pw_hash = sha1($salt.$pass1);
 
 //$_SESSION['pw_hash']=$pw_hash;
 //$_SESSION['salt'] = $salt;
 //$_SESSION['unhashedPass'] = $pass1;
 
$link = mysql_connect("localhost");
$flag = mysql_select_db("test_sb");

$updateQuery="UPDATE users SET password_hash='".$pw_hash."', salt='".$salt."' WHERE user_id='".$user."'";
$updateResult = mysql_query($updateQuery);

if (!$updateResult)
{
   echo "Błąd aktualizacji hasła <br>";
   echo mysql_error();
   
   return false;
}

mysql_close($link);

$link = mysql_connect("localhost");
$flag = mysql_select_db("test_sb");
  
$deleteQuery="DELETE FROM hashed_passes WHERE user_id='".$user."'";
$deleteResult = mysql_query($deleteQuery);

if(!$deleteResult)
{
   echo "failed delete <br>";
   echo mysql_error();
   return false;
}

//aktualizowanie mini-haseł w bazie.
for($i=0; $i<count($arrayOfPasses);$i++)
{
  
  $passSalt = uniqid(mt_rand(), true);
  $passHash = sha1($passSalt.$arrayOfPasses[$i]);
  $insertPassQuery="INSERT INTO hashed_passes (pass_hash, pass_salt, mask, user_id) VALUES ('".$passHash."', '".$passSalt."', '".$arrayOfMasks[$i]."', '".$user."')";
  $insertPassResult = mysql_query($insertPassQuery);
  
  if (!$insertPassResult)
{
echo "failed at ".$i." try.<br>";
echo mysql_error();

return false;
}


}


if (!$updateResult)
{
$_SESSION['error']="Błąd bazy 2";

mysql_close($link);
header('Location: changePassword.php');

return false;
}

if (!$insertPassResult)
{
$_SESSION['error']="Błąd bazy 3 petla for";

mysql_close($link);
header('Location: changePassword.php');

return false;
}

$_SESSION['error']="Zmiana hasła zakończona pomyślnie";

mysql_close($link);
header('Location: changePassword.php');

}





?>