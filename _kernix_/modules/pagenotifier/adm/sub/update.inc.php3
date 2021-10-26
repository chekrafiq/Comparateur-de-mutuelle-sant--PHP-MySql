<?php

$l_name = strtoupper($p_propertyname);
$l_sql = "UPDATE $table_property SET name = '$l_name', datas = '$p_datas', propertyflag = '$p_propertyflag', idowner = '$p_idowner' WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);

show_response("modification effectuée<br>");
include("sub/view.inc.php3");

?>
