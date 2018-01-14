<?php
$failure="";
if(isset($_POST['cancel']))
{
header("Location:index.php");
return;
  }
if(isset($_POST['who'])){
  $salt = 'XyZzy12*_';
  $stored_hash = '1a52e17fa899cf40fb04cfc42e6352f1';
function check($salt,$stored_hash)
{ $newpass=$salt.$_POST['pass'];
  $code=hash("md5",$newpass);
  $i=0;
  $len=strlen($code);
  while($code[$i]&&$i<$len)
  {if($code[$i]!=$stored_hash[$i])
  {return 0;}
  $i++;
    }
    return 1;
}

if(strlen($_POST['who'])<1||strlen($_POST['pass'])<1)
{ $failure="User name and password are required";}
elseif(!check($salt,$stored_hash))
{$failure="Incorrect Password";}
else {
  header("Location:game.php?who=".$_POST['who']);
  return;
}
}
 ?>


<title>Pratyush Mishra</title>
<h1>Please Log In</h1>
<p class="error"><?=$failure?></p>
<form method="post">
<label for="who">User Name</label>
<input type="text" id="A" name="who"/><br>
<label for="pass">Password</label>
<input type="text" id="B" name="pass"/>
<br>
<input type="submit" value="Log In"/>
<input type="submit" name="cancel" value="Cancel"/>
</form>
<style>
body{font-size: 1.2em;}
#A {margin-bottom: 10px;}
#B {margin-left: 10px;
margin-bottom: 10px;}
h1{color: grey;
font-family: "Arial";}
.error{color:red;
background-color: #f0fff0;}
</style>
