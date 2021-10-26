<?php


$l_sql = "SELECT * FROM $table_poll ORDER BY idpoll DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("no poll"); 
  show_hr();
  print("<form action=$PHP_SELF method=post><input type=hidden name=p_pollaction value=add><input type=submit value='créer un nouveau vote' class=button></form>");
  return 1;
}

?>

<table align=center width=85%>
 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center>
   nom
  </td>
  <td class=color2 align=center width=15%>
   nb clicks
  </td>
  <td class=color2 align=center width=20%>
   création
  </td>
 </tr>

<?php
$i = 0;
while ($poll = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center><a href=\"$PHP_SELF?p_pollaction=view&p_idpoll=$poll->idpoll\" class=truelink>$poll->idpoll</a></td>");
     print("<td class=$l_class align=center>");
     print("$poll->name");
     print("</td>");
     print("<td class=$l_class align=center>$poll->nbclick</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($poll->date) . "</td>");
     print("</tr>");
}

?>

</table>

<br><br>

<?php show_hr(); ?>

<form action="<?php print($PHP_SELF); ?>" method="POST">
 <input type="hidden" name="p_pollaction" value="add">
 <input type="submit" value="créer un nouveau vote" class="button">
</form>









