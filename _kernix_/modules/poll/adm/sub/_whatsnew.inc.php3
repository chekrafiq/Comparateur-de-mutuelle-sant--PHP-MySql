<?php

$l_sql = "SELECT PP.idvisitor, PP.idpoll AS lidpoll, PP.choice AS lchoice, PP.date AS ldate, P.* FROM $table_poll AS P, $table_pollpost AS PP WHERE PP.idpoll = P.idpoll AND PP.date >= '$l_lastsession' ORDER BY PP.date DESC";
$c_db->query($l_sql);
//echo $l_sql;
?>

<table align="center" width="85%">
 <tr>
  <td class="color2" width="5%" align="center" height="20">id</td>
  <td class="color2" align="center">post</td>
  <td class="color2" align="center" width="20%">date</td>
 </tr>

<?php

$i = 0;
$n = $c_db->numrows;

while ($i < $n)
{
  $l_lchoice = $c_db->result($i,"lchoice");
  $l_idvisitor = $c_db->result($i,"idvisitor");
  $l_label = $c_db->result($i,"label");
  $l_option = $c_db->result($i,"option" . $l_lchoice);
  $l_ldate = $c_db->result($i,"ldate");
  if (($j++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
  print("<tr>");
  print("<td class=$l_class align=center><a href=\"$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$l_idvisitor\" class=truelink>$l_idvisitor</a></td>");
  print("<td class=$l_class align=center>");
  print("$l_label > <br>");
  print($l_option);
  print("</td>");
  print("<td class=$l_class align=center>" . show_datetime($l_ldate) . "</td>");
  print("</tr>");
  $i++;
  $j++;
}

?>

</table>

<br>








