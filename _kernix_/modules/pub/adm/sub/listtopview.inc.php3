<?php

$l_sql = "SELECT count(idpub) as som, idpub FROM $table_log WHERE idpub > 0 AND date_format(date,'%Y') = '$p_year' AND date_format(date,'%m') = date_format('$l_date','%m') GROUP BY idpub ORDER BY som DESC";
$c_db->query($l_sql);

print("<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center valign=top width=90%><tr><td>");
print("<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>");
print("<tr><td class=color2 align=center colspan=2> &#187; Top affichage &#171; </td></tr>");
$i=0;
while ($obj = $c_db->object_result())
{
  $tab_click[$i]["idpub"] = $obj->idpub;
  $tab_click[$i]["somme"] = $obj->som;
  $i++;
}

for($j=0;$j<$i;$j++)
{
  $l_sql = "SELECT name FROM $table_pub WHERE idpub = ".$tab_click[$j]["idpub"];
  $c_db->query($l_sql);
  $obj = $c_db->object_result();
  print("<tr><td class=list align=center><a href=\"$PHP_SELF?p_pubaction=view&p_idpub=".$tab_click[$j]["idpub"]."\" class=truelink>$obj->name</a></td>");
  print("<td class=list align=center width=10%>".$tab_click[$j]["somme"]."</td></tr>");
}

print("</table>");
print("</td></tr></table>\n");
?>
