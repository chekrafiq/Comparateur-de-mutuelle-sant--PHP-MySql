<?php

$l_name = strtoupper($p_propertyname);

$l_structure = ereg_replace("\n", "", $p_structure);
$l_structure = ereg_replace("\r", "", $l_structure);
$l_structure = trim($l_structure);

$l_sql = "UPDATE $table_property SET propertyname = '$l_name', structure = '$l_structure', idowner = '$p_idowner' WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);

show_response("modification effectuée<br>");
include("sub/view.inc.php3");
?>
