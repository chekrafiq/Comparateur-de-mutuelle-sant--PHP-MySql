<?php

$l_code = strtoupper($p_code);

if ($p_msgflag == "create")
{
  $l_sql = "SELECT * FROM $table_msg WHERE code = '$l_code' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_code > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_msg (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idmsg = $c_db->get_id();
}

$l_sql = "UPDATE $table_msg SET code = '$l_code', title = '$p_title', description = '$p_description' WHERE idmsg = '$p_idmsg'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


