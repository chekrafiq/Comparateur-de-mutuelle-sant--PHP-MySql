<?php

$l_sql = "DELETE FROM $table_gbpost";
$c_db->query($l_sql);

show_response("le gustbook a �t� vid�");

include("sub/home.inc.php3");

?>
