<?php

$table_log = "log";

$p_nummonth += 0;

$l_sql = "SELECT date_format(date,'%a %e') AS name, date_format(date,'%e') AS numday, count(idpub) AS nb FROM $table_log WHERE idpub > 0 AND date_format(date,'%c') = '$p_nummonth' AND date_format(date,'%Y') = '$p_year' GROUP BY name ORDER BY date";
$c_db->query($l_sql);

$i = 0;
while ($obj = $c_db->object_result())
{
  while ((($i+1) != $obj->numday) && (($i+1) <= 31))
  {
    $j = $i + 1;
    $l_data[$i][0] = $j;
    $l_data[$i][1] = 0;
//    print("->" . $l_data[$i][0] . " | " . $l_data[$i][1] . "<br>\n");
    $i++;
  }
  $l_data[$i][0] = $obj->name;
  $l_data[$i][1] = $obj->nb;
//  print("==>" . $l_data[$i][0] . " | " . $l_data[$i][1] . "<br>\n");
  $i++;
}

?>
