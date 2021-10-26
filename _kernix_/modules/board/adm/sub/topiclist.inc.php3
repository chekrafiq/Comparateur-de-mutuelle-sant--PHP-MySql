<?php

$l_sql = "SELECT * FROM $table_post WHERE level = '0' AND idboard = '$p_idboard' ORDER BY idpost DESC LIMIT 0, 300";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_response("aucun topic");
  show_hr();
  print("<form action=$PHP_SELF method=post>\n");
  print("<input type=hidden name=p_boardaction value=add>\n");
  print("<input type=submit value='créer un nouveau BOARD' class=button>\n");
  print("</form>\n");
  return 0;
}

?>

<table align="center" width="95%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   n°
  </td>
  <td class="color2" align="left">
   &nbsp; titre
  </td>
  <td class="color2" align="center">
   pseudo
  </td>
  <td class="color2" align="center">
   nb affichage
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
  if ($obj->validflag != 1)
  {
    $l_class = "warning";
  }
  print("<tr>");
  print("<td class=$l_class align=center>");
  print("<a href=\"$PHP_SELF?p_boardaction=topicview&p_idpost=$obj->idpost\" class=truelink title=\"voir le topic\">$obj->idpost</a>");
  print("</td>");
  print("<td class=$l_class align=left>");
  $l_nbreply = $obj->nbreply + 1;
  print("[ <a href=\"$PHP_SELF?p_boardaction=threadlist&p_idparent=$obj->idparent\" class=truelink title=\"voir le thread\">$l_nbreply</a> ] ");
  print($obj->title);
  print("</td>");
  print("<td class=$l_class align=center>");
  print($obj->nickname);
  print("</td>");
    print("<td class=$l_class align=center>");
  print($obj->nbview);
  print("</td>");
  print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
  print("</tr>");
}
?>
</table>
<br><br>

<?php show_hr(); ?>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idboard" value="<?php print("$p_idboard"); ?>">
 <select name="p_boardaction">
  <option value="topicadd">-- poster un nouvel article --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<?php show_back_url("$PHP_SELF?p_boardaction=view&p_idboard=$p_idboard"); ?>

