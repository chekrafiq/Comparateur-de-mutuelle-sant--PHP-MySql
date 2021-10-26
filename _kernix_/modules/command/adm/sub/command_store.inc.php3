<?php

$p_infos = addslashes($p_infos);

$l_sql = "UPDATE $table_command SET infos = '$p_infos', amountreceived = '$p_amountreceived', refpayment = '$p_refpayment', seller = '$p_seller', source = '$p_source' WHERE idcommand = '$p_idcommand'";
$c_db->query($l_sql);

show_response("enregistrement effectué");

include("sub/command_view.inc.php3");

?>
