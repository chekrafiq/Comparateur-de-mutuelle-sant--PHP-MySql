<?php

$l_sql = "SELECT count(V.country) as n, V.country AS code FROM $table_visitor AS V WHERE V.country != '' AND date_format(V.firstvis,'%Y') = '$p_year' GROUP BY V.country ORDER BY n DESC";
$c_db->query($l_sql);

if (($l_nb = $c_db->numrows) == 0)
{
  print('<br>');
  show_back();
  return 0;
}
?>

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="center" width="50%"><tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
<tr><td class="color2" align="center" colspan="3"> &#187; pays &#171; </td></tr>

<?php

while ($obj = $c_db->object_result())
{
  print("<tr><td class=list align=center width=10%>$obj->n</td>");
  print("<td class=list align=center>$obj->code</td>");
  print("<td class=list align=center width=7%><img src=/pictures/adm/flags/$obj->code.png></td></tr>\n");
}

?>

</table>
</td></tr></table>

<br>

<?php show_back(); ?>
