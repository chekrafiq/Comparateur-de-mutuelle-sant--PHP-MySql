<?php

if (!isset($p_flag) || ($p_val == $p_source))
{
  include("sub/home.inc.php3");
  return 0;
}

$l_sql = "UPDATE $table_product SET idsupplier = $p_val WHERE idsupplier = $p_source";
$c_db->query($l_sql);

show_response("modification(s) effectu?e(s)");

include("sub/home.inc.php3");

return 0;

?>
