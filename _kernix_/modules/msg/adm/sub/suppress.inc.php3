<?php

$l_sql = "DELETE FROM $table_msg  WHERE idmsg = '$p_idmsg'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
