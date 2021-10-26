<?php

$l_sql = "SELECT * FROM $table_property ORDER BY propertyname";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("no property."); 
     show_hr();
     print("<form action=$PHP_SELF method=post>");
     print("<input type=hidden name=p_propertyaction value=add>");
     print("<input type=submit value='créer une nouvelle propriété' class=button>");
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
  <td class=color2 align=center width=20%>
   date
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center><a href=\"$PHP_SELF?p_propertyaction=view&p_idproperty=$obj->idproperty\" class=truelink>$obj->idproperty</a></td>");
     print("<td class=$l_class align=center>");
     print("$obj->propertyname");
     print("</td>");
     print("<td class=$l_class align=center>".show_date($obj->date)."</td>");
     print("</tr>");
}

print("</table><br><br>");
show_hr();
print("<form action=$PHP_SELF method=post><input type=hidden name=p_propertyaction value=add><input type=submit value='créer une nouvelle propriété' class=button></form>");

?>








