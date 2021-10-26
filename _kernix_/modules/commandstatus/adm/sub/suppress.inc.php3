<?php

$l_sql = "DELETE FROM $table_commandstatus  WHERE idcommandstatus = '$p_idcommandstatus'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
