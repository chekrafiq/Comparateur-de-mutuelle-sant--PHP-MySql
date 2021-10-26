<?php

$l_sql = "DELETE FROM $table_keywords";
$c_db->query($l_sql);

show_response("suppression éffectuée");

include("sub/home.inc.php3");

?>
