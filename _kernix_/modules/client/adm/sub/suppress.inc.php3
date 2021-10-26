<?php

$l_sql = "UPDATE $table_client SET login = '', password = '', clientflag = '0' WHERE idclient = '$p_idclient'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
