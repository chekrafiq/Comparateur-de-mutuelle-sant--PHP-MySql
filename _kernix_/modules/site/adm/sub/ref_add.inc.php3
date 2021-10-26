<?php

//$p_name        = text2bdd($p_name);
//$p_description = text2bdd($p_description);

if ($p_name == "")
{
  show_response("Le champ nom est vide");
  show_back();
  exit;
}

$l_sql = "SELECT idref, creationdate FROM $table_ref WHERE name LIKE '$p_name' AND up = '$p_idref' AND idproperty = '$p_idproperty' ORDER BY creationdate DESC";
$c_db->query($l_sql);
if ($c_db->numrows > 0)
{
  $l_refchek = $c_db->object_result();
  if (!heure_diff($l_refchek->creationdate, 1))
  {
    show_response("Vous avez déjà introduit cette référence");
    show_back();
    exit;
  }
}

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);
$l_refcat = $c_db->object_result();

$l_sql = "SELECT * FROM $table_ref WHERE up = '$p_idref' and next = '0'";
$c_db->query($l_sql);
if ($c_db->numrows > 0 )
{
  $l_prevref = $c_db->object_result();
}

$l_upnodekey = $l_refcat->nodekey;

$l_newnodekey = $l_upnodekey . $g_nodekeystep;

$l_idproduct = 0;

if ($p_type == 2)
{
  $l_sql = "INSERT INTO $table_product (price, stock) values ('0', 1)";
  $c_db->query($l_sql);
  $l_idproduct = $c_db->get_id();
}
 
$l_sql = "INSERT INTO $table_ref (idproduct, name, title, description, design, up, next, prev, idproperty, creationdate, updatedate, nodekey) values ('$l_idproduct', '$p_name', '$p_name', '$p_description', '', '$l_refcat->idref', '0', '0', '$p_idproperty', '$l_date', '$l_date', '$l_newnodekey')";
$c_db->query($l_sql);
$p_idnewref = $c_db->get_id();

if ($l_refcat->nbsubref != 0)
{
  $l_sql = "SELECT max(nodekey) as M FROM $table_ref WHERE up = '$p_idref'";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0 )
  {
    $l_refmaxnodekey = $c_db->object_result();
  }
  
  $l_newnodekey = calc_newnodekey($l_refmaxnodekey->M);
  
  $l_sql = "UPDATE $table_ref SET next = '$p_idnewref' WHERE idref = '$l_prevref->idref'";
  $c_db->query($l_sql);
  
  $l_sql = "UPDATE $table_ref SET prev = '$l_prevref->idref', nodekey = '$l_newnodekey'  WHERE idref = '$p_idnewref'";
  $c_db->query($l_sql);
  
  $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref+1 WHERE idref = '$l_refcat->idref'";
    $c_db->query($l_sql);
}
else
{
  $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref+1 WHERE idref = '$l_refcat->idref'";
  $c_db->query($l_sql);
}

$l_sql = "UPDATE $table_ref SET idorder = $p_idnewref WHERE idref = '$p_idnewref'";
$c_db->query($l_sql);

$p_idref = $p_idnewref;

include("sub/property_view.inc.php3");

?>
