<?php
// PARAM :
// $p_idref

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);
//print("->$l_sql<br>");
$l_ref = $c_db->object_result();

$l_sql = "SELECT * FROM $table_ref WHERE idref = $l_ref->up";
$c_db->query($l_sql);
//print("->$l_sql<br>");
$l_father = $c_db->object_result();

if (($l_father->visibilityflag == 0) && ($p_visibilityflag == 1))
{
  print("erreur");
  return 0;
}

if ($l_ref->visibilityflag == 1)
{
  $l_sql = "UPDATE $table_ref SET visibilityflag = 0 WHERE idref = $l_ref->idref";
  $c_db->query($l_sql);
//  print("->$l_sql<br>");
  $l_sql = "UPDATE $table_ref SET next = $l_ref->next WHERE idref = $l_ref->prev";
  $c_db->query($l_sql);
//  print("->$l_sql<br>");
  $l_sql = "UPDATE $table_ref SET prev = $l_ref->prev WHERE idref = $l_ref->next";
  $c_db->query($l_sql);
//  print("->$l_sql<br>");
  $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref - 1 WHERE idref = $l_ref->up";
  $c_db->query($l_sql);
//  print("->$l_sql<br>");
  if ($l_ref->nbsubref != 0)
  {
    $l_sql = "UPDATE $table_ref SET visibilityflag = 0 WHERE nodekey BETWEEN '$l_ref->nodekey' AND '$l_ref->nodekey" . "ZZ'";
    $c_db->query($l_sql);
//    print("->$l_sql<br>");
  }
}
else
{
  $l_prev = 0;
  $l_next = 0;
  
  $l_sql = "SELECT * FROM $table_ref WHERE nodekey > '$l_ref->nodekey' AND visibilityflag = 1 ORDER BY nodekey LIMIT 0,1";
  $c_db->query($l_sql);
//  print("->$l_sql<br>");
  if ($c_db->numrows > 0)
  {
    $l_refnext = $c_db->object_result();
    if (strlen($l_refnext->nodekey) == strlen($l_ref->nodekey))
    {
      $l_sql = "UPDATE $table_ref SET prev = $l_ref->idref WHERE idref = $l_refnext->idref";
      $c_db->query($l_sql);
//      print("->$l_sql<br>");
      $l_next = $l_refnext->idref;
      if ($l_refnext->prev)
      {
	$l_sql = "UPDATE $table_ref SET next = $l_ref->idref WHERE idref = $l_refnext->prev";
	$c_db->query($l_sql);
//	print("->$l_sql<br>");
	$l_prev = $l_refnext->prev;
      }
    }
  }
  
  if ($l_next == 0)
  {
    $l_sql = "SELECT * FROM $table_ref WHERE nodekey BETWEEN '".substr($l_ref->nodekey, 0, (strlen($l_ref->nodekey)-2))."00' AND '".substr($l_ref->nodekey, 0, (strlen($l_ref->nodekey)-2))."ZZ' AND visibilityflag = 1 ORDER BY nodekey DESC LIMIT 0,1";
    $c_db->query($l_sql);
//    print("->$l_sql<br>");
    if ($c_db->numrows > 0)
    {
      $l_refprev = $c_db->object_result();
      $l_sql = "UPDATE $table_ref SET next = $l_ref->idref WHERE idref = $l_refprev->idref";
      $c_db->query($l_sql);
//      print("->$l_sql<br>");
      $l_prev = $l_refprev->idref;
      $l_next = $l_refprev->next;
    }
  }
  
  if ($l_prev != 0 && $l_next == 0)
  {
    $l_idorder = ($l_refprev->idorder + 1);
  }

  if ($l_prev != 0 && $l_next != 0)
  {
    $l_sql = "SELECT * FROM $table_ref WHERE idref = $l_prev";
    $c_db->query($l_sql);
//    print("->$l_sql<br>");
    $l_refprev2 = $c_db->object_result();
    $l_idorder = ($l_refprev2->idorder + 1);
    $l_sql = "UPDATE $table_ref SET idorder = idorder+1 WHERE idorder >= $l_idorder AND up = $l_ref->up AND visibilityflag = 1";
    $c_db->query($l_sql);
//    print("->$l_sql<br>");
  }

  if ($l_prev == 0 && $l_next == 0)
  {
    $l_idorder = $l_ref->idorder;
  }

  if ($l_prev == 0 && $l_next != 0)
  {
    $l_idorder = 1;
  }
  
  $l_sql = "UPDATE $table_ref SET visibilityflag = 1, next = $l_next, prev = $l_prev, idorder = $l_idorder WHERE idref = $l_ref->idref";
  $c_db->query($l_sql);
//  print("->$l_sql<br>");
  $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref + 1 WHERE idref = $l_ref->up";
  $c_db->query($l_sql);
//  print("->$l_sql<br>");
  if ($l_ref->nbsubref != 0)
  {
    $l_sql = "UPDATE $table_ref SET visibilityflag = 1 WHERE nodekey BETWEEN '$l_ref->nodekey' AND '$l_ref->nodekey"."ZZ'";
    $c_db->query($l_sql);
//    print("->$l_sql<br>");
  }  
}

?>
