<?php

if (!($command->idcommand > 0))
{
  print("+");
  return 0;
}

$table_client = "client";

$l_sql = "SELECT email1 FROM $table_client WHERE idclient = '$command->idclient'";
$c_db->query($l_sql);
$l_email = $c_db->result(0,"email1");

$ibs_site           = $adm->merchantnum;
$ibs_rang           = $adm->merchantrank;
$ibs_total          = floor($command->pricettcport * 100);
$ibs_devise         = $l_currency;
$ibs_cmd            = "$command->idcommand|$command->numsession";
$ibs_porteur        = $l_email;
$ibs_date           = date("d/m/Y G:i:s");
$ibs_langue         = $adm->language;
$ibs_effectue       = "$g_urlroot/extern/payment/" . $adm->directory . "/bank2site.php3?p_transacflag=OK&p_idcommand=$p_idcommand&p_fromref=$p_fromref&v";
$ibs_annule         = "$g_urlroot/extern/payment/" . $adm->directory . "/bank2site.php3?p_transacflag=ANNUL&p_idcommand=$p_idcommand&p_fromref=$p_fromref&v";
$ibs_refuse         = "$g_urlroot/extern/payment/" . $adm->directory . "/bank2site.php3?p_transacflag=ERR&p_idcommand=$p_idcommand&p_fromref=$p_fromref&v";
$ibs_retour         = "p_autoris:A;p_transac:T;p_cmd:R";
$ibs_output         = "C";

$cmd = "paybox_module IBS_MODE=4 IBS_SITE=$ibs_site IBS_RANG=$ibs_rang IBS_TOTAL=$ibs_total IBS_DEVISE=$ibs_devise IBS_CMD=$ibs_cmd IBS_PORTEUR=$ibs_porteur IBS_LANGUE=$ibs_langue IBS_EFFECTUE=$ibs_effectue IBS_ANNULE=$ibs_annule IBS_REFUSE=$ibs_refuse IBS_RETOUR=$ibs_retour IBS_OUTPUT=$ibs_output";
//print($cmd);
system($cmd);

?>

<INPUT TYPE=submit VALUE='paiement PAYBOX'> 
</Form> 
