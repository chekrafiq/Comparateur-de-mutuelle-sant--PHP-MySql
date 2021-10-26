<?php

if (isset($p_tabdelete))
$l_del = implode(",",$p_tabdelete);

if (isset($p_tabvalidate))
$l_validate = implode(",",$p_tabvalidate);

if (isset($l_del))
{
  $l_sql = "DELETE FROM $table_gbpost WHERE idpost IN ($l_del)";
  $c_db->query($l_sql);
}

if (isset($l_validate))
{
  $l_sql = "UPDATE $table_gbpost SET validflag = '1' WHERE idpost IN ($l_validate)";
  $c_db->query($l_sql);
}

show_response("OK");

include("sub/home.inc.php3");

?>
