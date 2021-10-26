<?php

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$p_numsession'";
$c_db->query($l_sql);

if (!($c_db->numrows > 0))
{
  print("ERREUR : numéro de session.");
  show_back();
  return 1;
}

$i = 0;
while ($session = $c_db->object_result())
{
  $i++;
  include("sub/session_view_elem.inc.php3");
}

show_back();

?>
