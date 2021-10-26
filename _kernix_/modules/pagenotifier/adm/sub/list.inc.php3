<?php

$l_sql = "SELECT * FROM $table_property ORDER BY idproperty DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("no property"); 
     print("<hr noshade color=#323A4D width=90%>");
     print("<form action=$PHP_SELF method=post><input type=hidden name=p_propertyaction value=add><input type=submit value='créer une nouvelle propriété' class=button></form>");
     return 0;
}

?>

<table align=center width=95%>
<tr>
<td class=color2 width=5% align=center>
id
</td>
<td class=color2 align=center>
nom
</td>
<td class=color2 align=center width=10%>
flag
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
     print("<td class=$l_class align=center>$obj->propertyflag</td>");
     print("</tr>");
}

?>

</table>
<br><hr noshade color=#323A4D width=90%>

<form action="<?php print("$PHP_SELF"); ?>" method=post>
<input type=hidden name=p_propertyaction value=add>
<input type=submit value='créer une nouvelle propriété' class=button>
</form>







