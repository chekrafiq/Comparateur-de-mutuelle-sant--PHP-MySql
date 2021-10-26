<?php

$l_sql = "SELECT MIN(idvisitor) AS min FROM $table_visitor WHERE idvisitor > '$p_idvisitor'";
$c_db->query($l_sql);
if ($c_db->numrows > 0)
{
  $l_next = $c_db->result(0,"min");
}
else
{
  $l_next = 0;
}

$l_sql = "SELECT MAX(idvisitor) AS max FROM $table_visitor WHERE idvisitor < '$p_idvisitor'";
$c_db->query($l_sql);
if ($c_db->numrows > 0)
{
  $l_prev = $c_db->result(0,"max");
}
else
{
  $l_prev = 0;
}

if (!isset($p_idclient))
{
  $l_sql = "SELECT idclient FROM $table_visitor WHERE idvisitor = '$p_idvisitor'";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    $p_idclient = $c_db->result(0,"idclient");
  }
}


if ($p_idclient > 0)
{
  $l_sql = "SELECT V.*, C.*, Z.* FROM $table_visitor AS V, $table_client AS C, $table_zone as Z WHERE V.idvisitor = '$p_idvisitor' AND C.idclient = '$p_idclient' AND C.idportzone = Z.id_portzone";
}
else
{
  $l_sql = "SELECT * FROM $table_visitor WHERE idvisitor = '$p_idvisitor'";
}
$c_db->query($l_sql);
if (!($c_db->numrows > 0))
{
  include("sub/list.inc.php3");
  return 0;
}
$visitor = $c_db->object_result();

?>

<table width="98%">
<tr>
 <td class="main" width="65%" valign="top" align="center">

 <table align="center" width="98%"> 
  <tr>
   <td align="left" class="color1" colspan="2">:: Visitor #<?=$visitor->idvisitor?></td>
  </tr> 
   <tr>
    <td align="right" valign="top" class="color2" width="25%">adresse IP &nbsp;</td> 
    <td class="color3"><?=$visitor->remoteaddr?></td>
   </tr>   
   <tr>
    <td align="right" valign="top" class="color2">serveur &nbsp;</td> 
    <td class="color3"><?=$visitor->remotehost?></td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2">origine &nbsp;</td> 
    <td class="color3"><?=$visitor->remotereferer?></td>
   </tr>
   <tr>
    <td align="right" valign="top" class="color2">email &nbsp;</td> 
    <td class="color3"><?php print("<a href=mailto:$visitor->email>$visitor->email</a>"); ?></td>
   </tr>
<!-- <tr>
    <td align="right" class="color2" valign="top">cookie &nbsp;</td> 
    <td class="color3">oui</td>
   </tr>
-->
   <tr>
    <td align="right" class="color2">FLASH &nbsp;</td> 
    <td class="color3"><?=$visitor->flash?></td>
   </tr> 
   <tr>
    <td align="right" class="color2" valign="top">système &nbsp;</td> 
    <td class="color3"><?="$visitor->os / $visitor->browser"?></td>
   </tr>
   <tr>
    <td align="right" class="color2">écran &nbsp;</td> 
    <td class="color3"><?=$visitor->screen?></td>
   </tr> 
<!--   
   <tr>
    <td align="right" class="color2">skin &nbsp;</td> 
    <td class="color3"><?=$visitor->skin?></td>
   </tr>
   <tr>
    <td align="right" class="color2">design &nbsp;</td> 
    <td class="color3"><?=$visitor->design?></td>
   </tr>
--> 
  </table> 

<br>
<form action"/_kernix_/modules/command/adm/index.php3" method="post">
 <input type="hidden" name="p_idvisitor" value="<?=$p_idvisitor?>">
 <input type="hidden" name="p_idclient"  value="<?=$visitor->idclient?>">
 <select name="p_visitoraction">
  <option value="session">-- voir ses visites --</option>
<!--  <option value="viewinfos">-- voir les infos --</option> -->
 </select>
 &nbsp; <input type="submit" value="exécuter" class="button"><br><br>
</form>

<?php

