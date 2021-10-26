<?php

if (sizeof($p_tabproducts) <= 1) $l_crossproducts = $p_tabproducts[0];
else $l_crossproducts = implode(",",$p_tabproducts);

if (sizeof($p_tabpages) <= 1) $l_crosspages = $p_tabpages[0];
else $l_crosspages = implode(",",$p_tabpages);

$l_sql = "UPDATE $table_ref SET crossproducts = '$l_crossproducts', crosspages = '$l_crosspages', updatedate = '$l_date' WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/admin_view.inc.php3");

?>
