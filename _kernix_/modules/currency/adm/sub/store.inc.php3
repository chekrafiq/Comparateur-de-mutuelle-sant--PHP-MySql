<?php

$l_name = strtoupper($p_name);

if ($p_currencyflag == "create")
{
     $l_sql = "SELECT * FROM $table_currency WHERE name = '$l_name' ";
     $c_db->query($l_sql);
     if ($c_db->numrows > 0)
     {
	  show_response("< $p_name > déjà présent.");
	  include("sub/list.inc.php3");
	  return 0;
     }
     $l_sql = "INSERT INTO $table_currency (acronymhtml) VALUES ('')";
     $c_db->query($l_sql);
     $p_idcurrency = $c_db->get_id();
}

if (empty($l_name) || empty($p_value) || empty($p_acronymtxt) || empty($p_acronymhtml) || empty($p_isocode))
{
  show_response("tous les champs doivent être renseignés.");
  show_back();
  return 0;
}

$l_sql = "UPDATE $table_currency SET name = '$l_name', value = '$p_value', acronymtxt = '$p_acronymtxt', acronymhtml = '$p_acronymhtml', isocode = '" . strtoupper($p_isocode) . "' WHERE idcurrency = '$p_idcurrency'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>


