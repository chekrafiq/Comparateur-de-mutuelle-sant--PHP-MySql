<?php

$l_sql = "UPDATE $table_board SET nbtopic = '0', nbpost = '0' WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_post WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/view.inc.php3");

?>
