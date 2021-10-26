<?php

function nodekey_addonestep($car)
{
  $b_car = ord($car)+1;
  if ($b_car == 58) { $b_car = 65; }
  if ($b_car == 91) { $b_car = 97; }
  return (chr($b_car));
}

/*
function calc_newnodekey($l_prevnodekey)
{
  $l_tmpnodekey = substr($l_prevnodekey, -1);
  if ($l_tmpnodekey >= 'Z')
  {
    $l_tmpnodekey = substr($l_prevnodekey, -2, 1);
    $l_tmpnodekey2 = substr($l_prevnodekey, 0, -2);
    $l_tmpnodekey =  nodekey_addonestep($l_tmpnodekey) . '1';
  }
  else
  {
    $l_tmpnodekey2 = substr($l_prevnodekey, 0, -1);
    $l_tmpnodekey =  nodekey_addonestep($l_tmpnodekey);
  }
  
  return($l_tmpnodekey2 . $l_tmpnodekey);
}
*/

function calc_newnodekey($s)
{
  $n = strlen($s)-1;
  if ($s[$n] == 'Z')
  {
    $s[$n] = '1';
    $s[$n-1] = nodekey_addonestep($s[$n-1]);
  }
  else
  {
    $s[$n] = nodekey_addonestep($s[$n]);
  }
  return ($s);
}
?>
