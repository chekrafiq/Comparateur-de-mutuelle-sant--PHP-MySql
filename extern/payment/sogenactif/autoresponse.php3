<?php

include("_kernix_/var.inc.php3");

$table_command = "command";
$table_session = "session";

$g_debugmode   = 1;


$sips_result = exec("sips_response $DATA");
$tableau     = explode ("!", $sips_result);

$sips_code                = $tableau[1];
$sips_error               = $tableau[2];
$sips_merchant_id         = $tableau[3];
$sips_amount              = $tableau[4];
$sips_transaction_id      = $tableau[5];
$sips_payment_means       = $tableau[6];
$sips_payment_time        = $tableau[7];
$sips_payment_date        = $tableau[8];
$sips_response_code       = $tableau[9];
$sips_payment_certificate = $tableau[10];
$sips_authorisation_id    = $tableau[11];
$sips_currency_code       = $tableau[12];
$sips_card_number         = $tableau[13];
$sips_return_context      = $tableau[14];
$sips_caddie              = $tableau[15]; 
$sips_data                = $tableau[16]; 

$p_idcommand              = $sips_caddie;

list($p_numsession,$p_fromref) = explode("|",$sips_data);

$l_msg = "sips_code=$sips_code\nsips_error=$sips_error\nsips_transaction_id=$sips_transaction_id\nsips_response_code=$sips_response_code\nsips_caddie=$sips_caddie\nsips_data=$sips_data\nsips_currency_code=$sips_currency_code";

if ($sips_code != "0")
{
  $l_sql = "UPDATE $table_command SET status = '1', msgpayment = 'ERREUR' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$p_numsession' AND status = '3'";
  $c_db->query($l_sql);
  if ($g_debugmode == 1)
    mail($g_kernixemail,"[SOGEN] ERROR* : commande $p_idcommand : $sips_amount [$g_sitename]",$l_msg,"From: boutique $g_sitename <$g_kernixemail>","-f$g_kernixemail");
  return 0;
}

$sips_response_code += 0;

if ($sips_response_code == 0)
{
  $l_sql = "UPDATE $table_command SET status = '4' WHERE idcommand = '$p_idcommand' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '4' WHERE numsession = '$p_numsession' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  $p_paymentmode = 'CCB';
  include("$g_modulespath/command/sub/command_mail.inc.php3");
  if ($g_debugmode == 1)
    mail($g_kernixemail,"[SOGEN] OK : commande $p_idcommand : $sips_amount [$g_sitename]",$l_msg,"From: boutique $g_sitename <$g_kernixemail>","-f$g_kernixemail");
}
else
{ 
  switch ($sips_response_code)
  {
  case "3":
    $l_msgpayment = "MERCHANT_ID INVALIDE";
  case "13":
    $l_msgpayment = "MONTANT INVALIDE"; 
  case "17":
    $l_msgpayment = "ANNULATION INTERNAUTE";
  case "30":
    $l_msgpayment = "ERREUR FORMAT";
  case "75":
    $l_msgpayment = "NB ESSAIS DEPASSE"; 
  case "90":
    $l_msgpayment = "SERVICE INDISPONIBLE";
  case "94":
    $l_msgpayment = "REQUETE DUPLIQUEE";
  }
  $l_msgpayment .= " ($sips_response_code)";
  $l_sql = "UPDATE $table_command SET status = '1', refpayment = '$sips_transaction_id', msgpayment = 'ERREUR : $l_msgpayment' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);
  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$p_numsession' AND status = '3'";
  $c_db->query($l_sql);
  if ($g_debugmode == 1)
  {
    $l_msg = "ERROR[$sips_response_code] : $l_msgpayment\n" . $l_msg;
    mail($g_kernixemail,"[SOGEN] ERROR : commande $p_idcommand : $sips_amount [$g_sitename]",$l_msg,"From: boutique $g_sitename <$g_kernixemail>","-f$g_kernixemail");
  }
}

$c_db->close();

?>
