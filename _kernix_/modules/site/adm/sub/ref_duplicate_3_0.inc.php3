<?php

//##########################################
// copier coller avec les sous références
//##########################################

$p_idref_safe = $p_idref;

$l_sql = "SELECT * FROM $table_ref where idref = '$p_idref_source'";
//print("->$l_sql<br>");
$c_db->query($l_sql);
$l_refsource_1 = $c_db->object_result();

$l_sql = "select * from $table_ref where nodekey >= '" . $l_refsource_1->nodekey . "' and nodekey < '" . $l_refsource_1->nodekey . "ZZ' order by nodekey";
//print("->$l_sql<br>");
$c_db->query($l_sql);
if ($c_db->numrows > 0 )
{
  $l = 0;
  while($l_ref2updateobj = $c_db->object_result())
  {
//    print("->$l<br>");
    $l_ref2updatetab[$l] = $l_ref2updateobj;
    $l++;
  }
  
  $o = 0;
  for($p=0;$p<$l;$p++)
  {
    $l_refsource = $l_ref2updatetab[$p];
    $test = strlen($l_refsource->nodekey) / 2;
    if ($p > 0)
    {
      if ($o == $test)
      {
	$p_idref = $l_idref_tab[$o];      
      }
      elseif ($o < $test)
	{
	  $o = $test;
	  $l_idref_tab[$o] = $p_idref;
	}	
      else
      {
	$o = $test;
	$p_idref = $l_idref_tab[$o];      
      }	
    }
    else
    {
      $o = $test;
      $l_idref_tab[$o] = $p_idref;
    }

    if (!$l_refsource->visibilityflag) { $l_refunvisibleflag = 1 ; }
    
    $l_sql = "SELECT * FROM $table_ref where idref = '$p_idref'";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
    $l_refcat = $c_db->object_result();
    
    $l_sql = "SELECT * FROM $table_ref where up = '$p_idref' and next = '0'";
//    print("->$l_sql<br>");
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
    
    $l_upnodekey = $l_refcat->nodekey;
    
    $l_newnodekey = $l_upnodekey . $g_nodekeystep;
    
    $l_idproduct = 0;
    
    if ($l_refsource->idproduct)
    {
      $l_sql = "SELECT * FROM $table_product where idproduct = '$l_refsource->idproduct'";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
      $l_productsource = $c_db->object_result();
      
      $l_sql = "INSERT INTO $table_product (productinfo, idtaxes, idcurrency, idport, idsupplier, stock, price, productcode, oldprice, purchaseprice, port_value, state, startdate, enddate, opinion) values ('".txt2bdd($l_productsource->productinfo)."', '$l_productsource->idtaxes', '$l_productsource->idcurrency', '$l_productsource->idport', '$l_productsource->idsupplier', '$l_productsource->stock', '$l_productsource->price', '$l_productsource->productcode', '$l_productsource->oldprice', '$l_productsource->purchaseprice', '$l_productsource->port_value', '".txt2bdd($l_productsource->state)."', '$l_productsource->startdate', '$l_productsource->enddate', '".txt2bdd($l_productsource->opinion)."')";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
      $l_idproduct = $c_db->get_id();
    }
    
    $l_sql = "INSERT INTO $table_ref (idproduct, name, description, design, up, next, prev, idproperty, creationdate, updatedate, nodekey, pagecode) values ('$l_idproduct', '".txt2bdd($l_refsource->name)."', '".txt2bdd($l_refsource->description)."', '$l_refsource->design', '$l_refcat->idref', '0', '0', '$l_refsource->idproperty', '$l_date', '$l_date', '$l_newnodekey', '$l_refsource->pagecode')";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
    $p_idnewref = $c_db->get_id();
    
    if ($l_refcat->nbsubref != 0)
    {
      $l_newnodekey = calc_newnodekey($l_max_ndk_ref->nodekey);
      
      $l_sql = "UPDATE $table_ref SET next = '$p_idnewref' where idref = '$l_prevref->idref'";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
      
      $l_sql = "UPDATE $table_ref SET prev = '$l_prevref->idref', nodekey = '$l_newnodekey'  where idref = '$p_idnewref'";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
      
      $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref+1 where idref = '$l_refcat->idref'";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
    }
    else
    {
      $l_sql = "UPDATE $table_ref SET nbsubref = nbsubref+1 where idref = '$l_refcat->idref'";
//      print("->$l_sql<br>");
      $c_db->query($l_sql);
    }
    
    $l_sql = "UPDATE $table_ref SET idorder = $p_idnewref  where idref = '$p_idnewref'";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);
      
    $l_sql = "UPDATE $table_ref SET "
      ."nbsubref = 0, "
      ."keywords = '".txt2bdd($l_refsource->keywords)."', "
      ."title = '".txt2bdd($l_refsource->title)."', "
      ."content = '".txt2bdd($l_refsource->content)."', "
      ."data = '".txt2bdd($l_refsource->data)."', "
      ."val1 = '".txt2bdd($l_refsource->val1)."', "
      ."val2 = '".txt2bdd($l_refsource->val2)."', "
      ."val3 = '".txt2bdd($l_refsource->val3)."', "
      ."val4 = '".txt2bdd($l_refsource->val4)."', "
      ."val5 = '".txt2bdd($l_refsource->val5)."', "
      ."link = '$l_refsource->link', "
      ."picture = '$l_refsource->picture', "
      ."icon = '$l_refsource->icon', "
      ."skin = '$l_refsource->skin', "
      ."design = '$l_refsource->design', "
      ."template = '$l_refsource->template'"
      ." where idref = '$p_idnewref'";
//    print("->$l_sql<br>");
    $c_db->query($l_sql);

    if ($l_refunvisibleflag) { array_push($l_tabrefunvisible, $p_idnewref); $l_refunvisibleflag = 0; }

    $p_idref = $p_idnewref;      
    
  }
}

?>
