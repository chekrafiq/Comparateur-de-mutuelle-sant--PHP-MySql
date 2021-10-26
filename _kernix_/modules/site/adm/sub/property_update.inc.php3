<?php

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty'";
//print("->$l_sql<br>");
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_tabp    = explode("&&",$obj->structure);
$l_data    = "";
$l_sepchar = "";

$i = 0;
while($l_tabp[$i])
{
  $l_prop = explode(";;",$l_tabp[$i]);
  $l_cellcode = $l_prop[0];
  $l_cellname = $l_prop[1];
//  print($l_cellname . "-");
  $l_cellval = ${$l_cellcode}; 
//  print($l_cellval . "<br>");
  if ($l_prop[1] == 1)
  {
//    $l_cellval = ereg_replace("\r", "", $l_cellval);
//    $l_cellval = ereg_replace("\n", "<br>", $l_cellval);  
  }
//  $l_data .= $l_sepchar . urlencode($l_cellcode) . "=" . urlencode($l_cellname) . "=" . urlencode($l_cellval);
  $l_data .= $l_sepchar . $l_cellcode . ";;" . $l_cellname . ";;" . $l_cellval;
  $l_sepchar = "&&";
//    print("$l_cellname = $l_cellval<br>$l_data<br>");
  $i++;
}


$l_sql = "UPDATE $table_ref SET data = '$l_data', updatedate = '$l_date' WHERE idref = '$p_idref'";
//print("->$l_sql<br>");
$c_db->query($l_sql);

if ($g_hashflag == 1)
{
  include("$g_modulespath/hashcache/adm/sub/insertref.inc.php3");
}

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/property_view.inc.php3");

?>
