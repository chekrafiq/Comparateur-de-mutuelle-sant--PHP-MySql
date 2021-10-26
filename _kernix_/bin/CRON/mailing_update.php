.<?php

include_once("../../../_kernix_/tables.inc.php3");
include_once("../../../_kernix_/var.inc.php3");


list($l_idmailing,$l_nbactual) = explode("-",$argv[1]);
$l_sql = "UPDATE $table_mailing SET nbactual = '$l_nbactual', enddate = '$l_date' WHERE idmailing = $l_idmailing";
$c_db->query($l_sql);

?>
