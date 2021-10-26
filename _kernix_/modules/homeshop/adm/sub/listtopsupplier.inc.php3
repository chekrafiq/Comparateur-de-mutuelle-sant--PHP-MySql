<?php

$n = 5;

$l_sql = "SELECT SU.name AS name, sum(SE.pricettc) AS n, count(SE.idsession) AS n2 FROM $table_session AS SE, $table_supplier AS SU WHERE SE.status = 20 AND date_format(SE.date,'%m') = '$p_nummonth' AND  date_format(SE.date,'%Y') = '$p_year' AND SE.idsupplier = SU.idsupplier GROUP BY SE.idsupplier ORDER BY n DESC LIMIT 0,$n";
$c_db->query($l_sql);
//print("$l_sql");
$n = $c_db->numrows;

?>

<table width=90% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>
<tr><td class=color2 align=center colspan=2> &#187; CA / supplier &#171; </td></tr>

<?php
for ($i=0;$i<$n;$i++)
{
  $l_name = $c_db->result($i,"name");
  $l_n = sprintf("%.2f",$c_db->result($i,"n"));
  $l_n2 = $c_db->result($i,"n2");
  print("<tr><td class=list align=center width=25%>$l_n</td><td class=list align=left> &nbsp; $l_name [$l_n2]</td></tr>\n");
}

?>

</table>
