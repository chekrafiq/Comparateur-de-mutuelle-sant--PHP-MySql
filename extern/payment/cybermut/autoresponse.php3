<?php

include("_kernix_/var.inc.php3");

$table_command = "command";
$table_session = "session";

$g_debugmode   = 1;

$tmp         = "texte-libre";
$texte_libre = $$tmp;
$tmp         = "code-retour";
$code_retour = $$tmp;

$prog = "cm_testmac $MAC 1.2 $g_absolutepath/_kernix_/opt/payment/cybermut/" . $TPE . ".key $date $montant $reference $texte_libre $code_retour";
system($prog,$result);

$prog = "cm_creerreponse " . $result;

$fprog = popen($prog, "r");
while (!feof($fprog))
{
  $car = fgets($fprog,255);
  printf($car);
}
pclose($fprog);

$p_idcommand = $reference;

if ((($result == '1') && ($code_retour == "paiement")) || ($code_retour == "payetest"))
{
  $l_sql = "UPDATE $table_command SET status = '4' WHERE idcommand = '$p_idcommand' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '4' WHERE numsession = '$texte_libre' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  $p_paymentmode = 'CCB';
  include("$g_modulespath/command/sub/command_mail.inc.php3");
  $l_title = "OK";
}
elseif (($result != '1') && ($code_retour == "paiement"))
{
  /* falsification ou probleme de communication */
  $l_sql = "UPDATE $table_command SET status = '1', msgpayment = 'ERREUR : falsification ou pb net' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$texte_libre' AND status = '3'";
  $c_db->query($l_sql);
  $l_title = "ERROR";
}
elseif ($code_retour != "paiement")
{
  /* paiement refuse, annuler la commande */
  $l_sql = "UPDATE $table_command SET status = '1', msgpayment = 'ERREUR : refus ou annulation' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$texte_libre' AND status = '3'";
  $c_db->query($l_sql);
  $l_title = "ERROR*";
}

if ($g_debugmode == 1)
{
  mail($g_kernixemail,"[CYBERMUT] " . $l_title . " : commande $p_idcommand : $montant [$g_sitename]","TPE=$TPE\nDATE=$date\nMONTANT=$montant\nIDCOMMAND=$p_idcommand\nTEXTE_LIBRE=$texte_libre\nCODE_RETOUR=$code_retour\n","From: boutique $g_sitename <$g_kernixemail>","-f$g_kernixemail");
}

$c_db->close();

?>
