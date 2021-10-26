<?php

if (!isset($command->idcommand))
{
  return 0;
}

$merchant_id        = $adm->merchantnum; // 014213245611111
$amount             = floor($command->pricettcport * 100);
$currency_code      = $l_currency;
$language_code      = $adm->language;
$return_context     = "NULL";
$receipt_complement = "NULL";
$caddie             = $command->idcommand;
$data               = "$command->numsession|$p_fromref";

$cmd         = "sips_request $merchant_id $amount $currency_code $language_code $return_context $receipt_complement $caddie $data";
$sips_result = exec($cmd);

$tableau     = explode ("!", $sips_result);

$sips_code    = $tableau[1];
$sips_error   = $tableau[2];
$sips_message = $tableau[3];

if ($sips_code == -1)
{
  print("message erreur [$sips_result] : $sips_error <br>");
}
else 
{
  print($sips_message);
}

?>