if ($l_prev >= 1)
{
print("<a href=$PHP_SELF?p_visitoraction=view&p_idvisitor=$l_prev class=truelink>&#171;</a>");
}
print(" | ");
if ($l_next >= 1)
{
print("<a href=$PHP_SELF?p_visitoraction=view&p_idvisitor=$l_next class=truelink>&#187;</a>");
}
print("<br><br>");

?>


 </td>
 <td class="main" valign="top" align="center">
<?php if ($visitor->idclient > 0): ?>
<table width=99% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
 <tr>
  <td align=left class=color2> 
   &nbsp; [<?=$visitor->idclient?>] <?=$visitor->firstname?> <?=$visitor->lastname?> 
   <a href="<?php print("/$g_modulespath/client/adm/?p_clientaction=view&p_idclient=$visitor->idclient"); ?>" class="whitelink">&#187;</a>
  </td>
 </tr>
 <tr>
  <td align=left class=color3> 
   <?php print("&nbsp; $visitor->address"); ?><br>
   <?php print("&nbsp; $visitor->zipcode"); ?>, <?=$visitor->town?><br>
   <?php print("&nbsp; $visitor->zone_name"); ?><br>
   <?php print("&nbsp; société : $visitor->company"); ?></a><br>
   <?php print("&nbsp; email : <a href=mailto:$visitor->email1>$visitor->email1"); ?></a><br>
   <?php print("&nbsp; tel : $visitor->phone"); ?><br>
  </td>
 </tr>
 <tr>
  <td align=center class=list> 
   <?php print("- nb achats : $visitor->nbpurchase -"); ?>
  </td>
 </tr>
</table>
<br>
<?php endif; ?>

<?php

$l_sql = "SELECT DISTINCT(email) FROM $table_email WHERE idvisitor = $p_idvisitor";
$c_db->query($l_sql);
if (($n = $c_db->numrows) > 0): 
?>

<table width=99% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
 <tr>
  <td align=center class=color2> 
   &#187; autres emails &#171;
  </td>
 </tr>
 <tr>
  <td align=center class=list> 
<?php 
$i = 0;
for ($i = 0; $i < $n; $i++)
{
  $l_email = $c_db->result($i,"email");
  print("- <a href=mailto:$l_email>$l_email</a> -<br>");
  $i++;
}
?>
  </td>
 </tr>
</table>
<br>

<?php 

endif; 
$l_sql = "SELECT idlog FROM $table_log WHERE idvisitor = $visitor->idvisitor";
$c_db->query($l_sql);
$l_nbpages = $c_db->numrows;

?>

<table width="99%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
 <tr>
  <td align="center" class="color2"> 
   &#187; <?php print("$visitor->nbrvis vis, $l_nbpages pages"); ?> &#171;
  </td>
 </tr>
 <tr>
  <td align="center" class="list"> 
<?php 
$l_sql = "SELECT date FROM $table_log WHERE idvisitor = '$visitor->idvisitor' AND newvis = 1 ORDER BY date DESC LIMIT 0,20";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  print("- " . show_datetime($obj->date) . " -<br>"); 
}
?>
  </td>
 </tr>
</table>

 </td>
</tr>
</table>

<br>

<?php show_hr(); ?>

<br>

<table width="99%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
 <tr>
  <td align=left class=color2> &#187; première visite : <?php print(show_datetime($visitor->firstvis)); ?> </td>
 </tr>
 <tr>
  <td align=left class=color3>
<?php 
print("&nbsp;" . $visitor->urlfromfirstvis); 
if (!ereg("^::",$visitor->urlfromfirstvis) && $visitor->urlfromfirstvis) print(" <a href=\"$visitor->urlfromfirstvis\" target=_blank><font class=orange>&#187;</font></a>\n");
?> 
  </td>
 </tr>
 <tr>
  <td align=left class=color2>
   &#187; dernière visite : <?php print(show_datetime($visitor->lastvis)); ?>
  </td>
 </tr>
 <tr>
  <td align=left class=color3>
<?php 
print("&nbsp;" . $visitor->urlfromlastvis); 
if (!ereg("^::",$visitor->urlfromlastvis) && $visitor->urlfromlastvis) print(" <a href=\"$visitor->urlfromlastvis\" target=_blank><font class=orange>&#187;</font></a>\n");
?> 
  </td>
 </tr>
</table> 

<br>

<?php
show_back();
?>






