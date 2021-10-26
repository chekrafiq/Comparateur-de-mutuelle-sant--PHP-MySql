<?php

$l_sql = "DELETE FROM $table_post  WHERE idformpost = '$p_idformpost'";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_form SET nbpost = nbpost - 1 WHERE idform = '$p_idform'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/postlist.inc.php3");

?>
