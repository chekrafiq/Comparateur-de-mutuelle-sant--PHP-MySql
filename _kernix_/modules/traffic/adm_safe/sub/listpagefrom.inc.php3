<?php

$l_sql = "SELECT urlfromfirstvis AS f, count(*) as n FROM $table_visitor WHERE urlfromfirstvis != '' AND urlfromfirstvis != '::RELOAD::' AND urlfromfirstvis != '::NULL::' AND urlfromfirstvis NOT LIKE '$g_urlroot%' AND date_format(firstvis,'%m') = '$p_nummonth' AND date_format(firstvis,'%Y') = '$p_year' GROUP BY urlfromfirstvis  ORDER BY n DESC";
$c_db->query($l_sql);

if (($l_nbvisit = $c_db->numrows) == 0)
{
  print("&nbsp;");
  return 0;
}

?>

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="center" width="95%"><tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
<tr><td class="color2" align="center" colspan="2"> &#187; origine de vos visiteurs &#171; </td></tr>

<?php
for ($i=0;$i<$l_nbvisit;$i++)
{
  $p  = $c_db->result($i,"f");
  $nb = $c_db->result($i,"n");
  print("<tr><td class=list align=center width=5%>$nb</td>");
//  $ps = ereg_replace("^http://|/$","",$p);
  $ps = $p;
  print("<td class=list align=left>\n");
  if ($p[0] != ':') print("<a href=\"$p\" target=_blank title=\"click to view the page\">$ps</a>\n");
  else print($ps);
  print("</td></tr>\n\n");
}
?>

</table>
</td></tr></table>
