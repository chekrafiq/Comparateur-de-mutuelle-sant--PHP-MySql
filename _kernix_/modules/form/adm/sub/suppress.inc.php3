<?php

$l_sql = "DELETE FROM $table_form  WHERE idform = '$p_idform'";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_ref SET idform = 0 WHERE idform = '$p_idform'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
