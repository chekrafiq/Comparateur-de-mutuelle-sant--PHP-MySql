<?php

$l_sql = "DELETE FROM $table_gallery  WHERE idgallery = '$p_idgallery'";
$c_db->query($l_sql);

show_response("effacement effectué<br>");
include("sub/list.inc.php3");

?>
