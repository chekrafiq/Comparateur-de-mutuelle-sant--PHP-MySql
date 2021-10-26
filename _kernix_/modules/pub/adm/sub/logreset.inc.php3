<?php

$l_sql = "DELETE FROM $table_publog WHERE idpub = '$p_idpub'";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_pub SET nbclick = 0, nbview = 0 WHERE idpub = '$p_idpub'";
$c_db->query($l_sql);

show_response("logs effacés.");
include("sub/list.inc.php3");

?>
