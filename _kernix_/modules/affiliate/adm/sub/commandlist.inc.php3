<?php

$l_sql = "SELECT * FROM $table_command WHERE idaffiliate = '$p_idaffiliate' ORDER BY date DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucune commande."); 
     return 0;
}

?>

<table align=center valign=top width=98%>
 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center>
   description
  </td>
  <td class=color2 width=15% align=center>
   prix
  </td>
  <td class=color2 width=15% align=center>
   date
  </td>
 </tr>

<?php

$i = 0;
while ($command = $c_db->object_result())
{
  if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
  print("<tr>");
  print("<td class=$l_class align=center><a href=\"/_kernix_/modules/command/adm/index.php3?p_commandadmaction=view_command&p_idcommand=$command->idcommand\" class=truelink>$command->idcommand</a></td>");
  print("<td class=$l_class align=center>" . ereg_replace(";","<br>",$command->description) . "</td>");
  print("<td class=$l_class align=center>$command->price</td>");
  print("<td class=$l_class align=center>" . show_date($command->date) . "</td>");
  print("</tr>");
}

?>

</table>

<br>

<?php show_back(); ?>
