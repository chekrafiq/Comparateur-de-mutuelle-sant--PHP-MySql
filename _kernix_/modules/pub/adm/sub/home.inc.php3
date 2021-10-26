<?php

$l_sql = "SELECT idpub FROM $table_pub";
$c_db->query($l_sql);
$l_nbpub = $c_db->numrows;

$l_sql = "SELECT sum(nbview) as som FROM $table_pub";
$c_db->query($l_sql);
$l_obj_nbview = $c_db->object_result();
$l_nbview = $l_obj_nbview->som;

$l_sql = "SELECT sum(nbclick) as som FROM $table_pub";
$c_db->query($l_sql);
$l_obj_nbclick = $c_db->object_result();
$l_nbclick = $l_obj_nbclick->som;

$l_nbclickrate = 0;
if ($l_nbview)
{
  $l_nbclickrate = (100 / $l_nbview) * $l_nbclick;
}
?>

<table width=80% align=center border=0>
 <tr>
  <td align=left class=color1 colspan=2>
   :: Statistiques depuis la création du site
  </td> 
 </tr>
 <tr>
  <td class=color2 width=70% align=right>nombre de pubs
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbpub); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de vue
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbview); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>nombre de click
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbclick); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>pourcentage de click
  </td>
  <td class=color3 align=left>&nbsp;<?php printf("%.2f",$l_nbclickrate);print(" %"); ?>
  </td>
 </tr>
</table>


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
  print("<tr><td class=list align=center height=20 valign=center><a href=$PHP_SELF?p_pubaction=viewyear&p_year=$obj->year>$obj->year</a></td></tr>");
}

?>

</table>
</td></tr></table>

<br><br>
<?php show_hr() ?>
<br><br>

<?php

$l_sql = "SELECT * FROM $table_pub ORDER BY idpub DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucune pub.");
     include("sub/add_bar.inc.php3");
     return 0;
}

?>


<table width=80% align=center border=0>
 <tr>
  <td align=left class=color1 colspan=5>
   :: Gestion des pubs
  </td> 
 </tr>
 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center width=50%>
   nom
  </td>
  <td class=color2 align=center width=10%>
   nb click
  </td>
  <td class=color2 align=center width=10%>
   nb aff
  </td>
  <td class=color2 align=center width=15%>
   date
  </td>
</tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center><a href=\"$PHP_SELF?p_pubaction=view&p_idpub=$obj->idpub\" class=truelink>$obj->idpub</a></td>");
     print("<td class=$l_class align=center>");
     print("$obj->name");
     print("</td>");
     print("<td class=$l_class align=center width=20%>$obj->nbclick</td>");
     print("<td class=$l_class align=center width=20%>$obj->nbview</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
     print("</tr>");
}

?>
</table>

<?php include("sub/add_bar.inc.php3"); ?>

