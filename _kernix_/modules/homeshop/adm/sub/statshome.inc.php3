<?php

$l_sql = "SELECT count(idcommand) FROM $table_command WHERE status = 20";
$c_db->query($l_sql);
$l_buy = $c_db->result(0,0);

$l_sql = "SELECT count(idclient) FROM $table_client WHERE nbpurchase >= 1";
$c_db->query($l_sql);
$l_buyer = $c_db->result(0,0);

$l_sql = "SELECT count(idclient) FROM $table_client WHERE nbpurchase >= 2";
$c_db->query($l_sql);
$l_serialbuyer = $c_db->result(0,0);


$l_sql = "SELECT count(idcommand) FROM $table_command WHERE status = 20 AND date_format(date,'%m%Y') = date_format('$l_date','%m%Y')";
$c_db->query($l_sql);
$l_mbuy = $c_db->result(0,0);

$l_sql = "SELECT count(idclient) FROM $table_client WHERE date_format(date,'%m%Y') = date_format('$l_date','%m%Y') AND nbpurchase > '1'";
$c_db->query($l_sql);
$l_newbuyer = $c_db->result(0,0);

?>


<table width="100%">

 <tr>
   <td align="left" class="color1" colspan="2">:: depuis la création du site</td> 
 </tr>

 <tr>
  <td class="color2" width="88%" align="right">nombre de commandes</td>
  <td class="color3" align="left">&nbsp; <?=$l_buy?></td>
 </tr>

 <tr>
  <td class="color2" align="right">nombre acheteurs</td>
  <td class="color3" align="left">&nbsp; <?=$l_buyer?></td>
 </tr>

 <tr>
  <td class="color2" align="right">nombre de visiteurs ayant acheté plus d&#39;une fois</td>
  <td class="color3" align="left">&nbsp; <?=$l_serialbuyer?></td>
 </tr>

 <tr>
   <td align="left" colspan="2"><br></td> 
 </tr>

 <tr>
   <td align="left" class="color1" colspan="2">:: ce mois 

<?php

if ($l_mbuy)
print("[ <small><a href=$PHP_SELF?p_shopaction=viewmonth&p_year=$l_year&p_nummonth=$l_month class=whitelink>$l_month</a></small> ]");

?>
   </td> 
 </tr>

 <tr>
  <td class="color2" align="right">nombre de commandes</td>
  <td class="color3" align="left">&nbsp; <?=$l_mbuy?></td>
 </tr>

 <tr>
  <td class="color2" align="right">nombre de nouveaux acheteurs</td>
  <td class="color3" align="left">&nbsp; <?=$l_newbuyer?></td>
 </tr>
 
</table>

<br><br>


<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<tr><td class="color2" align="center"> &#187; années &#171; </td></tr>
<?php
 
$l_sql = "SELECT DISTINCT date_format(date,'%Y') AS year FROM $table_command ORDER BY year DESC";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  print("<tr><td class=list align=center height=20 valign=center><a href=$PHP_SELF?p_shopaction=viewyear&p_year=$obj->year>$obj->year</a></td></tr>");
}

?>
</table>
