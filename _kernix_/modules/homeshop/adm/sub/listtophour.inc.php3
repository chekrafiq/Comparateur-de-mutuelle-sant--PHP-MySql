<?php

$l_sql = "SELECT date_format(date,'%H') AS hour, count(idsession) AS n FROM $table_session WHERE status > 0 AND date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' GROUP BY hour ORDER BY n DESC LIMIT 0,12";
$c_db->query($l_sql);
$n = $c_db->numrows;

?>

<table width=90% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
<tr><td class=color2 align=center colspan=2> &#187; meilleures heures &#171; </td></tr>

<?php
for ($i=0;$i<$n;$i++)
{
  $l_hour = $c_db->result($i,"hour");
  $l_n = $c_db->result($i,"n");
  print("<tr><td class=list align=center width=10%>$l_n</td><td class=list align=center>$l_hour</td></tr>\n");
}

?>

</table>


