<?php

$l_sql = "DELETE FROM $table_pub WHERE idpub = '$p_idpub'";
$c_db->query($l_sql);

show_response("suppression effectu�e.");
include("sub/listpub.inc.php3");

?>
