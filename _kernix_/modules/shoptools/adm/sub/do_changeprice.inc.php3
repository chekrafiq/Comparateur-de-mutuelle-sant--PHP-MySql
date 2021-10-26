<?php

if (!isset($p_flag))
{
  include("sub/home.inc.php3");
  return 0;
}


switch($p_pricemode)
{
 case "addprice":
   $l_sql = "UPDATE $table_product set price = price + $p_val";
   break;
   
 case "addperc":
   $p_val = 1 + ($p_val / 100);
   $l_sql = "UPDATE $table_product set price = price * $p_val";
   break;
   
 case "subprice":
   $l_sql = "UPDATE $table_product set price = price - $p_val";
   break;
   
 case "subperc":
   $p_val = 1 - ($p_val / 100);
   $l_sql = "UPDATE $table_product set price = price * $p_val";
   break;
   
}

$c_db->query($l_sql);
show_response("modification(s) effectuée(s)");

include("sub/home.inc.php3");

return 0;

?>
