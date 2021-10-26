<?php

$l_sql = "SELECT * FROM $table_ref where idref = '$p_idref_source'";
//  print("->$l_sql<br>");
$c_db->query($l_sql);
$l_refsource = $c_db->object_result();

$l_sql = "SELECT * FROM $table_ref where idref = '$p_idref'";
//  print("->$l_sql<br>");
$c_db->query($l_sql);
$l_refcat = $c_db->object_result();

if (($l_refcat->nodekey > $l_refsource->nodekey) && ($l_refcat->nodekey <= ($l_refsource->nodekey."ZZ")))
{
  show_response("Opération impossible : la destination est un sous ensemble de la source");
  show_back();
  exit;
}

//##########################################
// copier coller des sous références uniquement
//##########################################

$l_sql = "select idref from $table_ref where up = '$p_idref_source' order by idorder";
//print("->$l_sql<br>");
$c_db->query($l_sql);

$l_tabref2copy = array();
while($l_ref2copy = $c_db->object_result()) { array_unshift($l_tabref2copy, $l_ref2copy->idref); }

$l_loopcallflag = 1;

while($p_idref_source = array_pop($l_tabref2copy))
{
  $p_idref = $p_idref_topsafe;
//  print("->idref:$p_idref - source:$p_idref_source<br>");
  
  include("sub/ref_duplicate_3_0.inc.php3");  
}
?>
