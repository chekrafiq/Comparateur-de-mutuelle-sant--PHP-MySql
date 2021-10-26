<?php

$l_sql = "SELECT urlfromfirstvis AS f, count(*) as n FROM $table_visitor WHERE urlfromfirstvis != '' AND urlfromfirstvis != '::RELOAD::' AND urlfromfirstvis != '::NULL::' AND urlfromfirstvis NOT LIKE '$g_urlroot%' AND cookie = '1' AND date_format(firstvis,'%m') = '$p_nummonth' AND date_format(firstvis,'%Y') = '$p_year' GROUP BY urlfromfirstvis  ORDER BY n DESC";
$c_db->query($l_sql);
//print("$l_sql<br>");
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
  print("<tr><td class=list align=center width=10%>$nb</td>");
  $ps = ereg_replace("^http://|/$","",$p);
  print("<td class=list align=left>&nbsp;");
  if (!ereg("^::",$p))
  {
    print("<a href=\"$p\" target=windowext>$ps</a>");
  }
  else
  {
    print("$ps");
  }
  print("</td></tr>");
}

?>

</table>
</td></tr></table>
