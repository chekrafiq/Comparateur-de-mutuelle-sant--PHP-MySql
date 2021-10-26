<?php

$l_sql = "SELECT * FROM $table_form ORDER BY idform DESC LIMIT 0, 30";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun formulaire");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_formaction value=add>\n");
     print("<input type=submit value='créer un nouveau FORMULAIRE' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="85%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   N°
  </td>
  <td class="color2" align="center" width="45%">
   nom
  </td>
  <td class="color2" align="center" width="50%">
   sujet
  </td>
 </tr>

<?php
$i = 0;
while ($obj = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "listdark"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_formaction=view&p_idform=$obj->idform\" class=truelink>$obj->idform</a>");
     print("</td>");
     print("<td class=$l_class align=left>&nbsp;");
     print($obj->name);
     print("</td>");
     print("<td class=$l_class align=left>" . substr($obj->subject,0,50) . "...</td>");
     print("</tr>");
}
?>
</table>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_formaction value=add>
<input type=submit value='créer un nouveau FORMULAIRE' class=button>
</form>
