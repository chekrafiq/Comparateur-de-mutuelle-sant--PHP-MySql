<?php

$l_sql = "SELECT * FROM $table_theme ORDER BY idtheme DESC LIMIT 0, 30";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun theme");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_themeaction value=add>\n");
     print("<input type=submit value='créer un nouveau THEME' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="75%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center">
   name
  </td>
  <td class="color2" align="center">
   type
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
     print("<a href=\"$PHP_SELF?p_themeaction=view&p_idtheme=$obj->idtheme\" class=truelink>$obj->idtheme</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->name);
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->type);
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>
<br><br>

<?php show_hr(); ?>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_themeaction value=add>
<input type=submit value='créer un nouveau THEME' class=button>
</form>






