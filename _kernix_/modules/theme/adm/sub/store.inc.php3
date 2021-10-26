<?php

$l_name = strtoupper($p_name);

if ($p_themeflag == "create")
{
     $l_sql = "SELECT * FROM $table_theme WHERE name = '$l_name' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  show_response("< $p_name > déjà présent.");
	  include("sub/list.inc.php3");
	  return 0;
     }
     $l_sql = "INSERT INTO $table_theme (date) VALUES ('$l_date')";
     $c_db->query($l_sql);
     $p_idtheme = $c_db->get_id();
}

$l_sql = "UPDATE $table_theme SET name = '$l_name', subject = '$p_subject', picture = '$p_picture', type = '$p_type' WHERE idtheme = '$p_idtheme'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


