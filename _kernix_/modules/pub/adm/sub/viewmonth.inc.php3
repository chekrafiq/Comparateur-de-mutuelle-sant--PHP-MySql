<?php

$l_sql = "SELECT idlog FROM $table_log WHERE idpub > 0 AND date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = date_format('$l_date','%m')";
$c_db->query($l_sql);
$l_nbview = $c_db->numrows;

$l_sql = "SELECT idpublog FROM $table_publog WHERE date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = date_format('$l_date','%m')";
$c_db->query($l_sql);
$l_nbclick = $c_db->numrows;

$l_nbclickrate = 0;
if ($l_nbview)
{
  $l_nbclickrate = (100 / $l_nbview) * $l_nbclick;
}
?>

<table width=95%>
 <tr>
   <td align=left class=color1 colspan=2>
    :: ce mois &nbsp;&nbsp;&nbsp; <small><a href=<?php print("$PHP_SELF?p_pubaction=viewmonth&p_year=$p_year&p_nummonth=$p_nummonth"); ?> class=whitelink><?php print($p_nummonth); ?></a> / </small><a href=<?php print("$PHP_SELF?p_pubaction=viewyear&p_year=$p_year"); ?> class=whitelink><?php print("$p_year"); ?></a>
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

<center>

<br>
<?php show_hr(); ?>
<br>

<img src="/extern/getgraph.php3?p_title=Affichage+par+jour&p_x=550&p_y=150&p_code=pub/adm/sub/graph_pubviewbyday.inc.php3&p_ordtitle=pub&p_nummonth=<?php print($p_nummonth); ?>&p_year=<?php print($p_year); ?>">

<br>
<?php show_hr(); ?>

<br><br>

</center>

<table width=98% border=0 align=center>
 <tr>
  <td width=50% class=main valign=top>

<?php
include("sub/listtopview.inc.php3");
?>

</td><td class=main valign=top>

<?php
include("sub/listtopclick.inc.php3");
?>

</td></tr>

</table>

<br><br>
