<?php

if (!isset($p_flag))
{
  include("sub/home.inc.php3");
  return 0;
}

$l_sql = "UPDATE $table_product SET price = " . $p_mode  . "(price)";
$c_db->query($l_sql);

show_response("modification(s) effectuée(s)");

include("sub/home.inc.php3");

return 0;

?>
