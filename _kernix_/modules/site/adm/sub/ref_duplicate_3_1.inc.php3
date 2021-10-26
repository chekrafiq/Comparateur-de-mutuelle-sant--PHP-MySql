<?php

//##########################################
// couper coller avec les sous références
//##########################################

include("sub/ref_duplicate_1_1.inc.php3");

$l_len_nodekeysource = strlen($l_refsource->nodekey);

$l_sql = "select * from $table_ref where nodekey > '$l_refsource->nodekey' and nodekey <= '" . $l_refsource->nodekey . "ZZ' order by nodekey";
//print("->$l_sql<br>");
$c_db->query($l_sql);
if ($c_db->numrows > 0 )
{
  $l = 0;
  while($l_ref2updateobj = $c_db->object_result())
  {
//    print("->$l<br>");
    $l_ref2updatetab[$l]["idref"] = $l_ref2updateobj->idref;
    $l_ref2updatetab[$l]["nodekey"] = $l_ref2updateobj->nodekey;
    $l++;
  }
  
  for($p=0;$p<$l;$p++)
  {
    $l_nodekey = $l_newnodekey . substr($l_ref2updatetab[$p]["nodekey"], $l_len_nodekeysource);
    
    $l_sql = "update $table_ref SET nodekey = '$l_nodekey' where idref = '" . $l_ref2updatetab[$p]["idref"] . "'";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
  }
}

?>
