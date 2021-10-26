<?php

$l_sql = "SELECT * FROM $table_module ORDER BY code";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun module");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_moduleaction value=add>\n");
     print("<input type=submit value='créer un nouveau MODULE' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="85%">

 <tr>
  <td class="color2" width="25%" align="center" height="20">
   code
  </td>
  <td class="color2" align="center">
   name
  </td>
 </tr>

<?php

$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  if ($obj->subscribeflag != 1) $l_class = "warning";
  if ($obj->superuserflag == 1) $l_class = "hotwarning";

  print("<tr>");
  print("<td class=$l_class align=center>");
  print("<a href=\"$PHP_SELF?p_moduleaction=view&p_idmodule=$obj->idmodule\" class=truelink>$obj->code</a>");
  print("</td>");
  print("<td class=$l_class align=center>$obj->name</td>");
  print("</tr>");
}

?>

</table>

<br><br>

<?php show_hr(); ?>

<form action=<?=$PHP_SELF?> method="POST">
 <input type="hidden" name="p_moduleaction" value="add">
 <input type="submit" value="créer un nouveau MODULE" class="button">
</form>
