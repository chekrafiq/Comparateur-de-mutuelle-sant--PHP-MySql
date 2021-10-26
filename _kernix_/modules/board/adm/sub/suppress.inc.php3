<?php

$l_sql = "DELETE FROM $table_board  WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_post  WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_ref SET idboard = 0 WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
