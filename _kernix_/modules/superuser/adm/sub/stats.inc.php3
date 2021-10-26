<?php

$l_sql = "SELECT count(idcommand) as nb FROM $table_command where status > 3";
$c_db->query($l_sql);
$l_buy = $c_db->object_result();

$l_sql = "SELECT count(idclient) as nb FROM $table_client where nbpurchase > 0";
$c_db->query($l_sql);
$l_buyer = $c_db->object_result();

$l_sql = "SELECT count(idclient) as nb FROM $table_client WHERE nbpurchase > 1";
$c_db->query($l_sql);
$l_serialbuyer = $c_db->object_result();;


$l_sql = "SELECT count(idcommand) as nb FROM $table_command where status > 3 AND date_format(date,'%m') = date_format('$l_date','%m')";
$c_db->query($l_sql);
$l_mbuy = $c_db->object_result();

$l_sql = "SELECT count(idnumsession) as nb FROM $table_session where date_format(date,'%m') = date_format('$l_date','%m')";
$c_db->query($l_sql);
$l_mres = $c_db->object_result();

$l_sql = "SELECT count(idclient) as nb FROM $table_client where date_format(date,'%m') = date_format('$l_date','%m')";
$c_db->query($l_sql);
$l_newbuyer = $c_db->object_result();

?>


<table width=100%>

 <tr>
   <td align=left class=color1 colspan=2>
    :: depuis la création du site
   </td> 
 </tr>

 <tr>
  <td class=color2 width=60% align=right>nombre de commande
  </td>
  <td class=color3 align=left><?php print("$l_buy->nb"); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>nombre d'acheteur
  </td>
  <td class=color3 align=left><?php print("$l_buyer->nb"); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>nombre de visiteurs ayant acheté plus d'une fois  </td>
  <td class=color3 align=left><?php print("<a href=\"/$g_modulespath/visitor/adm/index.php3?p_visitoraction=list&p_minvis=2\" class=truelink>$l_serialbuyer->nb</a>"); ?>
  </td>
 </tr>

 <tr>
   <td align=left colspan=2><br>
   </td> 
 </tr>

 <tr>
   <td align=left class=color1 colspan=2> :: ce mois

   </td> 
 </tr>

 <tr>
  <td class=color2 width=70% align=right>nombre de commande
  </td>
  <td class=color3 align=left><?php print("$l_mbuy->nb"); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>nombre de réservation
  </td>
  <td class=color3 align=left><?php print("$l_mres->nb"); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>nombre de nouveaux acheteurs 
  </td>
  <td class=color3 align=left><?php print("$l_newbuyer->nb"); ?>
  </td>
 </tr>
 
</table>

