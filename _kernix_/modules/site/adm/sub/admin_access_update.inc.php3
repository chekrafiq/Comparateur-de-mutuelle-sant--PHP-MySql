<?php

if (sizeof($p_tabaccess) <= 1) $l_accesslist = $p_tabaccess[0];
else $l_accesslist = implode(",",$p_tabaccess);

if ($p_accessflag == 1) $l_cond = "nodekey BETWEEN '$p_nodekey' AND '$p_nodekey" . "ZZ'";
else $l_cond = "idref = '$p_idref'";

$l_sql = "UPDATE $table_ref SET accesslist = '$l_accesslist', updatedate = '$l_date' WHERE $l_cond";
$c_db->query($l_sql);

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/admin_view.inc.php3");

?>
