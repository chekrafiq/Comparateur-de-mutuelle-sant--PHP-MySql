<?php

$table_board   = 'board';
$table_post    = 'boardpost';
$table_egroup  = 'egroup';
$table_email   = 'email';
$table_theme   = 'theme';

$l_sql = "SELECT * FROM $table_board WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);
$board = $c_db->object_result();

$ref->updatedate = $board->lastpostdate;

print("<LINK HREF=$g_skinpath/$g_skin/" . strtolower($board->type) . ".css REL=stylesheet TYPE=text/css>");

if (!isset($p_boardaction))
{
  $p_boardaction = "home";
}

$l_incpath = "$g_modulespath/board/sub/" . $board->type;
include("$l_incpath/$p_boardaction.inc.php3");

?>
