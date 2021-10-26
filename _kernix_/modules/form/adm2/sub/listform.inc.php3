<?php

$l_sql = "SELECT * FROM $table_form ORDER BY idform DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun formulaire");
     print("<br>");
     show_hr();
     print("<form action=$PHP_SELF method=post>");
     print("<input type=hidden name=p_formaction value=addform>");
     print("<input type=submit value='créer un nouveau formulaire' class=button>");
     print("</form>");
     return 0;
}

?>

<table align=center width=95%>

 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=center>
   nom
  </td>
  <td class=color2 align=center width=20%>
   nb reponses
  </td>
  <td class=color2 align=center width=20%>
   creation
  </td>
 </tr>

<?php
$i = 0;
while ($form = $c_db->object_result())
{
     if (($i++ % 2) == 0): $l_class = "color3"; else : $l_class = "listlight"; endif;
     print("<tr>");
     print("<td class=$l_class align=center>");
     print("<a href=\"$PHP_SELF?p_formaction=viewform&p_idform=$form->idform\" class=truelink>$form->idform</a>");
     print("</td>");
     print("<td class=$l_class align=center>");
     print("$form->name");
     print("</td>");
     print("<td class=$l_class align=center>$form->nbresults</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($form->date) . "</td>");
     print("</tr>");
}
?>
</table>

<form action=<?php print("$PHP_SELF"); ?> method=post>
<input type=hidden name=p_formaction value=addform>
<input type=submit value='créer un nouveau formulaire' class=button>
</form>






