<?php

$l_sql = "DELETE FROM $table_property WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);

show_response("effacement effectu�");
include("sub/list.inc.php3");

?>
