<?php

include_once("../../../_kernix_/tables.inc.php3");
include_once("../../../_kernix_/var.inc.php3");

$l_sql = "SELECT * FROM $table_admsite, $table_admshop";
$c_db->query($l_sql);
$adm = $c_db->object_result();

$l_yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));

$l_year  = date("Y",$l_yesterday);
$l_month = date("m",$l_yesterday);
$l_day   = date("d",$l_yesterday);

$wday = date("w") + 0;
$mday = date("j") + 0;
$yday = date("z") + 0;

$l_freq = "'DAILY'";

if ($wday == 0) $l_freq .= ",'WEEKLY'";
if ($mday == 1) $l_freq .= ",'MONTHLY'";
if ($yday == 1) $l_freq .= ",'YEARLY'";

$l_sql = "SELECT name, opt FROM $table_cron WHERE frequency IN ($l_freq)";
$c_db->query($l_sql);

if (!($c_db->numrows > 0))
{
  $c_db->close();
  return 0;
}

while ($obj = $c_db->object_result())
{
  $tab_service[$obj->name] = $obj->opt;
}

foreach ($tab_service as $service => $option)
{
  if ($service == "bulkmail") $do_bulkmail = 1;
  else include("_" . $service . ".inc.php3");
}

if ($do_bulkmail == 1) include("_bulkmail.inc.php3");

$c_db->close();
return 1;

?>
