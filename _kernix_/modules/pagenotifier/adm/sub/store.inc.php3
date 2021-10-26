<?php

$l_sql = "SELECT * FROM $table_property WHERE name = '$p_propertyname'";
$c_db->query($l_sql);


if ($c_db->numrows > 0)
{
     show_response("le nom existe déjà");
     include("sub/list.inc.php3");
     return 0;
}

$l_name = strtoupper($p_propertyname);
$l_sql = "INSERT INTO $table_property (name,datas,propertyflag,idowner) VALUES ('$l_name','$p_datas','$p_propertyflag','$p_idowner')";
$c_db->query($l_sql);
show_response(" $l_sql enregistrement effectué");
include("sub/list.inc.php3");

?>


