<?php

$l_sql = "DELETE FROM $table_taxes  WHERE idtaxes = '$p_idtaxes'";
$c_db->query($l_sql);

show_response("effacement éffectué<br>");
include("sub/list.inc.php3");

?>
