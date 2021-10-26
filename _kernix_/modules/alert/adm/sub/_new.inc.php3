<?php

$l_sql = "SELECT * FROM $table_alert ORDER BY idalert DESC LIMIT 0, 20";
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
   id
  </td>
  <td class="color2" align="center" >
   email
  </td>
  <td class="color2" align="center" width="8%">
   page
  </td>
  <td class="color2" align="center" width="20%">
   date
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_alertaction=view&p_idalert=$obj->idalert\" class=truelink>$obj->idalert</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->email);
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->idref);
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>
