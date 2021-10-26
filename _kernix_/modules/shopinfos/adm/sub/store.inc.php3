<?php
$table_portsupplier = "port_supplier";

//---- CHANGEMENT DES DONNEES FINANCIERES DU SITE
if ($p_oldidcurrency != $p_idcurrency)
{
  $l_sql = "SELECT acronymhtml, value, isocode, numcode FROM $table_currency WHERE idcurrency = '$p_idcurrency'";
  $c_db->query($l_sql);
  $l_currencyhtml    = $c_db->result(0,"acronymhtml");
  $l_ratio   = $c_db->result(0,"value");

//---> val affiliate
  $l_sql = "UPDATE $table_affiliate SET currentaccount = currentaccount / $l_ratio, totalaccount = totalaccount / $l_ratio, affiliatemax = affiliatemax / $l_ratio";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_affiliate SET affiliatevalue = affiliatevalue / $l_ratio WHERE affiliatemode = '1'";
  $c_db->query($l_sql);

//---> val des prix produits indexes sur monnaie du site + portvalue(si fixe), prix achat, oldprix
  $l_sql = "UPDATE $table_product SET price = price / $l_ratio WHERE idcurrency = '0'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_product SET purchaseprice = purchaseprice / $l_ratio";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_product SET port_value = port_value / $l_ratio WHERE idport = '3'";
  $c_db->query($l_sql);

//---> val des currencies
  $l_sql = "UPDATE $table_currency SET value = value / $l_ratio";
  $c_db->query($l_sql);

//---> val des ports
  $l_sql = "SELECT * FROM $table_portsupplier";
  $c_db->query($l_sql);
  $l_tabsupplier = array();
  while ($l_supplier = $c_db->object_result())
  {
     array_push($l_tabsupplier, $l_supplier->name);
  }
  foreach($l_tabsupplier as $k => $v)
    {
      $l_sql = "UPDATE port_weightzone_$v SET price = price / $l_ratio, price_express = price_express / $l_ratio";
      $c_db->query($l_sql);
    }

  $p_portlimit = $p_portlimit / $l_ratio;
  if ($adm->idport == 1 || $adm->idport == 3) { $p_portvalue = $p_portvalue / $l_ratio; }

  print("changement de monnaie - mise à jour globale<br>");
}
else
{
  $l_sql = "SELECT acronymhtml FROM $table_currency WHERE idcurrency = '$adm->idcurrency'";
  $c_db->query($l_sql);
  $l_currencyhtml    = $c_db->result(0,"acronymhtml");
}

$l_paymentmode = join("",$p_paymentmode);

if (!ereg("CCB",$l_paymentmode)) $p_idpayment = 0;
elseif ($p_idpayment == 0) $p_idpayment = 3;

$l_sql = "UPDATE $table_admshop set idpayment = '$p_idpayment', paymentmode = '$l_paymentmode', idshop = '$p_idshop', commandwarningflag = '$p_commandwarningflag', commandwarningemail = '$p_commandwarningemail', caddieflag = '$p_caddieflag', dutyfreeflag = '$p_dutyfreeflag', idcurrency = '$p_idcurrency', currencyhtml = '$l_currencyhtml', idtaxes = '$p_idtaxes', idcurrencyviewmode = '$p_idcurrencyviewmode', idport = '$p_idport', portlimit = '$p_portlimit', portvalue = '$p_portvalue', idpriceentermode = '$p_idpriceentermode', stockmodeflag = '$p_stockmodeflag', stocklimit = '$p_stocklimit', sellers = '$p_sellers' WHERE idadmshop='1'";
$c_db->query($l_sql);

show_response("modification effectuée");

include("sub/view.inc.php3");
?>
