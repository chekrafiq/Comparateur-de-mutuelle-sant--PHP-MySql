<?php
if (!isset($p_flag))
{
  include("sub/home.inc.php3");
  return 0;
}

if ($p_val == "")
{
  $p_val = "NULL";
}

$l_sql = "UPDATE $table_ref SET idpub = $p_val";
if ($p_whichpage == "empty")
{
  $l_sql .= " WHERE idpub = NULL";
}
//print("->$l_sql<br>");
$c_db->query($l_sql);

show_response("mise à jour effectuée");

include("sub/home.inc.php3");
?>
