<?php

$l_sql = "SELECT * FROM $table_commandstatus ORDER BY mode,status";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun commandstatus");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_commandstatusaction value=add>\n");
     print("<input type=submit value='créer un nouveau STATUT' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="98%">

 <tr>
  <td class="color2" align="center" width="10%" height="20">
   mode
  </td>
  <td class="color2" align="center" width="10%">
   status
  </td>
  <td class="color2" align="left">
   &nbsp; name
  </td>
 </tr>

<?php

$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  print("<tr>");
  print("<td class=$l_class align=center>$obj->mode</td>");
  print("<td class=$l_class align=center>$obj->status</td>");
  print("<td class=$l_class align=left>&nbsp; <a href=\"$PHP_SELF?p_commandstatusaction=view&p_idcommandstatus=$obj->idcommandstatus\" class=truelink>$obj->name</a></td>");

  print("</tr>");
}

?>

</table>
<br><br>

<?php show_hr()?>

<br>
<form action=<?php print($PHP_SELF); ?> method="POST">
 <input type="hidden" name="p_commandstatusaction" value="add">
 <input type="submit" value="créer un nouveau STATUT" class="button">
</form>
