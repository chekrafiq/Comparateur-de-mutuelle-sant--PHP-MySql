<?php

$l_sql = "SELECT idcommand, currency FROM $table_command WHERE status = '20' AND date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = '$p_nummonth'";
$c_db->query($l_sql);
$l_nbcommand = $c_db->numrows;
$l_currency  = $c_db->result(0,"currency");

$l_sql = "SELECT idcommand FROM $table_command WHERE status >= '4' AND status < '20' AND date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = '$p_nummonth'";
$c_db->query($l_sql);
$l_nbcommandu = $c_db->numrows;

$l_sql = "SELECT idclient FROM $table_client WHERE date_format(date,'%Y') = '$p_year' AND nbpurchase >= '1' AND date_format(date,'%m') = '$p_nummonth'";
$c_db->query($l_sql);
$l_nbclient = $c_db->numrows;

$l_sql = "SELECT sum(priceht) AS pht, sum(pricettc) AS pttc, sum(pricettcport) AS pttcport, sum(quantity) AS qproducts FROM $table_command WHERE date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = '$p_nummonth' AND status = '20'";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_qproducts = $obj->qproducts;
$l_pht       = $obj->pht;
$l_pttc      = $obj->pttc;
$l_pttcport  = $obj->pttcport;
if ($l_nbcommand > 0)
{
  $l_pmm = $l_pttc / $l_nbcommand;
  $l_pmq = $l_qproducts / $l_nbcommand;
}

?>

<table width=95%>
 <tr>
   <td align=left class=color1 colspan=2>
    :: ce mois &nbsp;&nbsp;&nbsp; <small><a href=<?php print("$PHP_SELF?p_shopaction=viewmonth&p_year=$p_year&p_nummonth=$p_nummonth"); ?> class=whitelink><?php print("$p_nummonth"); ?></a></small> / <a href=<?php print("$PHP_SELF?p_shopaction=viewyear&p_year=$p_year"); ?> class=whitelink><?php print("$p_year"); ?></a>
   </td> 
 </tr>
 <tr>
  <td class=color2 width=60% align=right>nombre de commandes abouties &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbcommand); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 width=60% align=right>nombre de commandes à finaliser &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbcommandu); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 width=60% align=right>nombre de produits vendus &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_qproducts); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>nombre de clients &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_nbclient); ?>
  </td>
 </tr>
 
 <tr>
  <td class=color2 align=right>CA HT &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print("$l_pht $l_currency"); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>CA TTC (+ port ) &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print("$l_pttc $l_currency ($l_pttcport $l_currency)"); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>panier moyen (quantité) &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print($l_pmq); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>panier moyen (montant) &nbsp;
  </td>
  <td class=color3 align=left>&nbsp;<?php print("$l_pmm $l_currency"); ?>
  </td>
 </tr>

</table>

<center>

<br>
<?php show_hr(); ?>
<br>

<img src="/extern/getgraph.php3?p_title=command+by+day&p_x=520&p_y=150&p_code=homeshop/adm/sub/graph_commandday.inc.php3&p_ordtitle=nb&p_nummonth=<?php print($p_nummonth); ?>&p_year=<?php print($p_year); ?>">

</center>

<br>
<?php show_hr(); ?>
<br>

<table width=98% border=0 align=center>
 <tr>
  <td width=60% class=main valign=top>

<?php

include("sub/listtopcommand.inc.php3");
print("</td><td class=main valign=top>");
include("sub/listtophour.inc.php3");
print("<br>");
include("sub/listmode.inc.php3");
print("<br>");
include("sub/listtopsupplier.inc.php3");
?>

  </td>
 </tr>
</table>

<br>
