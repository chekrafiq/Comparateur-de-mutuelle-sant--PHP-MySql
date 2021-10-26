<?php

function get_tabdatas($str)
{
  $l_tabtmp = explode("&&",$str);
  $i = 0;
  while ($l_tabtmp[$i])
  {
    $l_tmp = explode(";;",$l_tabtmp[$i]);
    $l_tabd[$i][0] = urldecode($l_tmp[1]);
    $l_tabd[$i][1] = urldecode($l_tmp[2]);  
    $i++;
  }
  return $l_tabd;
}

function get_tabdatasbyname($str)
{
  //DEPRECATED !!
  $l_tabtmp = explode("&&",$str);
  $i = 0;
  while ($l_tabtmp[$i])
  {
    $l_tabtmp2 = explode(";;",$l_tabtmp[$i]);
    $l_nom = urldecode($l_tabtmp2[0]);
    if (!ereg("^p_",$l_nom))
    {
      $l_tabd["$l_nom"] = urldecode($l_tabtmp2[1]);
    }
    $i++;
  } 
  return $l_tabd;
}

function get_datasbyname($str)
{
  $l_tabtmp = explode("&&",$str);
  $i = 0;
  while ($l_tabtmp[$i])
  {
    $l_tabtmp2 = explode(";;",$l_tabtmp[$i]);
    $l_name = $l_tabtmp2[1];
    $l_tabd[$l_name] = urldecode($l_tabtmp2[2]);
    $i++;
  } 
  return $l_tabd;
}

function get_datasbycode($str)
{
  $l_tabtmp = explode("&&",$str);
  $i = 0;
  while ($l_tabtmp[$i])
  {
    $l_tabtmp2 = explode(";;",$l_tabtmp[$i]);
    $l_code = $l_tabtmp2[0];
//    $l_tabd[$l_code] = urldecode($l_tabtmp2[2]);
    $l_tabd[$l_code] = $l_tabtmp2[2];
    $i++;
  } 
  return $l_tabd;
}

?>
