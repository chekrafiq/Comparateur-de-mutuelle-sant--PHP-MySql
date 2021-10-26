<?php

$l_sql = "UPDATE $table_module SET postit = '$p_postit' WHERE code = '$p_module'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


