<?php

$n = 7;

$l_sql = "SELECT date_format(date,'%W %e %M %Y') AS dt, COUNT(date) AS tmp FROM $table_log WHERE newvis = '1' AND date_format(date,'%m') = '$p_nummonth' GROUP BY dt ORDER BY tmp DESC LIMIT 0,$n";
$c_db->query($l_sql);

print("<p class=ptitle align=center>pic de fréquentation dans le mois</p>");
print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
     $dt = $c_db->result($i,"dt");
     $tmp = $c_db->result($i,"tmp");
     print("<tr><td class=list align=center>$dt</td>");
     print("<td class=list align=center>$tmp</td></tr>");
}

print("</table>");
print("</td></tr></table>\n");

?>
