<?php

$l_sql = "SELECT R.*, P.price, P.productcode FROM $table_ref AS R, $table_product AS P WHERE P.idsupplier = '$p_idsupplier' AND R.idproduct = P.idproduct";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun produit");
     include("sub/view.inc.php3");
     return 0;
}

?>

<table align="center" width="95%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="left">
   &nbsp; name
  </td>
  <td class="color2" align="center" width="13%">
   date
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$g_urlroot/$g_modulespath/site/adm/?p_idref=$obj->idref\" class=truelink title=\"price : $obj->price\">$obj->idref</a>");
     print("</td>");
     print("<td class=$l_class align=left>");
     print("&nbsp;[$obj->productcode] " . stripslashes($obj->name));
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->creationdate) . "</td>");
     print("</tr>");
}
?>
</table>
<br>

<?php show_back(); ?>
