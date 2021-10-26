<?php

$table_visitor = "visitor";
$table_log     = "log";

$l_sql = "SELECT idlog FROM $table_log WHERE newvis = 1";
$c_db->query($l_sql);
$l_nbvisit = $c_db->numrows;

if ($l_nbvisit == 0)
{
  show_response("aucune visite.");
  return 0;
}

$l_sql = "SELECT idvisitor FROM $table_visitor WHERE cookie = '1'";
$c_db->query($l_sql);
$l_nbvisitor = $c_db->numrows;

$l_sql = "SELECT idvisitor FROM $table_visitor WHERE flash = '1' AND cookie = '1'";
$c_db->query($l_sql);
$l_nbflash = $c_db->numrows;
$l_flashrate = ($l_nbflash / $l_nbvisitor) * 100;

$l_sql = "SELECT idvisitor FROM $table_visitor WHERE nbrvis > 5 AND cookie = '1'";
$c_db->query($l_sql);
$l_nboften = $c_db->numrows;

?>

<table width=80% align=center border=0>
 <tr>
  <td align=left class=color1 colspan=2>
   :: depuis la création du site
  </td> 
 </tr>
 <tr>
  <td class=color2 width=70% align=right>nombre de visites
  </td>
  <td class=color3 align=left>&nbsp;<?php print("$l_nbvisit"); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de visiteurs
  </td>
  <td class=color3 align=left>&nbsp;<?php print("$l_nbvisitor"); ?> <a href="<?php print("/$g_modulespath/visitor/adm");?>" >&#187;</a>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de visiteurs étant venus<br>plus de 5 fois
  </td>
  <td class=color3 align=left>&nbsp;<?php print("<a href=$urlroot/_kernix_/modules/visitor/adm/index.php3?p_visitoraction=list&p_minvis=2 class=truelink>$l_nboften</a>"); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>pourcentage de visiteurs supportant FLASH
  </td>
  <td class=color3 align=left>&nbsp;<?php printf("%.2f",$l_flashrate);print(" %"); ?>
  </td>
 </tr>
</table>

<br><br>

<?php show_hr() ?>

<br><br>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=60%>
<tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
<tr><td class=color2 align=center> &#187; années &#171; </td></tr>
<?php
 
$l_sql = "SELECT DISTINCT date_format(firstvis,'%Y') AS year FROM $table_visitor  WHERE cookie = '1' ORDER BY year DESC";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  print("<tr><td class=list align=center height=20 valign=center><a href=$PHP_SELF?p_trafficaction=viewyear&p_year=$obj->year>$obj->year</a></td></tr>");
}

?>

</table>
</td></tr></table>
<br><br>
