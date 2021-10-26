<?php

include('_kernix_/var.inc.php3');

$table_admsite          = "adm_site";
$table_admshop          = "adm_shop";
$table_affiliate        = "affiliate";
$table_board            = "board";
$table_boardpost        = "boardpost";
$table_client           = "client";
$table_command          = "command";
$table_company          = "company";
$table_currency         = "currency";
$table_logaltern        = "logaltern";
$table_mailing          = "mailing";
$table_msg              = "msg";
$table_payment          = "payment";
$table_port             = "port";
$table_product          = "product";
$table_property         = "property";
$table_users            = "users";

$table_numsession       = "numsession";
$table_session          = "session";
$table_taxes            = "taxes";
$table_visitor          = "visitor";
$table_zone             = "port_zone";

$table_sp_parc          = "sp_parc";
$table_sp_poche         = "sp_poche";
$table_sp_services      = "sp_services";
$table_sp_produits      = "sp_produits";
$table_sp_adresse       = "DTWH_ADRESSE";
$table_sp_servicepoche  = "DTWH_SERVICE_POCHE";
$table_sp_places        = "DTWH_PLACES";
$table_sp_tarifs        = "DTWH_TARIFS";

$l_sql = "SELECT idsppoche as id, CODE_POCHE as correc FROM $table_sp_poche";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $l_tab[$obj->id]["correc"]	= $obj->correc;
  $i++;
}

$l_correc = array();
$l_todel = array();

foreach ($l_tab as $key => $val)
{
  if (in_array($val["correc"],$l_correc))
  {
    $l_todel[] = $key;
  }
  else
  {
    $l_correc[] = $val["correc"];
  }
}

echo "##########################".print_r($l_tab);
echo "##########################".print_r($l_correc);
echo "##########################".print_r( $l_todel);
?>
