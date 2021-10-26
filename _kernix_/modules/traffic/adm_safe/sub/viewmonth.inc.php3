<?php

// nb visitor
$l_sql = "SELECT count(idvisitor) FROM $table_visitor WHERE date_format(firstvis,'%m') = '$p_nummonth'  AND date_format(firstvis,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisitorthismonth = $c_db->result(0,0);

// nb visit ce mois
$l_sql = "SELECT count(idlog) FROM $table_log WHERE newvis = '1' AND date_format(date,'%m') = '$p_nummonth' AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbvisthismonth = $c_db->result(0,0);

// % de visite le weekend
$l_sql = "SELECT count(idlog) FROM $table_log WHERE newvis = '1' AND NOT(date_format(date,'%w') IN (0,6)) AND date_format(date,'%m') = '$p_nummonth' AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_weekendrate = 0;
if ($l_nbvisthismonth)
{
  $l_weekendrate = 100 - ($c_db->result(0,0) / $l_nbvisthismonth * 100);
}

// duree moy d'une visiste
$l_sql = "SELECT min(date) AS min, max(date) AS max FROM $table_log WHERE idsession != '' AND date_format(date,'%m') = '$p_nummonth' AND date_format(date,'%Y') = '$p_year' GROUP BY idsession";
$c_db->query($l_sql);
$i = 0;
$l_total = 0;
while ($obj = $c_db->object_result())
{
  $l_diff = 30 + strtotime($obj->max) - strtotime($obj->min);
  if ($l_diff >= 18000) continue;
  $l_total += $l_diff;
  $i++;
}
$l_visitduration = 0;
if ($i)
{
  $l_visitduration = $l_total / $i;
}

// nb moyen de pages vues
$l_sql = "SELECT count(idsession) AS n FROM $table_log WHERE idsession != '' AND date_format(date,'%m') = '$p_nummonth' AND date_format(date,'%Y') = '$p_year' GROUP BY idsession";
$c_db->query($l_sql);
$i = 0;
$l_total = 0;
while ($obj = $c_db->object_result())
{
  $l_total += $obj->n;
  $i++;
}
$l_visitnbpages = 0;
if ($i)
{
  $l_visitnbpages = $l_total / $i;
  $l_visitnbpages = sprintf("%.1f",$l_visitnbpages);
}

// nb de HNI
$l_sql = "SELECT count(date) FROM $table_logaltern WHERE date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbaltern = $c_db->result(0,0);

?>

<table width="95%">
 <tr>
   <td align="left" class="color1" colspan="2">
    :: ce mois &nbsp;&nbsp;&nbsp; 
    <small><a href=<?php print("$PHP_SELF?p_trafficaction=viewmonth&p_year=$p_year&p_nummonth=$p_nummonth"); ?> class="whitelink"><?=$p_nummonth?></a> /    </small>
    <a href="<?=$PHP_SELF?>?p_trafficaction=viewyear&p_year=<?=$p_year?>" class="whitelink"><?=$p_year?></a>
   </td> 
 </tr>
 <tr>
  <td class="color2" width="60%" align="right">nombre de visites&nbsp;</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisthismonth?></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de visiteurs &nbsp;</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbvisitorthismonth?></td>
 </tr>
 <tr>
  <td class="color2" align="right">pourcentage de visites le weekend &nbsp;</td>
  <td class="color3" align="left">&nbsp;<?php printf("%.2f",$l_weekendrate); ?> %</td>
 </tr>
 <tr>
  <td class="color2" align="right">durée moyenne d&#39;une visite &nbsp;</td>
  <td class="color3" align="left">&nbsp;<?php printf(strftime("%M mn %S s",$l_visitduration)); ?>
  </td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre moyen de pages vues &nbsp;</td>
  <td class="color3" align="left">&nbsp;<?=$l_visitnbpages?></td>
 </tr>
 <tr>
  <td class="color2" align="right">robots (moteurs de recherche) &nbsp;</td>
  <td class="color3" align="left">&nbsp;
<?php 
if ($l_nbaltern == 0) print('0');
else printf("<a href=$PHP_SELF?p_trafficaction=listhni&p_nummonth=$p_nummonth&p_year=$p_year>$l_nbaltern</a>"); 
?>
  </td>
 </tr>

</table>

<center>

<br>
<?php show_hr(); ?>
<br>

<img src="/extern/getgraph.php3?p_title=visites+par+jour&p_x=550&p_y=150&p_code=traffic/adm/sub/graph_visitbyday.inc.php3&p_ordtitle=visites&p_nummonth=<?=$p_nummonth?>&p_year=<?=$p_year?>" vspace="4">

<br>
<?php show_hr(); ?>
<br>

<img src="/extern/getgraph.php3?p_title=visites+en+moyenne+par+heure&p_x=550&p_y=150&p_code=traffic/adm/sub/graph_visitinday.inc.php3&p_ordtitle=visites&p_nummonth=<?=$p_nummonth?>&p_year=<?=$p_year?>">

<br>
<?php show_hr(); ?>

<br><br>

</center>

<table width="98%" border="0" align="center">
 <tr>
  <td width="50%" class="main" valign="top">

<?php

include("sub/listtopday.inc.php3");
print("<br>");
include("sub/listinitialpage.inc.php3");

print("</td><td class=main valign=top>");

include("sub/listproperty.inc.php3");
print("<br>");
include("sub/listaffiliate.inc.php3");

print("</td></tr>");

print("<tr><td class=main valign=top colspan=2><br>");
include("sub/listpagefrom.inc.php3");

?>

  </td>
 </tr>
</table>

<br><br>
