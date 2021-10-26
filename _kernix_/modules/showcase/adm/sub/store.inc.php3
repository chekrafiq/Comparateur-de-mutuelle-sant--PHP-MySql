<?php

$l_name = strtoupper($p_name);

if ($p_showcaseflag == "create")
{
  $l_sql = "SELECT * FROM $table_showcase WHERE name = '$l_name' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_name > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_showcase (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idshowcase = $c_db->get_id();
}

$l_sql = "UPDATE $table_showcase SET name = '$l_name', description = '$p_description' WHERE idshowcase = '$p_idshowcase'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>


