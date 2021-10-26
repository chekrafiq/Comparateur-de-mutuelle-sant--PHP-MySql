<?php

$l_sql = "SELECT * FROM $table_email WHERE idegroup = '$p_idegroup' AND status = 1 ORDER BY date DESC";
$c_db->query($l_sql);
if ($c_db->numrows == 0)
{
  show_response("aucun email");
  include("sub/egroup_view.inc.php3");
  print("<br>");
  return 0;
}
?>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=80%>
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
  print("<td class=list align=center width=60%><a href='mailto:$l_email' class=truelink>$l_email</a></td>");
  print("<td class=list align=center>" . show_datetime($obj->date) . "</td>");
  print("<td class=list align=center width=5%><a href=$g_urlroot/$g_modulespath/egroup/adm/index.php3?p_egroupaction=email_suppress&p_idemail=$obj->idemail&p_idegroup=$p_idegroup title=\"supprimer cet email\"> x </a></td></tr>");
}
?>

</table>
</td></tr></table>
<br><br>

<?php
show_back_url("$PHP_SELF?p_egroupaction=egroup_view&p_idegroup=$p_idegroup");
?>

