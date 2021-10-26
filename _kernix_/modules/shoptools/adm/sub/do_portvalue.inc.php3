<?php

if (!isset($p_flag))
{
  include("sub/home.inc.php3");
  return 0;
}

$l_sql = "UPDATE $table_product SET port_value = $p_val";
if ($p_mode == "zero")
{
  $l_sql .= " WHERE port_value = 0";
}
$c_db->query($l_sql);

show_response("modification(s) effectuée(s)");

include("sub/home.inc.php3");

return 0;

?>
