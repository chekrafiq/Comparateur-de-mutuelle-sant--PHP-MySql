<?php

$l_sql = "UPDATE $table_gb SET moderatorflag = '$p_moderatorflag', notificationflag = '$p_notificationflag', email = '$p_email'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/home.inc.php3");

?>
