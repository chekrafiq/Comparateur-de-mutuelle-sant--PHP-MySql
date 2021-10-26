<?php

$l_sql = "UPDATE $table_cron SET opt = '$p_opt', frequency = '$p_frequency' WHERE name = '$p_name'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/list.inc.php3");

?>


