<?php

$l_sql = "SELECT count(idcommand) FROM $table_command WHERE status = '20' AND date_format(date,'%Y') = '$p_year'";
$c_db->query($l_sql);
$l_nbcommand = $c_db->result(0,0);

$l_sql = "SELECT numsession FROM $table_session WHERE status > '0' AND status < '20' AND date_format(date,'%Y') = '$p_year' GROUP BY numsession";
$c_db->query($l_sql);
$l_nbbadcommand = $c_db->numrows;

$l_sql = "SELECT count(idclient) FROM $table_client WHERE date_format(date,'%Y') = '$p_year' AND nbpurchase >= '1'";
$c_db->query($l_sql);
$l_nbclient = $c_db->result(0,0);

$l_sql = "SELECT count(idclient) FROM $table_client WHERE date_format(date,'%Y') = '$p_year' AND nbpurchase >= '2'";
$c_db->query($l_sql);
$l_nbserialclient = $c_db->result(0,0);

$l_sql = "SELECT sum(pricettc) AS pttc, sum(quantity) AS qproducts FROM $table_command WHERE date_format(date,'%Y') = '$p_year' AND status = '20'";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_qproducts = $obj->qproducts;
$l_pttc      = $obj->pttc;
if ($l_nbcommand > 0)
{
  $l_pmm = $l_pttc / $l_nbcommand;
  $l_pmq = $l_qproducts / $l_nbcommand;
}
?>

<table width="100%">
<tr>
<td class="main" width="75%" valign="top">

<table width="98%" align="left" border="0">
 <tr>
  <td align="left" class="color1" colspan="2">
   :: année <?=$p_year?>
  </td> 
 </tr>
 <tr>
  <td class="color2" width="70%" align="right">nombre de commandes finalisées</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbcommand?></td>
 </tr>
 <tr>
  <td class="color2" width="70%" align="right">nombre de commandes non abouties</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbbadcommand?></td>
 </tr> 
 <tr>
  <td class="color2" align="right">nombre de clients</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbclient?></td>
 </tr>
 <tr>
  <td class="color2" align="right">nombre de clients 'habitués'</td>
  <td class="color3" align="left">&nbsp;<?=$l_nbserialclient?></td>
 </tr> 
 <tr>
  <td class="color2" align="right">panier moyen (quantité) &nbsp;</td>
  <td class="color3" align="left">&nbsp;<?=$l_pmq?></td>
 </tr>
 <tr>
  <td class="color2" align="right">panier moyen (montant) &nbsp;</td>
  <td class="color3" align="left">&nbsp;<?="$l_pmm $l_currency"?></td>
 </tr>
</table>

</td>

<?php

if (!($l_nbcommand > 0))
{
  print("</tr></table><br>");
  return 0;
}

?>

<td class="main" valign="top" align="right">

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="right" width="100%"><tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
 <tr>
  <td align="center" class="color3">.:: année <?=$p_year?> ::.</td>
 </tr>
 <tr>
  <td class="list" align="center">
  <table width="100%" cellspacing="1" cellpadding="1" align="center" border="0">
<?php

$l_sql = "SELECT DISTINCT date_format(date,'%m') AS nummonth, date_format(date,'%b') AS namemonth FROM $table_command WHERE date_format(date,'%Y') = '$p_year' ORDER by nummonth DESC";
$c_db->query($l_sql);
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
  $l_namemonth = $c_db->result($i,"namemonth");
  $l_nummonth  = $c_db->result($i,"nummonth");   
  print("<tr><td align=center class=list> - <a href=$PHP_SELF?p_shopaction=viewmonth&p_nummonth=$l_nummonth&p_year=$p_year title=\"$l_namemonth $p_year\" >$l_namemonth $p_year</a> - </td></tr>");
}

?>
   </table>
  </td>
 </tr>
 <tr><td align="center" class="color3">.:: mode ::.</td></tr>
 <tr>
 <td class="list" align="left">
  <table width="100%" cellspacing="1" cellpadding="1">
<?php

$l_sql = "SELECT count(idcommand) as n, mode FROM $table_command WHERE date_format(date,'%Y') = '$p_year' AND status = 20 GROUP BY mode ORDER BY n DESC";
$c_db->query($l_sql);
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
  $l_n       = $c_db->result($i,"n");
  $l_percent = ($l_n / $l_nbcommand) * 100;
  $l_mode  = $c_db->result($i,"mode");
  print("<tr><td align=right class=list width=45%>$l_mode</td><td class=list> &nbsp;" . sprintf("%.2f ",$l_percent) . "%</td></tr>");
}

?> 
  </table>
 </td>
 </tr>

 <tr>
  <td align="center" class="color3">.:: nb product ::.</td></tr>
 <tr>
 <td class="list" align="left">
  <table width="100%" cellspacing="1" cellpadding="1">
<?php

$l_sql = "SELECT count(idcommand) as n, quantity FROM $table_command WHERE date_format(date,'%Y') = '$p_year' AND status = 20 GROUP BY quantity ORDER BY n DESC LIMIT 0,5";
$c_db->query($l_sql);
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
  $l_n       = $c_db->result($i,"n");
  $l_percent = ($l_n / $l_nbcommand) * 100;
  $l_q       = "q=" . $c_db->result($i,"quantity");
  print("<tr><td align=right class=list width=45%>$l_q</td><td class=list> &nbsp;" . sprintf("%.2f ",$l_percent) . "%</td></tr>");
}

?> 
  </table>
 </td>
 </tr>

</table>

</td></tr></table>

</td>
</tr>
</table>

<br>

<?php

show_hr();

?>

<br>

<center><img src="/extern/getgraph.php3?p_title=commands+by+month+(<?=$p_year?>)&p_y=150&p_x=520&p_code=homeshop/adm/sub/graph_commandmonth.inc.php3&p_ordtitle=nb&p_year=<?=$p_year?>"></center><br>

<br>

<?php

show_hr();

?>

<br>

<?php if ($l_nbclient != 0): ?>

<center><img src="/extern/getgraph.php3?p_title=clients+by+month+(<?=$p_year?>)&p_y=150&p_x=520&p_code=homeshop/adm/sub/graph_clientmonth.inc.php3&p_ordtitle=nb&p_year=<?=$p_year?>"></center><br>

<?php 
endif;
?>
