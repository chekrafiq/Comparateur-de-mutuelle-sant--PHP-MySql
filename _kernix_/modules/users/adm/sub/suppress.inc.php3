<?php

if (($p_idusers == 1) || ($p_idusers == 2))
{
     include("sub/list.inc.php3");
     return 0;
}

$l_sql = "DELETE FROM $table_users where idusers = $p_idusers";
$c_db->query($l_sql);

show_response("suppression effectuée");

print("<br>");

include("sub/list.inc.php3");

?>
