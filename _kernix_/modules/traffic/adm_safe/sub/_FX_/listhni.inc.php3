<?php

if (isset($p_idref))
{
  $l_sql = "SELECT * FROM $table_logaltern WHERE date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' AND idref = '$p_idref' ORDER BY date DESC";
}
else
{
    $l_sql = "SELECT * FROM $table_logaltern WHERE date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' ORDER BY date DESC";
}
$c_db->query($l_sql);

?>

<table align="center" width="100%">

 <tr>
  <td class="color2" align="center" height="20">
   page
  </td>
  <td class="color2" align="center">
   host
  </td>
  <td class="color2" align="center">
   system
  </td>
  <td class="color2" align="right">
   date
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "listdarksmall"; else : $l_class = "listlightsmall"; endif;
     print("<tr>");
     print("<td class=$l_class align=center valign=top><a href=$PHP_SELF?p_trafficaction=listhni&p_nummonth=$p_nummonth&p_year=$p_year&p_idref=$obj->idref title=\"$obj->page\">$obj->idref</a></td>");
     print("<td class=$l_class align=left valign=top><i>$obj->remoteaddr</i><br>$obj->remotehost</td>");
     print("<td class=$l_class align=center valign=top>$obj->system</td>");
     print("<td class=$l_class align=right valign=top>" . show_datetime($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>

<br>

<?php

show_back();

?>






