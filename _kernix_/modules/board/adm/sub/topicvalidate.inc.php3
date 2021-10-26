<?php

 $l_sql = "SELECT * FROM $table_post WHERE idpost = '$p_idpost'";
$c_db->query($l_sql);
$post = $c_db->object_result();

$l_sql = "UPDATE $table_post SET validflag = '1' WHERE idpost = '$p_idpost'";
$c_db->query($l_sql);
if ($post->level == 1)
{
  $l_sql = "UPDATE $table_board SET nbtopic = nbtopic + 1 WHERE idboard = '$p_idboard'";
  $c_db->query($l_sql);
}
else
{
  $l_sql = "UPDATE $table_post SET nbreply = nbreply + 1 WHERE idparent = '$post->idparent' AND level = '0'";
  $c_db->query($l_sql);
}

include("sub/topiclist.inc.php3");

?>
