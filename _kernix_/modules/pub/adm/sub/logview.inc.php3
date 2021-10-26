<?php

$l_sql = "SELECT * FROM $table_publog WHERE idpub = '$p_idpub' ORDER BY idpub DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("fichier de log vide.");
     include("sub/view.inc.php3");
     return 1;
}

?>

<table align=center width=85%>
<tr>
<td class=color2 width=15% align=center height=20>
id visitor
</td>
<td class=color2 align=center width=60%>
remotehost
</td>
<td class=color2 align=center width=25%>
date
</td>
</tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     if ($obj->idvisitor)
     {
	  print("<td class=$l_class align=center><a href=\"$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$obj->idvisitor\" class=truelink>$obj->idvisitor</a></td>");
     }
     else
     {
	  print("<td class=$l_class align=center>0</td>");
     }
     print("<td class=$l_class align=center>");
     print("$obj->remotehost");
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_datetime($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>
<br>

<?php show_back(); ?>
