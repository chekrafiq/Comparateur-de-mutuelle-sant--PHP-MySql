<?php

if (!isset($command->idcommand))
{
  return 0;
}

$l_sql = "UPDATE $table_command SET status = '4' WHERE idcommand = '$command->idcommand' AND status = '3'";
$c_db->query($l_sql);

$l_sql = "UPDATE $table_session SET status = '4' WHERE numsession = '$command->numsession' AND status = '3'";
$c_db->query($l_sql);

include("$g_modulespath/command/sub/command_mail.inc.php3");

$g_design        = "zero";
$p_za            = "command";
$p_commandaction = "command_back";

$p_transacflag   = "OK";

$g_cookieflag = 0;

include("$g_designpath/index_site.inc.php3");

?>
