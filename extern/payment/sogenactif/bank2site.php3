<?php

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


if ($sips_code == "-1")
{
// API CALL ERROR
}

$sips_response_code += 0;

if ($sips_response_code == 0)
{
  $p_transacflag = "OK";
}
else
{
  $g_payment_error_msg = $sips_response_code;
  $p_transacflag = "ERR";
}

$p_idcommand                   = $sips_caddie;
list($p_numsession,$p_fromref) = explode("|",$sips_data);

$p_za                          = "command";
$g_design                      = "zero";
$p_commandaction               = "command_back";

include("index.dyn.php3");

?>
