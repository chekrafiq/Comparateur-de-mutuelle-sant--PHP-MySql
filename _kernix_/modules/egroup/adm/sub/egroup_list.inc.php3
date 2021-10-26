<?php

$l_sql = "SELECT * FROM $table_egroup ORDER BY idegroup DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
     show_response("aucun egroup."); 
     print("<form action=$PHP_SELF method=post>");
     print("<select name=p_egroupaction>");
     print("<option value=egroup_add>-- ajouter un egroup --</option>");
     print("</select>");
     print("&nbsp; <input type=submit value=exécuter class=button>");
     print("</form>");
     return 0;
}

?>

<table align=center width=85%>
 <tr>
  <td class=color2 width=5% align=center height=20>
   id
  </td>
  <td class=color2 align=left>
   &nbsp; nom
  </td>
  <td class=color2 align=center>
   sujet
  </td>
  <td class=color2 align=center>
   dernier message
  </td>
 </tr>

<?php
$i = 0;
while ($egroup = $c_db->object_result())
{
     if (($i++ % 2) == 0) $l_class = "color3"; else  $l_class = "listlight"; 
     $l_img = "";
     if ($egroup->idegroup <= 4) $l_img = "<img src=/pictures/protected.gif hspace=3 align=absbottom>";
     print("<tr>");
     print("<td class=$l_class align=center>");
      print("<a href=\"$PHP_SELF?p_egroupaction=egroup_view&p_idegroup=$egroup->idegroup\" class=truelink>$egroup->idegroup</a>");
      print("</td>");
     print("<td class=$l_class align=left>&nbsp; $egroup->name $l_img</td>");
     print("<td class=$l_class align=center>$egroup->subject</td>");
     print("<td class=$l_class align=center width=20%>" . show_date($egroup->lastmsgdate)  . "</td>");
     print("</tr>");
}
print("</table>");
?>

<br>

<form action"<?php print("$PHP_SELF")?>" method=post>
 <select name=p_egroupaction>
  <option value="egroup_add">-- ajouter un egroup --</option>
  <option value="mailing_list">-- archives des mailings --</option>
  <option value="profile_view">-- gestion du profil --</option>
  <option value="mailing_new">-- envoyer un mail global --</option>
  <option value="email_suppress_form">-- supprimer une liste d'emails --</option>
 </select>
 &nbsp; <input type=submit value="exécuter" class=button>
</form>
<br><br><br>

<?php
show_hr();
?>

<form method=post action="<?php print("$PHP_SELF"); ?>" > 

<input type=hidden name="p_egroupaction" value="email_suppress">
<input type=text name=p_email class=text size=40> 
&nbsp; <input type=submit value='supprimer cet email' class=button> 

</form>

