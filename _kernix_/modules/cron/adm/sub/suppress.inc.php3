<?php

$l_sql = "DELETE FROM $table_cron  WHERE idcron = '$p_idcron'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
