<?php

$l_sql = "SELECT * FROM $table_ratingresult WHERE idref = '$p_idref' AND value = '$p_value' ORDER BY date DESC";
$c_db->query($l_sql);

print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=50%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
while ($obj = $c_db->object_result())
{
     $l_idvisitor = $obj->idvisitor;
     $l_date = show_datetime($obj->date);
     if ($l_idvisitor != 0)
     print("<tr><td class=list align=center width=10%><a href=$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$l_idvisitor>$l_idvisitor</a></td>");
     else
        print("<tr><td class=list align=center width=10%>0</td>");
     print("<td class=list align=center>$l_date</td></tr>");
}
print("</table>");
print("</td></tr></table><br><br>");
show_back();
?>
