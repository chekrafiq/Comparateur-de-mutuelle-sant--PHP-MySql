<?php

if (!isset($p_flag) || ($p_val == $p_source))
{
  include("sub/home.inc.php3");
  return 0;
}

$l_sql = "UPDATE $table_product SET idport = $p_val WHERE idport = $p_source";
$c_db->query($l_sql);


show_response("modification(s) effectuée(s)");

include("sub/home.inc.php3");

return 0;

?>
