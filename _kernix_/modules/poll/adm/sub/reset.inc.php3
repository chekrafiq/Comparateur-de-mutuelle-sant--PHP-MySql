<?php

$l_sql = "UPDATE $table_poll SET nbclick = '0', nbclick1 = '0', nbclick2 = '0', nbclick3 = '0', nbclick4 = '0', nbclick5 = '0', nbclick6 = '0', nbclick7 = '0', nbclick8 = '0', nbclick9 = '0', nbclick10 = '0' WHERE idpoll = '$p_idpoll'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_pollpost WHERE idpoll = '$p_idpoll'";
$c_db->query($l_sql);

include("sub/view.inc.php3");

?>
