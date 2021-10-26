<?php

$l_sql = "SELECT dayname(date) AS dname, count(*) AS tmp FROM $table_log WHERE newvis = '1' AND date LIKE '$p_year-$p_nummonth-%' GROUP BY dname ORDER BY tmp DESC";
$c_db->query($l_sql);

print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center valign=top width=90%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
print("<tr><td class=color2 align=center colspan=2> &#187; jours &#171; </td></tr>");
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
     $dname = $c_db->result($i,"dname");
     $tmp = $c_db->result($i,"tmp");
     print("<tr><td class=list align=center>$dname</td>");
     print("<td class=list align=center width=10%>$tmp</td></tr>");
}

print("</table>");
print("</td></tr></table>\n");
?>



