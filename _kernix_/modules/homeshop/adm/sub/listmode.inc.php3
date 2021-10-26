<?php

$l_sql = "SELECT mode, count(idcommand) AS n FROM $table_command WHERE status = 20 AND date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' GROUP BY mode ORDER BY n DESC";
$c_db->query($l_sql);
$n = $c_db->numrows;

?>

<table width=90% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
<tr><td class=color2 align=center colspan=2> &#187; modes de paiement &#171; </td></tr>

<?php
for ($i=0;$i<$n;$i++)
{
  $l_mode = $c_db->result($i,"mode");
  $l_n = $c_db->result($i,"n");
  print("<tr><td class=list align=center width=10%>$l_n</td><td class=list align=center>$l_mode</td></tr>\n");
}

?>

</table>


