<?php

$l_propertyname = strtoupper($p_propertyname);

$l_structure = ereg_replace("\n", "", $p_structure);
$l_structure = ereg_replace("\r", "", $l_structure);
$l_structure = trim($l_structure);

if ($p_propflag == "create")
{
  $l_sql = "SELECT * FROM $table_property WHERE propertyname = '$l_propertyname' ";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    show_response("< $p_propertyname > déjà présent.");
    include("sub/list.inc.php3");
    return 0;
  }

  if ($p_idpropertysource)
  {
    $l_sql = "SELECT structure FROM $table_property WHERE idproperty = '$p_idpropertysource' ";
    $c_db->query($l_sql);
    $property_source = $c_db->object_result();
    $l_structure = $property_source->structure;
  }

  $l_sql = "INSERT INTO $table_property (date) VALUES ('$l_date')";
  $c_db->query($l_sql);
  $p_idproperty = $c_db->get_id();
}

$l_sql = "UPDATE $table_property SET propertyname = '$l_propertyname', structure = '$l_structure' WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);

show_response("enregistrement effectué");
include("sub/view.inc.php3");

?>
