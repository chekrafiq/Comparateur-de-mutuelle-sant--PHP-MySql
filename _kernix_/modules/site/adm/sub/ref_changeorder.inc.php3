<?php
$l_sql = "SELECT idref, idorder, next, prev FROM $table_ref WHERE up = '$p_fromref' AND visibilityflag=1 ORDER BY idorder";
$c_db->query($l_sql);
$i = 0;
while ($l_row = $c_db->object_result())
{
  $tab_order[$i][0] = $l_row->idref;
  $tab_order[$i][1] = $l_row->idorder;
  $tab_order[$i][2] = $l_row->next;
  $tab_order[$i][3] = $l_row->prev;
  $i++;
}      

switch($p_move)
{
 case "top":
   $j = 0;
   while ($j < $i)
   {
     if ($tab_order[$j][1] == $p_idorder && $j > 0)
     {
       $l_sql = "UPDATE $table_ref set idorder = ". $tab_order[0][1] .", next = ". $tab_order[0][0] .", prev = '0' where idref = ". $tab_order[$j][0];
       $c_db->query($l_sql);
       $l_sql = "UPDATE $table_ref set prev = ". $tab_order[$j][0] ." where idref = ". $tab_order[0][0];
       $c_db->query($l_sql);
       if (isset($tab_order[$j+1]))
       {
	 $l_sql = "UPDATE $table_ref set prev = ". $tab_order[$j-1][0] ." where idref = ". $tab_order[$j+1][0];
	 $c_db->query($l_sql);
       }
       if (isset($tab_order[$j-1]))
       {
	 $l_sql = "UPDATE $table_ref set next = ". $tab_order[$j+1][0] ." where idref = ". $tab_order[$j-1][0];
	 $c_db->query($l_sql);
       }
       if ($j == ($i-1))
       {
	 $l_sql = "UPDATE $table_ref set next = '0' where idref = ". $tab_order[$j-1][0];
	 $c_db->query($l_sql);
       }
       break;
     }
     elseif ($tab_order[$j][1] == $p_idorder && $j == 0)
       {
	 break;
       }
     else
     {
       $l_sql = "UPDATE $table_ref set idorder = ". $tab_order[$j+1][1] ." where idref = ". $tab_order[$j][0];
       $c_db->query($l_sql);
       $j++;
     }
   }      
   break;
 case "up":
   $j = 0;
   while ($j < $i)
   {
     if ($tab_order[$j][1] == $p_idorder && $j > 0)
     {
       $l_sql = "UPDATE $table_ref SET idorder = ". $tab_order[$j-1][1] .", next = ". $tab_order[$j-1][0] .", prev = ". $tab_order[$j-1][3] ." WHERE idref = ". $tab_order[$j][0];
       $c_db->query($l_sql);
       $l_sql = "UPDATE $table_ref SET idorder = ". $tab_order[$j][1] .", next = ". $tab_order[$j][2] .", prev = ". $tab_order[$j][0] ." WHERE idref = ". $tab_order[$j-1][0];
       $c_db->query($l_sql);
       if (isset($tab_order[$j-1][3]))
       {
	 $l_sql = "UPDATE $table_ref SET next = ". $tab_order[$j][0] ." WHERE idref = ". $tab_order[$j-1][3];
	 $c_db->query($l_sql);
       }
       if (isset($tab_order[$j][2]))
       {
	 $l_sql = "UPDATE $table_ref SET prev = ". $tab_order[$j-1][0] ." WHERE idref = ". $tab_order[$j][2];
	 $c_db->query($l_sql);
       }
       break;
     }	       
     else
     {
       $j++;
     }
   }      
   break;
 case "down":
   $j = 0;
   while ($j < $i)
   {
     $k = $i - 1;
     if ($tab_order[$j][1] == $p_idorder && $j != $k)
     {
       $l_sql = "UPDATE $table_ref SET idorder = ". $tab_order[$j+1][1] .", next = ". $tab_order[$j+1][2] .", prev = ". $tab_order[$j+1][0] ." WHERE idref = ". $tab_order[$j][0];
       $c_db->query($l_sql);
       $l_sql = "UPDATE $table_ref SET idorder = ". $tab_order[$j][1] .", next = ". $tab_order[$j][0] .", prev = ". $tab_order[$j][3] ." WHERE idref = ". $tab_order[$j+1][0];
       $c_db->query($l_sql);
       if (isset($tab_order[$j+1][2]))
       {
	 $l_sql = "UPDATE $table_ref SET prev = ". $tab_order[$j][0] ." WHERE idref = ". $tab_order[$j+1][2];
	 $c_db->query($l_sql);
       }
       if (isset($tab_order[$j][3]))
       {
	 $l_sql = "UPDATE $table_ref SET next = ". $tab_order[$j+1][0] ." WHERE idref = ". $tab_order[$j][3];
	 $c_db->query($l_sql);
       }
       break;
     }	       
     else
     {
       $j++;
     }
   }      
   break;
 case "alphabetic":
   if ($alpha_flag == 0) { $l_sql = "SELECT idref, name, idorder FROM $table_ref where up = '$p_fromref' AND visibilityflag=1 ORDER BY name"; }
   elseif ($alpha_flag == 1) { $l_sql = "SELECT idref, name, idorder FROM $table_ref where up = '$p_fromref' AND visibilityflag=1 ORDER BY name DESC"; }
//   print("->$l_sql<br>");
   $c_db->query($l_sql);
   
   $j = 0;
   $l_idorder = 100000;
   while ($l_row = $c_db->object_result())
   {
     $tab_ordera[$j] = $l_row->idref;
     $l_idorder = min($l_idorder, $l_row->idorder);
     $j++;
   }
   
   $l_prev = 0;
   for($k=0;$k<$j;$k++)
   {
     if ($k<($j-1)) { $l_next = $tab_ordera[($k+1)]; } else { $l_next = 0; }
     $l_idref = $tab_ordera[$k];
     $l_sql = "UPDATE $table_ref set idorder = $l_idorder, next = $l_next, prev = $l_prev where idref = $l_idref";
//     print("->$l_sql<br>");
     $c_db->query($l_sql);
     $l_prev = $l_idref;
     $l_idorder++;
   }     
   break;
 case "order":
   $l_sql = "SELECT idref, name, idorder FROM $table_ref where up = '$p_fromref' AND visibilityflag=1 ORDER BY idorder";
//   print("->$l_sql<br>");
   $c_db->query($l_sql);
   
   $j = 0;
   $l_idorder = 100000;
   while ($l_row = $c_db->object_result())
   {
     $tab_ordera[$j] = $l_row->idref;
     $l_idorder = min($l_idorder, $l_row->idorder);
     $j++;
   }
   
   $l_prev = 0;
   for($k=0;$k<$j;$k++)
   {
     if ($k<($j-1)) { $l_next = $tab_ordera[($k+1)]; } else { $l_next = 0; }
     $l_idref = $tab_ordera[$k];
     $l_sql = "UPDATE $table_ref set idorder = $l_idorder, next = $l_next, prev = $l_prev where idref = $l_idref";
//     print("->$l_sql<br>");
     $c_db->query($l_sql);
     $l_prev = $l_idref;
     $l_idorder++;
   }     
   break;
}
$p_idref = $p_fromref;

include("sub/ref_view.inc.php3");
?>
