<?php

$l_sql = "SELECT page, date, newvis  FROM $table_log WHERE idvisitor = '$p_idvisitor' ORDER BY date DESC";
$c_db->query($l_sql);
?>

<table width=98% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>

<?php

while ($obj = $c_db->object_result())
{
  print("<tr><td class=list>&nbsp; $obj->page</td><td class=list width=28% align=center>" . show_datetimesec($obj->date) . "</td></tr>");
  if ($obj->newvis == 1) print("</table><br><br><table width=98% bordercolor=black bgcolor=black border=0 cellpadding=1 cellspacing=1 align=center>");
}

?>

</table>

<br>


<?php

show_back();

?>
