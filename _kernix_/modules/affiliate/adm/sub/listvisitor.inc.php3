<?php

$l_sql = "SELECT page, idlocal, date, page FROM $table_log WHERE bringer = '1' AND idbringer = '$p_idaffiliate' ORDER BY date DESC";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  show_reponse("aucun visiteur.");
  include("sub/view.inc.php3");
  return 0;
}

?>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
<tr><td class=color2 align=center colspan=3> >> visiteurs << </td></tr>
<?php

while ($obj = $c_db->object_result())
{
     print("<tr><td class=list align=center width=30%>" . show_datetime($obj->date) . "</td><td class=list align=left>&nbsp;&nbsp;$obj->page</td><td class=list align=center width=10%><a href=$g_urlroot/$g_modulespath/visitor/adm/index.php3?p_visitoraction=view&p_idvisitor=$obj->idlocal>$obj->idlocal</a></td></tr>");
}

?>

</table>
</td></tr></table>

<br><br>

<?php show_back_url("$PHP_SELF?p_affiliateaction=view&p_idaffiliate=$p_idaffiliate"); ?>








