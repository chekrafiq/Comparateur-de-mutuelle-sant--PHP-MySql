<?php

$l_sql = "SELECT * FROM $table_board ORDER BY idboard DESC LIMIT 0, 30";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun board");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_boardaction value=add>\n");
     print("<input type=submit value='créer un nouveau BOARD' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="98%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   n°
  </td>
  <td class="color2" align="center">
   titre
  </td>
  <td class="color2" align="center">
   type
  </td>
  <td class="color2" align="center">
   nb articles
  </td>
  <td class="color2" align="center" width="20%">
   dernier article
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
  print("<a href=\"$PHP_SELF?p_boardaction=view&p_idboard=$obj->idboard\" class=truelink>$obj->idboard</a>");
  print("</td>");
  print("<td class=$l_class align=center>");
  print($obj->title);
  print("</td>");
  print("<td class=$l_class align=center>");
  print($obj->type);
  print("</td>");
  print("<td class=$l_class align=center>$obj->nbpost</td>");
  print("<td class=$l_class align=center width=20%>" . show_date($obj->lastpostdate) . "</td>");
  print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
  print("</tr>");
}
?>
</table>
<br>

<?php show_hr(); ?>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_boardaction value=add>
<input type=submit value='créer un nouveau BOARD' class=button>
</form>

<?php show_hr(); ?>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_boardaction value=topicview>
n°&nbsp;<input type=text name=p_idpost size=8 class=text>&nbsp;
<input type=submit value='visualiser cet article' class=button>
</form>





