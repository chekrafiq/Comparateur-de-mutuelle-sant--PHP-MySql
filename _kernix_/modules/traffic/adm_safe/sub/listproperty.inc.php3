<?php

$l_len = strlen($g_urlroot);

$l_sql = "SELECT L.idproperty AS idproperty, count(L.idproperty) as n, P.propertyname AS name FROM $table_log AS L, $table_property AS P WHERE L.idproperty != '0' AND L.idproperty != '' AND L.idproperty = P.idproperty AND date_format(L.date,'%m') = '$p_nummonth' AND date_format(L.date,'%Y') = '$p_year' GROUP BY L.idproperty ORDER BY n DESC";
$c_db->query($l_sql);

if (($l_nb = $c_db->numrows) == 0)
{
  print("&nbsp;");
  return 0;
}

?>

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="center" width="90%"><tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
<tr><td class="color2" align="center" colspan="2"> &#187; catégories &#171; </td></tr>

<?php
for ($i=0;$i<$l_nb;$i++)
{
  $name = $c_db->result($i,"name");
  $nb = $c_db->result($i,"n");
  $idproperty = $c_db->result($i,"idproperty");
  print("<tr><td class=list align=center width=10%>$nb</td>\n");
  print("<td class=list align=left>&nbsp;<a href=$PHP_SELF?p_trafficaction=listtoppage&p_idproperty=$idproperty&p_nummonth=$p_nummonth&p_year=$p_year>$name</a></td></tr>\n");
}
?>

</table>
</td></tr></table>
