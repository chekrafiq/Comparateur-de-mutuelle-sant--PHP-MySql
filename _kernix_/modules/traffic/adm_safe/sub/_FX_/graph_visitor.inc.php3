<?php

$table_visitor = "visitor";
$l_sql = "SELECT date_format(firstvis,'%b') AS dt, date_format(firstvis,'%m') AS nummonth, count(idvisitor) AS nb FROM $table_visitor WHERE cookie = '1' AND date_format(firstvis,'%Y') = '$p_year' GROUP BY dt ORDER BY nummonth";
$c_db->query($l_sql);

$i = 0;
while ($obj = $c_db->object_result())
{
     $l_data[$i][0] = $obj->dt;
     $l_data[$i][1] = $obj->nb;
     $i++;
}

?>
