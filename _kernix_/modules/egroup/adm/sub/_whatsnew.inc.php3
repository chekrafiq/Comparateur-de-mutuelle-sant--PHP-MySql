<?php

$l_sql = "SELECT EM.*, EG.name AS egname FROM $table_email AS EM, $table_egroup AS EG WHERE EM.idegroup = EG.idegroup AND EM.status = 1 AND EM.date >= '$l_lastsession' ORDER BY date DESC";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
  show_response("aucun email");
  print("<br>");
  return 0;
}
?>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=95%>
<tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>

<?php
while ($obj = $c_db->object_result())
{
  $l_idvisitor = $obj->idvisitor;
  $l_email = $obj->email;
  if ($l_idvisitor != 0)
  {
    print("<tr><td class=list align=center width=5%><a href=$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$l_idvisitor>$l_idvisitor</a></td>");
  }
  else
  {
    print("<tr><td class=list align=center width=5%>0</td>");  
  }
  print("<td class=list align=center><a href='mailto:$l_email' class=truelink>$l_email</a></td>");
  print("<td class=list align=center>$obj->egname</td>");
  print("<td class=list align=center>" . show_datetime($obj->date) . "</td>");
  print("</tr>");
}
?>

</table>
</td></tr></table>
<br><br>

<?php
show_back_url("$PHP_SELF?p_egroupaction=egroup_view&p_idegroup=$p_idegroup");
?>

