<?php

$l_sql = "SELECT * FROM $table_owner ORDER BY idowner DESC LIMIT 0, 30";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun owner");
     show_hr();
     print("<form action=$PHP_SELF method=post>\n");
     print("<input type=hidden name=p_owneraction value=add>\n");
     print("<input type=submit value='cr�er un nouveau OWNER' class=button>\n");
     print("</form>\n");
     return 0;
}

?>

<table align="center" width="85%">

 <tr>
  <td class="color2" width="5%" align="center" height="20">
   id
  </td>
  <td class="color2" align="center">
   login
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
     print("<a href=\"$PHP_SELF?p_owneraction=view&p_idowner=$obj->idowner\" class=truelink>$obj->idowner</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print($obj->login);
     print("</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($obj->date) . "</td>");
     print("</tr>");
}
?>
</table>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_owneraction value=add>
<input type=submit value='cr�er un nouveau OWNER' class=button>
</form>






