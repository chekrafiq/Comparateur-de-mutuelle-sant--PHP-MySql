<?php

// les champs de la table ref

$l_tab = $c_db->get_tabcolumns("ref");

$i = 0;
while ($l_tab[$i])
{
  print($l_tab[$i] . " - ");
  $i++;
}
print("<br>");

// p_idfrom p_idto

$p_idorigine = 50;
$p_idtarget  = 47;

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idorigine'";
$c_db->query($l_sql);
$ref_origine = $c_db->object_result();

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idtarget'";
$c_db->query($l_sql);
$ref_target = $c_db->object_result();

// insertion de la ref origine ds target



// recupération des fils de origine

$l_sql = "SELECT * FROM $table_ref WHERE nodekey >= '$ref_origine->nodekey'";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $tab_idref["$obj->idref"] = $obj->idref;
  print($obj->idref . " - ");
}

?>

<br>
