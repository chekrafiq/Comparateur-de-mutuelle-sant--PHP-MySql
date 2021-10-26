<?php

$l_sql = "SELECT * FROM $table_error ORDER BY iderror DESC LIMIT 0, 70";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun error");
     return 0;
}

?>

<table align="center" width="95%">
 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center" width="5%">
   num
  </td>
  <td class="color2" align="left">
   &nbsp; page
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
     print("<a href=\"$PHP_SELF?p_superuseraction=view&p_iderror=$obj->iderror\" class=truelink>$obj->iderror</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->numerror);
     print("</td>");
     print("<td class=$l_class align=left> &nbsp; ");
     print($obj->url);
     print("</td>");
     print("<td class=$l_class align=center>" . show_date($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>

<br>

<?php

show_back();

?>


