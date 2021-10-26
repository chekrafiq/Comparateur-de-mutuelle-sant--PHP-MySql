<?php

$l_sql = "DELETE FROM $table_email WHERE idsource = '$p_idaddressbook' AND idegroup = '2'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_addressbook  WHERE idaddressbook = '$p_idaddressbook' ";
$c_db->query($l_sql);

show_response("suppression effectuée.");
include("sub/list.inc.php3");

?>
