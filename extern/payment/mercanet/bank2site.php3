<?php

$message = "message=$DATA";

$result = exec("merca_response $message");

$tableau     = explode ("!", $result);

$code                   = $tableau[1];
$error                  = $tableau[2];
$merchant_id            = $tableau[3];
$merchant_country       = $tableau[4];
$amount                 = $tableau[5];
$transaction_id         = $tableau[6];
$payment_means          = $tableau[7];
$transmission_date      = $tableau[8];
$payment_time           = $tableau[9];
$payment_date           = $tableau[10];
$response_code          = $tableau[11];
$payment_certificate    = $tableau[12];
$authorisation_id       = $tableau[13];
$currency_code          = $tableau[14];
$card_number            = $tableau[15];
$cvv_flag               = $tableau[16];
$cvv_response_code      = $tableau[17];
$bank_response_code     = $tableau[18];
$complementary_code     = $tableau[19];
$return_context         = $tableau[20];
$caddie                 = $tableau[21];
$receipt_complement     = $tableau[22];
$merchant_language      = $tableau[23];
$language               = $tableau[24];
$customer_id            = $tableau[25];
$order_id               = $tableau[26];
$customer_email         = $tableau[27];
$customer_ip_address    = $tableau[28];
$capture_day            = $tableau[29];
$capture_mode           = $tableau[30];
$data                   = $tableau[31];

if ($code == "" && $error == "")
{
  $p_transacflag = "ERR";
}

$response_code += 0;

if ($response_code == 0)
{
  $p_transacflag = "OK";
}
elseif ($response_code == 17)
{
  $g_payment_error_msg = $response_code;
  $p_transacflag = "ANNUL";
}
else
{
  $g_payment_error_msg = $response_code;
  $p_transacflag = "ERR";
}

list($p_idcommand,$p_numsession,$p_fromref) = explode("|",$caddie);

$p_za                          = "command";
$g_design                      = "zero";
$p_commandaction               = "command_back";

include("index.dyn.php3");

?>
