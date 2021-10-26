<?php

$l_sql = "SELECT * FROM $table_post WHERE idpost = '$p_idpost' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$p_idboard = $obj->idboard;

if ($obj->level == 1)
{
  $l_sql = "DELETE FROM $table_post WHERE idpost = '$p_idpost'";
  $c_db->query($l_sql);
  if ($obj->validflag == 1)
  {
    $l_sql = "UPDATE $table_post SET nbreply = nbreply - 1 WHERE idparent = '$obj->idparent' AND level = '0'";
    $c_db->query($l_sql);
  }
}
else
{
  $l_sql = "DELETE FROM $table_post WHERE idparent = '$obj->idparent'";
  $c_db->query($l_sql);
  if ($obj->validflag == 1)
  {
    $l_sql = "UPDATE $table_board SET nbtopic = nbtopic - 1 WHERE idboard = '$p_idboard'";
    $c_db->query($l_sql);
  }
}

show_response("effacement effectué");
include("sub/topiclist.inc.php3");

?>
