<?php

$table_log = "log";
$l_sql = "SELECT date_format(date,'[%u]') AS name, date_format(date,'%m') AS nummonth, date_format(date,'%u') AS numweek, count(idlog) AS nb FROM $table_log  WHERE newvis = 1 AND  date LIKE '$p_year-%' GROUP BY name ORDER BY nummonth, numweek";
$c_db->query($l_sql);

$i = 0;
while ($obj = $c_db->object_result())
{
     $l_data[$i][0] = $obj->name;
     $l_data[$i][1] = $obj->nb;
     $i++;
}

?>
