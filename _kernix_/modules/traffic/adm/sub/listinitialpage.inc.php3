<?php

$l_sql = "SELECT page, COUNT(*) as tmp FROM $table_log WHERE newvis = '1' AND date LIKE '$p_year-$p_nummonth-%' GROUP BY page ORDER BY tmp DESC LIMIT 0,10";
$c_db->query($l_sql);
$l_nbvisit = $c_db->numrows;

if ($c_db->numrows == 0)
{
  print("&nbsp;");
  return 0;
}

print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
print("<tr><td class=color2 align=center colspan=2> &#187; points d'entrées &#171; </td></tr>");
for ($i=0;$i<$l_nbvisit;$i++)
{
     $p = $c_db->result($i,"page");
     $tmp = $c_db->result($i,"tmp");
     print("<tr><td class=list align=left>&nbsp;$p</td><td class=list align=center width=10%>$tmp</td></tr>");
}

?>

</table>
</td></tr></table>
