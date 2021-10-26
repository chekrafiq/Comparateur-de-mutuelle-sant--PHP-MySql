<?php

include ("_kernix_/var.inc.php3");

$table_error = "logerror";

$REMOTE_HOST = gethostbyaddr($REMOTE_ADDR);

include("$g_modulespath/cookie/sub/site.inc.php3");

if (!ereg("robot.txt",$SCRIPT_URI))
{
  $l_sql = "INSERT INTO $table_error (numerror,idvisitor,url,remotehost,remoteaddr,date) values ('$p_code','$g_idvisitor','$SCRIPT_URI','$REMOTE_HOST','$REMOTE_ADDR','$l_date')";
 $c_db->query($l_sql);
}

?>

<html>

<head>
<title>KerniX ERROR</title>
 <LINK HREF="<?=$g_skinpath?>/default/error.css" REL="stylesheet" TYPE="text/css">
</head>

<body>

<center>

<br><br>

<table width="350" cellspacing="0" cellpadding="0" align="center" border="0">

 <tr>
  <td align="middle" height="124"><img src="/pictures/error/error_top.gif"><td>
 </tr>
 
 <tr>
  <td align="middle" class="main" height="250">
une erreur <small class=yellow><?=$p_code?></small> est survenue sur le site<br>
<?php
print("<H1><a href=$g_urlroot class=bigwhite>$g_sitename</a></H1>");
?>
<br>merci de <a href="mailto:error@kernix.com?subject=erreur <?=$p_code?> sur le site <?php print("$g_sitename [$l_date]"); ?>&Cc=<?php print("contact@$g_domainname"); ?>" class="white">nous</a> contacter <br>
pour nous permettre de résoudre le 
<br>problème dans les plus brefs délais.<br><br>
( <font style="font-weight: normal">précisez la page posant problème,<br> celle où vous êtiez précédemment<br> et toute information susceptible<br> de nous aider</font> )
<br><br> 

  <td>
 </tr>
 
 <tr>
  <td align="middle" height="102"><img src="/pictures/error/error_bottom.gif"><td>
 </tr>

</table>

<br>

&copy; copyright 
&quot;<b><a href="http://www.kernix.com" target="ext" title="net solutions">KERNIX</a></b>&quot;

<br>

</center>

</body>
</html>
