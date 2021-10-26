<?php

include ("_kernix_/var.inc.php3");

$table_error = "logerror";
$table_admsite        = "adm_site";
$table_admshop        = "adm_shop";

$l_sql = "SELECT * FROM $table_admsite, $table_admshop";
$c_db->query($l_sql);
$adm = $c_db->object_result();

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
<title>Erreur sur le site <?=$g_sitename?></title>
<style type="text/css">
BODY
{background-color:white; COLOR: #021B28; FONT-FAMILY: verdana; FONT-SIZE: 10px;}

.main
{color: black; FONT-FAMILY: verdana; FONT-SIZE: 10px; font-weight: bold;}

.yellow
{COLOR: #FFCF29; FONT-FAMILY: verdana; FONT-SIZE: 10px;}


A.white
{COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: underline;}
A.white:hover
{COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: underline;}
A.white:visited
{COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: underline;}
A.white:active
{COLOR: #FFCF29; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: none;}

A.bigwhite
{COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: x-large; TEXT-DECORATION: none;}
A.bigwhite:hover
{COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: x-large; TEXT-DECORATION: none;}
A.bigwhite:visited
{COLOR: black; FONT-FAMILY: verdana; FONT-SIZE: x-large; TEXT-DECORATION: none;}
A.bigwhite:active
{COLOR: #FFCF29; FONT-FAMILY: verdana; FONT-SIZE: x-large; TEXT-DECORATION: none;}

A
{COLOR: #021B28; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: underline;}
A:hover
{COLOR: #021B28; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: underline;}
A:visited
{COLOR: #021B28; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: underline;}
A:active
{COLOR: #FFCF29; FONT-FAMILY: verdana; FONT-SIZE: 10px; TEXT-DECORATION: none;}
</style>
</head>

<body>

<center>

<br><br>

<table width="350" cellspacing="0" cellpadding="0" align="center" border="0">

 <tr>
  <td align="middle" height="124" class=main>
Une erreur <small class=yellow><?=$p_code?></small> est survenue sur le site<br>
<?php
print("<H1><a href=$g_urlroot class=bigwhite>$g_sitename</a></H1>");
?>
<br>merci de <a href="mailto:<?=$adm->email?>?subject=erreur <?=$p_code?> sur le site <?php print("$g_sitename [$l_date]"); ?>" class="white">nous</a> contacter <br>
pour nous permettre de résoudre le 
<br>problème dans les plus brefs délais.<br><br>
( <font style="font-weight: normal">précisez la page posant problème,<br> celle où vous êtiez précédemment<br> et toute information susceptible<br> de nous aider</font> )

</td>
 </tr>
</table>

<br><br><br>

based on KWO &copy; copyright 
&quot;<b><a href="http://www.kernix.com" target="ext" title="net solutions">KERNIX</a></b>&quot;

<br>

</center>

</body>
</html>
