<?php

$l_sql = "DELETE FROM $table_sp  WHERE idref = '$p_idref' AND idshowcase = '$p_idshowcase'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/view.inc.php3");

?>
