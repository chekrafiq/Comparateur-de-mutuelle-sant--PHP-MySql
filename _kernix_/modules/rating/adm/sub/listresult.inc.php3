<?php

$table_ref = "ref";

$l_sql = "SELECT RES.idresult AS idresult, RES.idref AS idref,  count(RES.idref) AS nbresult, REF.name AS name FROM $table_result AS RES, $table_ref AS REF WHERE REF.idref = RES.idref GROUP BY RES.idref ORDER BY RES.idref DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("auncun RESULTAT");
     return 0;
}

?>

<table align=center width=95%>

 <tr>
  <td class=color2 width=20% align=center height=20>
   ref
  </td>
  <td class=color2 align=center>
   page
  </td>
  <td class=color2 align=center width=20%>
   nbresult
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_ratingaction=viewresult&p_idref=$obj->idref&p_pagename=$obj->name\" class=truelink>$obj->idref</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print("$obj->name");
     print("</td>");
     print("<td class=$l_class align=center width=20%>$obj->nbresult</td>");
     print("</tr>");
}
?>
</table>

<br>
