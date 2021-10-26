<?php

$l_sql = "SELECT COUNT(A.idalert) AS nb, A.idref, R.name FROM $table_alert AS A, $table_ref AS R WHERE A.idref = R.idref GROUP BY idref ORDER BY nb DESC LIMIT 0, 30";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucune alert");
     show_hr();
     return 0;
}

?>

<table align="center" width="85%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   idref
  </td>
  <td class="color2" align="center" >
   name
  </td>
  <td class="color2" align="center" width="8%">
   nb
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_alertaction=view&p_idalert=$obj->idalert\" class=truelink>$obj->idref</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->name);
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->nb);
     print("</td>");
     print("</tr>");
}
?>
</table>
