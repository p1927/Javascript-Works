<h1>Rock Paper Scissors</h1>
<title>Pratyush Mishra</title>
<style>
body{font-size: 1.2em;}
h1{color: grey;
font-family: "Arial";}
p{color:black;
background-color: #f0f0ff;}
</style>
<?php
if(!isset($_GET['who'])||strlen($_GET['who'])<1)
{die("<p>Name parameter missing</p>");}

if(isset($_POST['Logout']))
{header('Location:index.php');
return;}
$panel="Please select a strategy and play!";
$a=rand(0,2);
function play($a,$b){


    if ($b==$a){$result="Tie";}
    elseif (($b-$a+3)%3==1){$result="You Win";}
    else {$result="You Lose";}

return $result;

}
function def($x){
  switch($x){
    case 0: return "Rock";break;
    case 1: return "Paper";break;
    case 2: return "Scissors";break;
  };
}

if (isset($_POST['human'])&&$_POST['human']<4)
{ $result=play($a,$_POST['human']) ;
  $panel= "Your Play=".def($_POST['human'])." Computer Play=".def($a)." Result=".$result;}

  if (isset($_POST['human'])&&$_POST['human']==4)
  { $panel="";
    for($a=0;$a<3;$a++)
    {
for($b=0;$b<3;$b++)
      {

        $result=play($a,$b) ;
        $panel.= "Your Play=".def($b)." Computer Play=".def($a)." Result=".$result."<br>";

      }

    }
  }


?>
<div>
  Welcome : <?=$_GET['who'];?><br>
  <form method="post">
    <select  name="human">
      <option value="5">Select</option>
      <option value="0">Rock</option>
      <option value="1">Paper</option>
      <option value="2">Scissor</option>
      <option value="4">Test</option>
    </select>
    <input type="submit" value="Play"/>
    <input type="submit" name="Logout" value="Logout"/>
  </form>
  <p><?=$panel ?></p>


    </div>
