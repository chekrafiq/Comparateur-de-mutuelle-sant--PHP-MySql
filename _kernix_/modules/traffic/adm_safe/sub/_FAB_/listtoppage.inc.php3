<?php

$n = 50;

if (isset($p_idproperty))
$l_sql = "SELECT page, count(page) as tmp FROM $table_log WHERE idproperty = '$p_idproperty' AND date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' AND page != '' GROUP BY page ORDER BY tmp DESC LIMIT 0,$n";
else
$l_sql = "SELECT page, count(page) as tmp FROM $table_log WHERE date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' AND page != '' GROUP BY page ORDER BY tmp DESC LIMIT 0,$n";
$c_db->query($l_sql);


print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
print("<tr><td class=color2 align=center colspan=2> &#187; pages les plus visitées &#171;  </td></tr>");
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
     $p = $c_db->result($i,"page");
     $nb = $c_db->result($i,"tmp");
     print("<tr><td class=list align=center width=10%>$nb</td>");
     print("<td class=list align=left>&nbsp;$p</td></tr>");
}

print("</table>");
print("</td></tr></table><br><br>\n");

show_back();
?>

