<?php

$l_sql = "DELETE FROM $table_basic  WHERE idbasic = '$p_idbasic'";
$c_db->query($l_sql);

show_response("effacement effectu�<br>");
include("sub/list.inc.php3");

?>
