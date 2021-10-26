<?php
function get_msg($code)
{
  global $c_db, $table_msg;
  
  $l_sql = "SELECT description FROM $table_msg WHERE code = '$code'";
  $c_db->query($l_sql);
  $obj = $c_db->object_result();
  return $obj->description;
}
?>
