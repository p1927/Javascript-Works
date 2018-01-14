<head><title>Pratyush Mishra PHP</title></head>
<body>
<h1>MD5 Cracker</h1>


<p>This application takes an MD5 hash
of a two-character lower case string and
attempts to hash all two-character combinations
to determine the original two characters.</p>

<div style="font-size:15px; font-family:'calibri';">


Debug Output:
<br>
  <table>

<?php
$starttime = microtime(true);
$total=0;
function hashgen($value)
{
  $val=hash("MD5",$value);
  return $val;
}

if (isset($_GET['md5'])){$val=($_GET['md5']);
function comp($val)
{  $final=$val;
  $len=strlen($final);

for($i=0;$i<10000;$i++)
{
  $pin=strval($i);
  if (strlen($pin)==1){$pin="000".$pin;}
  elseif (strlen($pin)==2) {
    $pin="00".$pin;
  }
  elseif (strlen($pin)==3) {
    $pin="0".$pin;
  }
  else ;
  $trial=hashgen($pin);
if($i<16){ echo "<tr><td>".$trial."</td><td>".$pin."</td></tr>";}

  $len2=strlen($trial);
for($j=0;$j<$len&&$j<$len2;$j++)
{   if (($trial[$j]==$final[$j])&&($j==$len-1))
    {
$GLOBALS['total']=$i+1;
      return $pin;

    }
    elseif($trial[$j]!=$final[$j]){break;}
    else;

}
if($i==9999){ $GLOBALS['total']=10000;
  return "notfound";}


}
}
$pin=comp($val);
}


$endtime = microtime(true);
$timediff = $endtime - $starttime;
?>
</table>
Total Checks: <?=$total?><br>
Elapsed Time: <?=$timediff?>

</div>
<?php
if (isset($_GET['md5'])){
if ($pin=='notfound'){echo "<h1> PIN: Not Found</h1>";}
else {echo "<h2> PIN: ".$pin ."</h2>";};}; ?>

<form action="index.php" method="get">
<input type="text" width="100px" name="md5"/>
<input type="submit" value="Crack MD5"/>
</form>

</body>
