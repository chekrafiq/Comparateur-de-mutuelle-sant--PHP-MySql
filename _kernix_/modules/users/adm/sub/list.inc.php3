<?php

$l_sql = "SELECT * FROM $table_users WHERE idusers > 1 ORDER BY idusers DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("auncun utilisateur défini.");
     include("sub/list_actionbar.inc.php3");
     return 0;
}

?>

<table align=center width=90%>
 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center>
   login
  </td>
  <td class=color2  width=15% align=center>
   nom
  </td>
  <td class=color2  width=15% align=center>
   pouvoir
  </td>
  <td class=color2  width=15% align=center>
   nb connect
  </td> 
  <td class=color2  width=15% align=center>
   date
  </td>
  
 </tr>

<?php
$i = 0;
while ($l_users = $c_db->object_result())
{
     $l_power = "user";
     if ($l_users->power == 1) $l_power = "admin";
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_idusers=$l_users->idusers&p_usersaction=view\" class=truelink>$l_users->idusers</a>");
     print("</td>");
     print("<td class=$l_class align=center>$l_users->login</td>");
     print("<td class=$l_class align=center>$l_users->lastname</td>");
     print("<td class=$l_class align=center>$l_power</td>");
     print("<td class=$l_class align=center>$l_users->nbconnect</td>");
     print("<td class=$l_class align=center>" . show_date($l_users->creationdate) . "</td>");
     print("</tr>");
}
?>
</table>

<br>

<?php include("sub/list_actionbar.inc.php3"); ?>




