<?php

$l_sql = "UPDATE $table_rating SET rate1 = '$p_rate1', rate2 = '$p_rate2', rate3 = '$p_rate3', rate4 = '$p_rate4', rate5 = '$p_rate5'  WHERE idrating = 1";
$c_db->query($l_sql);

show_response("modification effectuée<br>");
include("sub/viewrating.inc.php3");

?>
