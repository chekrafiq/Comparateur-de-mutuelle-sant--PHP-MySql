<?php

$l_name = strtoupper($p_name);

if ($p_supplierflag == "create")
{
  $l_sql = "SELECT * FROM $table_supplier WHERE name = '$l_name' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_name > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_supplier (name,description,date) VALUES ('$l_name','$p_description','$l_date')";
  $c_db->query($l_sql);
  $p_idsupplier = $c_db->get_id();
  include("sub/view.inc.php3");
  return 1;
}

$l_sql = "UPDATE $table_supplier SET name = '$l_name', description = '$p_description', code = '$p_code', mode = '$p_mode', email = '$p_email', clientprofilflag = '$p_clientprofilflag' WHERE idsupplier = '$p_idsupplier'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>


