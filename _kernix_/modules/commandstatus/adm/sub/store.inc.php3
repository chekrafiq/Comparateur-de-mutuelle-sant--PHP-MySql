<?php


if ($p_commandstatusflag == "create")
{
  $l_sql = "INSERT INTO $table_commandstatus () VALUES ()";
  $c_db->query($l_sql);
  $p_idcommandstatus = $c_db->get_id();
}

$l_sql = "UPDATE $table_commandstatus SET name = '$p_name', status = '$p_status', mode = '$p_mode' WHERE idcommandstatus = '$p_idcommandstatus'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/list.inc.php3");

?>


