<?php

$n = 30;

$l_sql = "SELECT idref, productcode, description, count(idsession) as tmp FROM $table_session WHERE date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' GROUP BY productcode ORDER BY tmp DESC LIMIT 0,$n";
$c_db->query($l_sql);

?>

<table width=98% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
<tr><td class=color2 align=center colspan=2> &#187; meilleures commandes &#171; </td></tr>

<?php

$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
     $p = "[ <a href=/$g_modulespath/site/adm/index.php3?p_idref=" . $c_db->result($i,"idref") . ">" . $c_db->result($i,"productcode") . "</a> ] " . $c_db->result($i,"description");
     $nb = $c_db->result($i,"tmp");
     print("<tr><td class=list align=center width=10%>$nb</td>");
     print("<td class=list align=left>&nbsp;$p</td></tr>");
}

?>

</table>


