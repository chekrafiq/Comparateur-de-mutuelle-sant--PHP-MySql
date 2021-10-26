<?php

$l_name = strtoupper($p_name);

if ($p_taxesflag == "create")
{
     $l_sql = "SELECT * FROM $table_taxes WHERE name = '$l_name' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  show_response("< $p_name > déjà présent.");
	  include("sub/list.inc.php3");
	  return 0;
     }
     $l_sql = "INSERT INTO $table_taxes (description) VALUES ('')";
     $c_db->query($l_sql);
     $p_idtaxes = $c_db->get_id();
}

$l_sql = "UPDATE $table_taxes SET name = '$l_name', description = '$p_description',rate = '$p_rate'  WHERE idtaxes = '$p_idtaxes'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");
?>


