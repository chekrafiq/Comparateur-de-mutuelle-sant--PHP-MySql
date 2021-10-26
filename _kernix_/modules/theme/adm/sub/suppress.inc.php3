<?php

$l_sql = "DELETE FROM $table_theme  WHERE idtheme = '$p_idtheme'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
