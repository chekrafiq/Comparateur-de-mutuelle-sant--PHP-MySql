<?php

$l_sql = "DELETE FROM $table_owner  WHERE idowner = '$p_idowner'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
