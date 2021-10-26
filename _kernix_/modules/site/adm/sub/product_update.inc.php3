<?php

$p_startdate   = date2bdd($p_startdate); 
$p_enddate     = date2bdd($p_enddate); 

$p_productcode = strtoupper($p_productcode);
//$p_opinion     = text2bdd($p_opinion);

if ($p_productcode != "")
{
  $l_sql = "SELECT idproduct FROM $table_product WHERE productcode = '$p_productcode'";
  $c_db->query($l_sql);
  if ($c_db->numrows > 0)
  {
    $product_check = $c_db->object_result();
    if ($product_check->idproduct != $p_idproduct)
    {
      show_response("Un produit a déjà le code <'$p_productcode'> dans la base.");
      show_back();
      exit;
    }
  }
}


$l_sql = "UPDATE $table_product SET productcode = '$p_productcode', productinfo = '$p_productinfo', price = '$p_price', oldprice = '$p_oldprice', purchaseprice = '$p_purchaseprice', stock = '$p_stock', idport = '$p_idport', idtaxes = '$p_idtaxes', idcurrency = '$p_idcurrency', port_value = '$p_port_value', idsupplier = '$p_idsupplier', startdate = '$p_startdate', enddate = '$p_enddate', caddieflag = '$p_caddieflag', opinion = '$p_opinion' WHERE idproduct = '$p_idproduct'";
$c_db->query($l_sql);
//print("->$l_sql<br>");

$l_sql = "UPDATE $table_ref SET updatedate = '$l_date' WHERE idref = '$p_idref'";
$c_db->query($l_sql);
//print("->$l_sql<br>");

show_response("enregistrement effectué");

include("$g_modulespath/site/adm/sub/product_view.inc.php3");

?>
