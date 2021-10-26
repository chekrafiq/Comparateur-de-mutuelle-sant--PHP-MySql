<?php

$l_name = strtoupper($p_name);

if ($p_outputflag == "create")
{
     $l_sql = "SELECT * FROM $table_output WHERE name = '$l_name' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  show_response("< $p_name > déjà présent.");
	  include("sub/list.inc.php3");
	  return 0;
     }
     $l_sql = "INSERT INTO $table_output (date) VALUES ('$l_date')";
     $c_db->query($l_sql);
     $p_idoutput = $c_db->get_id();
}

$l_sql = "UPDATE $table_output SET name = '$l_name', value = '$p_value' WHERE idoutput = '$p_idoutput'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


