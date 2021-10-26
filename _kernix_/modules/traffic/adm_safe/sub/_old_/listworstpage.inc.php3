<?php

$n = 10;

$l_sql = "SELECT page, count(page) as tmp FROM $table_log WHERE date_format(date,'%m') = '$p_nummonth' AND page != '' GROUP BY page ORDER BY tmp LIMIT 0,$n";
$c_db->query($l_sql);

print("<br><p class=ptitle align=center>les pages les moins visitées</p>");
print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");

$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
     $p = $c_db->result($i,"page");
     $nb = $c_db->result($i,"tmp");
     print("<tr><td class=list align=center width=10%>$nb</td>");
     print("<td class=list align=left>&nbsp;$p</td></tr>");
}

print("</table>");
print("</td></tr></table>\n");
?>


