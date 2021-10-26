<?php

$l_name = strtoupper($p_name);
$l_sql = "UPDATE $table_poll SET name = '$l_name', label = '$p_label', option1 = '$p_option1', option2 = '$p_option2', option3 = '$p_option3', option4 = '$p_option4', option5 = '$p_option5', option6 = '$p_option6', option7 = '$p_option7', option8 = '$p_option8', option9 = '$p_option9', option10 = '$p_option10', owner = '$p_owner', viewable = '$p_viewable' WHERE idpoll = '$p_idpoll'";
$c_db->query($l_sql);

show_response("modification effectuée<br>");
include("sub/viewpoll.inc.php3");

?>
