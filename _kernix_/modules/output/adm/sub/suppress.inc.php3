<?php

$l_sql = "DELETE FROM $table_output  WHERE idoutput = '$p_idoutput'";
$c_db->query($l_sql);

show_response("effacement effectu�<br>");
include("sub/list.inc.php3");

?>
