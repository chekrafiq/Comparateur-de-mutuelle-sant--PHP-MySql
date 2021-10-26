<?php

$l_sql = "SELECT P.*, F.name AS fname FROM $table_post AS P, $table_form AS F WHERE P.idform = F.idform AND P.date >= '$l_lastsession' ORDER BY date DESC";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
  show_response("aucun post"); 
  return 1;
}

?>

<table align="center" width="95%">
 <tr>
  <td class="color2" align="center" width="5%">
   idvisitor
  </td>
  <td class="color2" align="center" width="10%">
   form
  </td>
  <td class="color2" align="center" width="10%">
   date
  </td>
  <td  align="center" width="2%">
   &nbsp;
  </td>
 </tr>

<?php
$i = 0;
$tmp = $c_db->numrows;
while ($i < $tmp)
{
  if (($i % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
  $l_idvisitor = $c_db->result($i,"idvisitor");
  print("<tr>");
  print("<td class=$l_class align=center><a href=\"$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$l_idvisitor\" class=truelink>$l_idvisitor</a></td>\n");
  print("<td class=$l_class align=center>" . $c_db->result($i,"fname") . "</td>");
  print("<td class=$l_class align=center>" . show_datetime($c_db->result($i,"date")) . "</td>");
  print("<td class=$l_class align=center>");
  print("<a href=\"$g_urlroot/$g_modulespath/form/adm/index.php3?p_formaction=postview&p_idform=$p_idform&p_idformpost=" . $c_db->result($i,"idformpost") . "\" class=truelink><img src=/pictures/poll/msg.gif border=0></a></td>");
  print("</tr>");
  $i++;
}
?>
</table>

<br><br>
