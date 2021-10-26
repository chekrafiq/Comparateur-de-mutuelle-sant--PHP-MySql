<?php

$l_sql = "SELECT * FROM $table_logadm ORDER BY date DESC LIMIT 0, 1000";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun error");
     return 0;
}

?>

<table align="center" width="98%">
 <tr>
  <td class="color2" align="center" height="20">
   login
  </td>
  <td class="color2" align="left">
   &nbsp; remotehost
  </td>
  <td class="color2" align="center" width="25%">
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
     print($obj->login);
     print("</td>");
     print("<td class=$l_class align=left>");
     print(" &nbsp; $obj->remotehost [$obj->remoteaddr]");
     print("</td>");
     print("<td class=$l_class align=center>" . show_datetime($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>

<br>

<?php

show_back();

?>


