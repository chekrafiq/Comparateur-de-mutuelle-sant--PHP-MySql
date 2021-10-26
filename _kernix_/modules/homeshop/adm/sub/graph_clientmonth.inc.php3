<?php

$table_client = "client";

$l_sql = "SELECT date_format(date,'%b') AS dt, date_format(date,'%m') AS nummonth, count(idclient) AS nb FROM $table_client WHERE nbpurchase >= 1 AND date_format(date,'%Y') = '$p_year' GROUP BY dt ORDER BY nummonth";
$c_db->query($l_sql);

$i = 0;
while ($obj = $c_db->object_result())
{
     $l_data[$i][0] = $obj->dt;
     $l_data[$i][1] = $obj->nb;
     $i++;
}

?>
