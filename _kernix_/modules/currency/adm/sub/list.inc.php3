<?php

$l_sql = "SELECT * FROM $table_currency ORDER BY idcurrency ";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucune monnaie");
     show_hr();
     print("<form action=$PHP_SELF method=post>");
     print("<input type=hidden name=p_currencyaction value=add>");
     print("<input type=submit value='créer un nouvelle MONNAIE' class=button>");
     print("</form>");
     return 0;
}

?>

<table align=center width=95%>

 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center>
   nom
  </td>
  <td class=color2 align=left width=30%>
   valeur
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_currencyaction=view&p_idcurrency=$obj->idcurrency\" class=truelink>$obj->idcurrency</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print("$obj->name");
     print("</td>");
     print("<td class=$l_class align=left>$obj->value $g_currencyname</td>");
     print("</tr>");
}
?>
</table>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_currencyaction value=add>
<input type=submit value='créer une nouvelle MONNAIE' class=button>
</form>






