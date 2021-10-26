<?php

$l_sql = "DELETE FROM $table_form  WHERE idform = '$p_idform'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_result  WHERE idform = '$p_idform'";
$c_db->query($l_sql);

show_response("effacement éffectué<br>");
include("sub/listform.inc.php3");

?>
