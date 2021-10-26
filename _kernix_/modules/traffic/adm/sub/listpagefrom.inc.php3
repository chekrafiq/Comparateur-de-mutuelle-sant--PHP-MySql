<?php

$l_sql = "SELECT urlfromfirstvis AS f, count(*) as n FROM $table_visitor WHERE urlfromfirstvis != '' AND urlfromfirstvis != '::RELOAD::' AND urlfromfirstvis != '::NULL::' AND urlfromfirstvis NOT LIKE '$g_urlroot%' AND firstvis LIKE '$p_year-$p_nummonth-%' GROUP BY urlfromfirstvis ORDER BY n DESC LIMIT 0,100";
$c_db->query($l_sql);

if (($l_nbvisit = $c_db->numrows) == 0)
{
  print("&nbsp;");
  return 0;
}


print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=95%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
print("<tr><td class=color2 align=center colspan=2> &#187; origine de vos visiteurs &#171; </td></tr>");
for ($i=0;$i<$l_nbvisit;$i++)
{
  $p  = $c_db->result($i,"f");
  $nb = $c_db->result($i,"n");
  print("<tr><td class=list align=center width=5%>$nb</td>");
//  $ps = ereg_replace("^http://|/$","",$p);
  $ps = substr($p,0,120);
  print("<td class=list align=left>");
  if ($p[0] != ':') print("<a href=\"$p\" target=windowext title=\"click to view the page\">$ps</a>");
  else print($ps);
  print("</td></tr>");
}

?>

</table>
</td></tr></table>
