<?php

if (empty($p_code))
$p_code = $p_name;

$l_name = strtoupper($p_name);

$p_code = strtoupper($p_code);

if ($p_moduleflag == "create")
{
  $l_sql = "SELECT * FROM $table_module WHERE name = '$l_name' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_name > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_module (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idmodule = $c_db->get_id();
  $p_path = strtolower($p_name);
  $p_subscribeflag = 1;
}

if (isset($p_superuserflag))
{
  $p_superuserflag = 1;
}

if (isset($p_subscribeflag))
{
  $p_subscribeflag = 1;
}

$l_sql = "UPDATE $table_module SET name = '$l_name', code = '$p_code', description = '$p_description', path = '$p_path', superuserflag = '$p_superuserflag', subscribeflag = '$p_subscribeflag' WHERE idmodule = '$p_idmodule'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
if ($p_moduleflag == "create")
include("sub/list.inc.php3");
else
include("sub/view.inc.php3");
?>


