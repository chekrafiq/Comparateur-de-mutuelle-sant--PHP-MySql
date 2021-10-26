<?php

if (!isset($p_flag))
{
  include("sub/home.inc.php3");
  return 0;
}

if ($p_content == "sentence")
{
  $l_sql = "UPDATE $table_ref SET description = '$p_description'";
}
else
{
  $l_sql = "UPDATE $table_ref SET description = keywords";
}

if ($p_whichpage == "empty")
{
  $l_sql .= " WHERE description = ''";
}

$c_db->query($l_sql);

show_response("maj OK");

include("sub/home.inc.php3");

?>
