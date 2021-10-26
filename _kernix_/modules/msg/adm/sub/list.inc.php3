<form action="<?=$PHP_SELF?>" method="POST">
 <input type="hidden" name="p_msgaction" value="list">
 <input type="text"   name="p_keyword"  class="text" size="20">
 <input type="submit" value="search" class="button">
</form>

<?php show_hr(); ?>

<br>

<?php

if (!empty($p_keyword))
{
  $l_sql = "SELECT * FROM $table_msg WHERE description LIKE '%" . $p_keyword . "%' ORDER BY idmsg DESC";
}
else
{
  $l_sql = "SELECT * FROM $table_msg ORDER BY code";
}
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun msg");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_msgaction value=add>\n");
     print("<input type=submit value='créer un nouveau MSG' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="98%">

 <tr>
  <td class="color2" align="left" height="20">
   &nbsp; code
  </td>
  <td class="color2" align="left">
   &nbsp; titre
  </td>
  <td class="color2" align="center" width="20%">
   date
  </td>
 </tr>

<?php

$i = 0;
while ($obj = $c_db->object_result())
{
  if (($i++ % 2) == 0) $l_class = "listdark"; else  $l_class = "listlight";
  print("<tr>");
  print("<td class=$l_class align=left>&nbsp; <a href=\"$PHP_SELF?p_msgaction=view&p_idmsg=$obj->idmsg\" class=truelink>$obj->code</a></td>");
  print("<td class=$l_class align=left>&nbsp; $obj->title</td>");
  print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
  print("</tr>");
}

?>

</table>
<br><br>
<?php show_hr(); ?>
<br>
<form action=<?php print($PHP_SELF); ?> method="POST">
 <input type="hidden" name="p_msgaction" value="add">
 <input type="submit" value="créer un nouveau MSG" class="button">
</form>
