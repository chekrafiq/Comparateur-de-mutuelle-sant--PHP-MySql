<?php

$l_sql = "SELECT * FROM $table_mailing WHERE idegroup = '$p_idegroup' ORDER BY date DESC";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
  show_response("auncun mailing"); 
  print("<br>");
  include("sub/egroup_list.inc.php3");
  return 0;
}

?>

<table align=center width=95%>
 <tr>
  <td class=color2 width=5% align=center>
   id
  </td>
  <td class=color2 width=5% align=center width=20%>
   nom
  </td>
  <td class=color2 align=center width=30%>
   sujet
  </td>
  <td class=color2 align=center>
   nb email
  </td>
  <td class=color2 align=center width=5%>
   nb visiteurs
  </td>
  <td class=color2 align=center width=1%>
   date
  </td>
</tr>

<?php
$i = 0;
while ($mailing = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     if ($mailing->status == 1) $l_class = "warning";
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_egroupaction=mailing_view&p_idmailing=$mailing->idmailing\" class=truelink>$mailing->idmailing</a>");
     print("</td>");
     print("<td class=$l_class align=center width=10%>$mailing->name</td>");
     print("<td class=$l_class align=center>");
     print("$mailing->subject");
     print("</td>");
     print("<td class=$l_class align=center>");
     print("$mailing->nbemail");
     print("</td>");
     print("<td class=$l_class align=center width=10%>$mailing->nbvisitor</td>");
     $l_tab = explode(" ",$mailing->date);
     $l_shortdate = explode("-",$l_tab[0]);
     print("<td class=$l_class align=center width=30%>$l_shortdate[2]/$l_shortdate[1]/$l_shortdate[0]</td>");
     print("</tr>");
}
?>
</table>
<br>

<?php show_back(); ?>





