<?php

$l_sql = "DELETE FROM $table_egroup WHERE idegroup = '$p_idegroup'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_email WHERE idegroup = '$p_idegroup'";
$c_db->query($l_sql);

show_response("egroup supprimé");
include("sub/egroup_suppress.inc.php3");

?>
