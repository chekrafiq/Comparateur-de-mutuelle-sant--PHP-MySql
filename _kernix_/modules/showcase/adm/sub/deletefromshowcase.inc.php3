<?php

$l_sql = "DELETE FROM $table_showcase WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("suppression effectu�e.");
include("sub/listshowcase.inc.php3");
?>
