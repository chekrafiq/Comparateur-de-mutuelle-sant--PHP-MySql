<?php

$l_name = strtoupper($p_name);

if ($p_galleryflag == "create")
{
  $l_sql = "SELECT * FROM $table_gallery WHERE name = '$l_name' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_name > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }
  $l_sql = "INSERT INTO $table_gallery (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idgallery = $c_db->get_id();
}

$l_sql = "UPDATE $table_gallery SET name = '$l_name', value = '$p_value', description = '$p_description' WHERE idgallery = '$p_idgallery'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


