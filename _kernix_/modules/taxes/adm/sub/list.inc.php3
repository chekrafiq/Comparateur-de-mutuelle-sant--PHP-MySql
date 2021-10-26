<?php

$l_sql = "SELECT * FROM $table_taxes ORDER BY idtaxes ";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucune monnaie");
     show_hr();
     print("<form action=$PHP_SELF method=post>");
     print("<input type=hidden name=p_taxesaction value=add>");
     print("<input type=submit value='créer un nouvelle TAXE' class=button>");
     print("</form>");
     return 0;
}

?>

<table align=center width=85%>

 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center>
   nom
  </td>
  <td class=color2 align=center width=20%>
   taux
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_taxesaction=view&p_idtaxes=$obj->idtaxes\" class=truelink>$obj->idtaxes</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print("$obj->name");
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . $obj->rate . "</td>");
     print("</tr>");
}
?>
</table>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_taxesaction value=add>
<input type=submit value='créer une nouvelle TAXE' class=button>
</form>






