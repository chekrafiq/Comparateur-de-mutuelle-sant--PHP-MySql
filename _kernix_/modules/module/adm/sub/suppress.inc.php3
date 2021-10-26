<?php

$l_sql = "DELETE FROM $table_module  WHERE idmodule = '$p_idmodule'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
