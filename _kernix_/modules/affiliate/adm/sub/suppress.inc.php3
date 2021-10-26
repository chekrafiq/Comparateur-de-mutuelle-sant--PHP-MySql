<?php

$l_sql = "DELETE FROM $table_affiliate WHERE idaffiliate = '$p_idaffiliate'";
$c_db->query($l_sql);
show_response("effacement réalisé.");
include("sub/home.inc.php3");

?>
