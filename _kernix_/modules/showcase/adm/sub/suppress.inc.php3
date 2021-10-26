<?php

$l_sql = "DELETE FROM $table_showcase  WHERE idshowcase = '$p_idshowcase'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_sp  WHERE idshowcase = '$p_idshowcase'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
