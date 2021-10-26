<?php

include("_kernix_/var.inc.php3");

$table_command	= "command";
$table_session	= "session";
$table_client	= "client";
$table_visitor	= "visitor";

$g_debugmode   = 1;

$message = "message=$DATA";

$result = exec("merca_response $message");
$tableau     = explode ("!", $result);

$code			= $tableau[1];
$error			= $tableau[2];
$merchant_id		= $tableau[3];
$merchant_country	= $tableau[4];
$amount			= $tableau[5];
$transaction_id		= $tableau[6];
$payment_means		= $tableau[7];
$transmission_date	= $tableau[8];
$payment_time		= $tableau[9];
$payment_date		= $tableau[10];
$response_code		= $tableau[11];
$payment_certificate	= $tableau[12];
$authorisation_id	= $tableau[13];
$currency_code		= $tableau[14];
$card_number		= $tableau[15];
$cvv_flag		= $tableau[16];
$cvv_response_code	= $tableau[17];
$bank_response_code	= $tableau[18];
$complementary_code	= $tableau[19];
$return_context		= $tableau[20];
$caddie			= $tableau[21];
$receipt_complement	= $tableau[22];
$merchant_language	= $tableau[23];
$language		= $tableau[24];
$customer_id		= $tableau[25];
$order_id		= $tableau[26];
$customer_email		= $tableau[27];
$customer_ip_address	= $tableau[28];
$capture_day		= $tableau[29];
$capture_mode		= $tableau[30];
$data			= $tableau[31];

list($p_idcommand,$p_numsession,$p_fromref) = explode("|",$caddie);

$l_msg = "code=$code\nerror=$error\ntransaction_id=$transaction_id\nresponse_code=$response_code\ncaddie=$caddie\ncurrency_code=$currency_code";

if ($code == "" && $error == "")
{
  $c_db->close();
  return 0;
}
elseif ($code != 0)
{
  $l_sql = "UPDATE $table_command SET status = '1', msgpayment = 'ERREUR' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);

  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$p_numsession' AND status = '3'";
  $c_db->query($l_sql);

  if ($g_debugmode == 1)
    mail($g_kernixemail,"[MERCA] ERROR* : commande $p_idcommand : $amount [$g_sitename]",$l_msg,"From: resaplace.com <$g_kernixemail>\nErrors-to:$g_kernixemail");
  $c_db->close();
  return 0;
}

$response_code += 0;

if ($response_code == 0)
{
  $l_sql = "UPDATE $table_command SET status = '20', validatedate = '$l_date' WHERE idcommand = '$p_idcommand' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  
  $l_sql = "UPDATE $table_session SET status = '20', validatedate = '$l_date' WHERE numsession = '$p_numsession' AND (status = '1' OR status = '3')";
  $c_db->query($l_sql);
  $p_paymentmode = 'CCB';
  
  $l_sql = "SELECT idclient FROM $table_command WHERE idcommand = '$p_idcommand'";
  $c_db->query($l_sql);
  $command = $c_db->object_result();

  // Update purchase flag
  $l_sql = "UPDATE $table_visitor SET purchase_flag = 1 WHERE idclient = '$command->idclient'";
  $c_db->query($l_sql);

  // Update nb purchase
  $l_sql = "UPDATE $table_client SET nbpurchase = nbpurchase+1 , lastpurchasedate = '$l_date' WHERE idclient = '$command->idclient'";
  $c_db->query($l_sql);

  $l_sql = "SELECT description FROM $table_session WHERE numsession = '$p_numsession' AND status = '20'";
  $c_db->query($l_sql);
  $l_obj = $c_db->object_result();
  
  $table_sp_parc          = "sp_parc";
  $table_sp_poche         = "sp_poche";
  $table_sp_services      = "sp_services";
  $table_sp_produits      = "sp_produits";
  $table_sp_adresse       = "DTWH_ADRESSE";
  $table_sp_servicepoche  = "DTWH_SERVICE_POCHE";
  $table_sp_tarifs        = "DTWH_TARIFS";
  $table_sp_ce            = "sp_clubexpress";
  $table_sp_resa          = "sp_resa";
  
  $l_tabpoche = get_pochebycode(get_codepoche($l_obj->description));
  $l_tabentree = explode(" ", trim(get_dateentree($l_obj->description)));
  $l_tabentree2 = explode("/", $l_tabentree[0]);
  make_resa($l_tabpoche["idpoche"], $l_tabentree2[2]."-".$l_tabentree2[1]."-".$l_tabentree2[0]);
  
  include("$g_modulespath/command/sub/command_mail.inc.php3");
  
  if ($g_debugmode == 1)
    mail($g_kernixemail,"[MERCA] OK : commande $p_idcommand : $amount [$g_sitename]",$l_msg,"From: resaplace.com <$g_kernixemail>\nErrors-to:$g_kernixemail");
}
else
{ 
  switch ($response_code)
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
  $l_msgpayment .= " ($response_code)";

  $l_sql = "UPDATE $table_command SET status = '1', refpayment = '$transaction_id', msgpayment = 'ERREUR : $l_msgpayment' WHERE idcommand = '$p_idcommand' AND status = '3'";
  $c_db->query($l_sql);

  $l_sql = "UPDATE $table_session SET status = '1' WHERE numsession = '$p_numsession' AND status = '3'";
  $c_db->query($l_sql);

  if ($g_debugmode == 1)
  {
    $l_msg = "ERROR[$response_code] : $l_msgpayment\n" . $l_msg;
    mail($g_kernixemail,"[MERCA] ERROR : commande $p_idcommand : $amount [$g_sitename]",$l_msg,"From: resaplace.com <$g_kernixemail>\nErrors-to:$g_kernixemail");
  }
}

$c_db->close();

?>
