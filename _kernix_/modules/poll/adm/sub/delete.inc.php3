<?php

$l_sql = "DELETE FROM $table_poll WHERE idpoll = '$p_idpoll'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_pollpost WHERE idpoll = '$p_idpoll'";
$c_db->query($l_sql);

include("sub/list.inc.php3");

?>
