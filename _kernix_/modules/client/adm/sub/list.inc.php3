<form action="<?php print($PHP_SELF); ?>" method="POST">
 <input type="hidden" name="p_cientaction" value="list">
 <input type="text" name="p_keyword" class="text" size="20">
 <input type="submit" value="recherche" class="button">
</form>

<form action="<?php print($PHP_SELF); ?>" method="POST">
 <input type="hidden" name="p_clientaction" value="export">
 <input type="submit" value="export CSV" class="button">
</form>
<?php show_hr(); ?>

<br>



<?php
if (!empty($p_keyword))
{
  $l_sql = "SELECT * FROM $table_client WHERE clientflag = '1' AND firstname LIKE '%" . $p_keyword . "%' OR lastname LIKE '%" . $p_keyword . "%' OR company LIKE '%" . $p_keyword . "%' OR idclient LIKE '%" . $p_keyword . "%' OR address LIKE '%" . $p_keyword . "%' OR zipcode LIKE '%" . $p_keyword . "%' OR town LIKE '%" . $p_keyword . "%' OR email1 LIKE '%" . $p_keyword . "%' OR DATE_FORMAT(date,'%e/%m/%Y') LIKE '%" . $p_keyword . "%' ORDER BY idclient DESC";
}
else
{
  $l_sql = "SELECT * FROM $table_client WHERE clientflag = '1' ORDER BY idclient DESC";
}

$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucun client");
  return 0;
}

?>

<table align="center" width="98%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   n°
  </td>
  <td class="color2" align="center">
   nom
  </td>
  <td class="color2" align="center">
   prenom
  </td>
  <td class="color2" align="center">
   nbr d'achats
  </td>
  <td class="color2" align="center" width="20%">
   date création
  </td>
 </tr>

<?php

$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  print("<tr>");
  print("<td class=$l_class align=center>");
  print("<a href=\"$PHP_SELF?p_clientaction=view&p_idclient=$obj->idclient\" class=truelink>$obj->idclient</a>");
  print("</td>");
  print("<td class=$l_class align=center>" . strtoupper($obj->lastname) . "</td>");
  print("<td class=$l_class align=center>" . strtolower($obj->firstname) . "</td>");
  print("<td class=$l_class align=center>$obj->nbpurchase</td>");
  print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
  print("</tr>\n");
}

?>

</table>

<br>
