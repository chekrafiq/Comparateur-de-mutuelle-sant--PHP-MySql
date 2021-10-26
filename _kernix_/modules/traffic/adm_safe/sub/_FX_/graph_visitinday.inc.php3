<?php

$table_log = "log";

$p_nummonth += 0;

$l_sql = "SELECT date_format(date,'%H') AS hour, count(idlog) AS nb FROM $table_log  WHERE newvis = '1' AND date_format(date,'%c') = '$p_nummonth' AND date_format(date,'%Y') = '$p_year' GROUP BY hour ORDER BY hour";
$c_db->query($l_sql);

$i = 0;
while ($i <= 23)
{
  $l_data[$i][0] = $i;
  $l_data[$i][1] = $obj->nb;
  $i++;
}

while ($obj = $c_db->object_result())
{
  $j = $obj->hour + 0;
//  $l_data[$j][0] = $obj->hour;
  $l_data[$j][1] = $obj->nb;
}

?>
