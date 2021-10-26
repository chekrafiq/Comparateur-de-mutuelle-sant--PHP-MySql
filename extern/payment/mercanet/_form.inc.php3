<?php

if (!isset($command->idcommand))
{
  return 0;
}
$parm = "";

// 038792128100268
$parm .= "merchant_id=$adm->merchantnum";
//$parm .= "merchant_id=082584341411111";
$parm .= " merchant_country=fr";
$parm .= " amount=".floor($command->pricettcport * 100);
$parm .= " currency_code=978";
$parm .= " pathfile=./mercanet/pathfile_exec";
$parm .= " caddie=$p_idcommand|$command->numsession|$p_fromref";

$cmd         = "merca_request $parm";
$merca_result = exec($cmd);

$tableau     = explode ("!", $merca_result);

$merca_code    = $tableau[1];
$merca_error   = $tableau[2];
$merca_message = $tableau[3];

if ($merca_code == "" && $merca_error == "")
{
  print("message erreur [appel request] : executable non trouve <br>");
}
elseif ($merca_code != 0)
{
  print("message erreur [$merca_result] : $merca_error <br>");
}
else 
{
  print($merca_message);
}
?>
