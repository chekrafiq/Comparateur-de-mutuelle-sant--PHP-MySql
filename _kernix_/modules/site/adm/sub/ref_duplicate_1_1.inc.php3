<?php

//##########################################
// couper coller sans les sous références
//##########################################

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

if (!$l_refsource->visibilityflag) { $l_refunvisibleflag = 1 ; }

$l_upnodekey = $l_refcat->nodekey;

$l_newnodekey = $l_upnodekey . $g_nodekeystep;

$l_sql = "SELECT * FROM $table_ref where up = '$p_idref' and next = '0'";
//  print("->$l_sql<br>");
$c_db->query($l_sql);
if ($c_db->numrows > 0 )
{
  $l_prevref = $c_db->object_result();
}

$l_sql = "SELECT * FROM $table_ref where up = '$p_idref' ORDER BY nodekey DESC";
//    print("->$l_sql<br>");
$c_db->query($l_sql);
if ($c_db->numrows > 0 )
{
  $l_max_ndk_ref = $c_db->object_result();
}

$l_sql = "UPDATE $table_ref set up = '$l_refcat->idref', next = 0, prev = 0, updatedate = '$l_date', nodekey = '$l_newnodekey', visibilityflag = 1 WHERE idref = '$p_idref_source'";
// print("->$l_sql<br>");
$c_db->query($l_sql);
$p_idnewref = $p_idref_source;

$l_sql = "SELECT visibilityflag FROM $table_ref where idref = '$l_refsource->up'";
//    print("->$l_sql<br>");
$c_db->query($l_sql);
$l_refup = $c_db->object_result();

if ($l_refsource->visibilityflag)
{
  if ($l_refsource->prev)
  {
    $l_sql = "UPDATE $table_ref SET next = '$l_refsource->next' where idref = '$l_refsource->prev'";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
  }
  
  if ($l_refsource->next)
  {
    $l_sql = "UPDATE $table_ref SET prev = '$l_refsource->prev' where idref = '$l_refsource->next'";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
  }

  if ($l_refup->visibilityflag)
  {
    $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref-1 where idref = '$l_refsource->up'";
//  print("->$l_sql<br>");
    $c_db->query($l_sql);
  }
}
else
{
  if (!$l_refup->visibilityflag)
  {
    $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref-1 where idref = '$l_refsource->up'";
//  print("->$l_sql<br>");
    $c_db->query($l_sql);
  }
}

if ($l_refcat->nbsubref != 0)
{
  $l_newnodekey = calc_newnodekey($l_max_ndk_ref->nodekey);
  
  $l_sql = "UPDATE $table_ref SET next = '$p_idnewref' where idref = '$l_prevref->idref'";
//    print("->$l_sql<br>");
  $c_db->query($l_sql);
  
  $l_sql = "UPDATE $table_ref SET prev = '$l_prevref->idref', nodekey = '$l_newnodekey', idorder = ".($l_prevref->idorder+1)." where idref = '$p_idnewref'";
//    print("->$l_sql<br>");
  $c_db->query($l_sql);
  
  $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref+1 where idref = '$l_refcat->idref'";
//  print("->$l_sql<br>");
  $c_db->query($l_sql);
}
else
{
  $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref+1 where idref = '$l_refcat->idref'";
//    print("->$l_sql<br>");
  $c_db->query($l_sql);
}

if ($l_refunvisibleflag) { array_push($l_tabrefunvisible, $p_idnewref); $l_refunvisibleflag = 0; }

?>
