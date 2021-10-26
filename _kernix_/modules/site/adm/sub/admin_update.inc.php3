<?php

if (($p_oldidproduct == 0) && ($p_idproduct == 1))
{
  $l_sql = "INSERT INTO $table_product (price, stock) values ('0', 1)";
  $c_db->query($l_sql);
  $p_idproduct = $c_db->get_id();
}
elseif (($p_oldidproduct > 0) && ($p_idproduct == 0))
{
  $l_sql = "DELETE FROM $table_product WHERE idproduct = '$p_oldidproduct'";
  $c_db->query($l_sql);
}
else
{
  $p_idproduct = $p_oldidproduct;
}

if ($p_oldvisibilityflag != $p_visibilityflag)
{
  include("$g_modulespath/site/adm/sub/ref_changevisibility.inc.php3");
}

$root_update = "";

if ($p_rootupdate == 1)
{
  $root_update = ", next = '$p_next', prev = '$p_prev', nbsubref = '$p_nbsubref', nodekey = '$p_nodekey', up = '$p_up', idorder = '$p_idorder'";
}

$l_sql = "UPDATE $table_ref set val1 = '$p_val1', val2 = '$p_val2', val3 = '$p_val3', val4 = '$p_val4', val5 = '$p_val5', pagecode = '$p_pagecode', idowner = '$p_idowner', idproduct = '$p_idproduct', updatedate = '$l_date' $root_update, indexflag = '$p_indexflag' WHERE idref = '$p_idref'";
$c_db->query($l_sql);

show_response("Modification(s) effectuée(s)");

include("$g_modulespath/site/adm/sub/admin_view.inc.php3");

?>
