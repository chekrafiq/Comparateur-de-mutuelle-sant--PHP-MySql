<?php

$l_sql = "SELECT count(remotereferer) as n, remotereferer as r FROM $table_visitor WHERE remotereferer != '' AND date_format(firstvis,'%Y') = '$p_year' GROUP BY remotereferer ORDER BY n DESC LIMIT 0,100";
$c_db->query($l_sql);

if (($l_nb = $c_db->numrows) == 0)
{
  print("<br>");
  show_back();
  return 0;
}
?>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
<tr><td class=color2 align=center colspan=2> &#187; top referers &#171; </td></tr>

<?php

while ($obj = $c_db->object_result())
{
  print("<tr><td class=list align=center width=10%>$obj->n</td>");
  print("<td class=list align=center>$obj->r</td></tr>");
}

?>

</table>
</td></tr></table>

<br>

<?php show_back(); ?>
