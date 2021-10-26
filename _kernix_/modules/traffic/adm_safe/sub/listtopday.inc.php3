<?php

$l_sql = "SELECT dayname(date) AS dname, count(date) AS tmp FROM $table_log WHERE newvis = '1' AND date_format(date,'%m') = '$p_nummonth' AND  date_format(date,'%Y') = '$p_year' GROUP BY dname ORDER BY tmp DESC";
$c_db->query($l_sql);

?>

<table bgcolor="black" border="0" cellspacing="0" cellpadding="0" align="center" valign="top" width="90%"><tr><td>
<table bgcolor="black" border="0" cellspacing="1" cellpadding="1" width="100%">
<tr><td class="color2" align="center" colspan="2"> &#187; jours &#171; </td></tr>


<?php
$n = $c_db->numrows;
for ($i=0;$i<$n;$i++)
{
     $dname = $c_db->result($i,"dname");
     $tmp = $c_db->result($i,"tmp");
     print("<tr><td class=list align=center>$dname</td>");
     print("<td class=list align=center width=10%>$tmp</td></tr>\n");
}
?>

</table>
</td></tr></table>




