<?php

$table_board   = "board";
$table_post    = "boardpost";
$table_ref     = "ref";

$l_sql = "SELECT idref FROM $table_ref WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);
$p_idref = $c_db->result(0,"idref");

$l_sql = "SELECT * FROM $table_board WHERE idboard = '$p_idboard' ";
$c_db->query($l_sql);
$board = $c_db->object_result();

$p_format = strtoupper($p_format);

include("$l_incpath/$p_format.inc.php3");

?>
