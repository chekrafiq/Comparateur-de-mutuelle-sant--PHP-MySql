<?php

if (!isset($command->idcommand))
{
  return 0;
}

if ($adm->testflag == 1)
{
  $l_str = "test/";
}

if ($adm->poption == "CM")
{
  $l_serversec = "https://www.creditmutuel.fr/telepaiement/" . $l_str . "paiement.cgi";
}
else
{
  $l_serversec = "https://ssl.paiement.cic-banques.fr/" . $l_str . "paiement.cgi";
}

$p_amount  = $command->pricettcport . $l_currency;
$p_urlsite = "$g_urlroot/?p_idref=$p_fromref";
$p_urlok   = "$g_urlroot/extern/payment/" . $adm->directory . "/bank2site.php3?p_transacflag=OK&p_idcommand=$p_idcommand&p_fromref=$p_fromref";
$p_urlerr  = "$g_urlroot/extern/payment/" . $adm->directory . "/bank2site.php3?p_transacflag=ERR&p_idcommand=$p_idcommand&p_fromref=$p_fromref";

$prog = "cm_creerformulaire $l_serversec 1.2 $g_absolutepath/_kernix_/opt/payment/cybermut/" . $adm->merchantnum . ".key $p_amount $command->idcommand $command->numsession $p_urlsite $p_urlok $p_urlerr $adm->language $adm->merchantname paiement.par.carte.bancaire";

ob_start();

system($prog);

$out = ob_get_contents();
ob_end_clean();

$out = eregi_replace("<BR>","",$out);
$out = eregi_replace("<HR>","",$out);

echo $out;

?>
