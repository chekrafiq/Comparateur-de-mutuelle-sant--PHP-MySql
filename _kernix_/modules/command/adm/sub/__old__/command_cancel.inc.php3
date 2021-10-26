<?php
// Get all infos from command
$l_sql = "SELECT * FROM $table_command WHERE idcommand = '$p_idcommand'";
$c_db->query($l_sql);
$l_row = $c_db->object_result();

$l_sql = "DELETE FROM $table_command where idcommand = '$p_idcommand'";
$c_db->query($l_sql);

$l_sql = "DELETE FROM $table_session where idnumsession = '$l_row->idnumsession'";
$c_db->query($l_sql);

show_response("Annulation effectuée");

print("<br>");

include("sub/home.inc.php3");

?>
