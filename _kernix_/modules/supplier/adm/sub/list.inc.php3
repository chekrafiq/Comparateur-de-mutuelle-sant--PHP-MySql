<?php

$l_sql = "SELECT * FROM $table_supplier ORDER BY name LIMIT 0, 70";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun supplierulaire");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_supplieraction value=add>\n");
     print("<input type=submit value='créer un nouveau FOURNISSEUR' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="95%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center">
   name
  </td>
  <td class="color2" align="center">
   code
  </td>
  <td class="color2" align="center" width="20%">
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
     print("<a href=\"$PHP_SELF?p_supplieraction=view&p_idsupplier=$obj->idsupplier\" class=truelink>$obj->idsupplier</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->name);
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->code);
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_supplieraction value=add>
<input type=submit value='créer un nouveau FOURNISSEUR' class=button>
</form>
