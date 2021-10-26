<?php

$l_sql = "DELETE FROM $table_supplier WHERE idsupplier = '$p_idsupplier'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
