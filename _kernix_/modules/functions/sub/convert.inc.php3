<?php

function veaccents($str)
{  
     $str = strtr($str,   "ÀÁÂÃÄÅàáâãäåÒÓÔÕÖØòóôõöøÈÉÊËèéêëÇçÌÍÎÏìíîïÙÚÛÜùúûüÿÑñ",   "aaaaaaaaaaaaooooooooooooEEEEeeeecciiiiiiiiuuuuuuuuynn");  
     return $str;  
}  

function calc_taxe($price1, $value1, $sign)
{
  if ($sign == 0) return($price1);
  if ($sign == 1)
  {
    $l_price = $price1 + ($price1 * $value1 / 100);
  }
  else
  {
    $l_price = $price1 / (1 + ($value1 / 100));
  }
  return($l_price);
}

function get_proper_taxe($l_product, $adm_datas)
{
  if ($l_product->idtaxes)
  {
    //  print("->LOCAL: $l_product->idtaxes, $l_product->price<br>");
    $l_idtaxes = $l_product->idtaxes;
  }
  elseif ($adm_datas->idtaxes)
    {
      //  print("->SITE: $adm_datas->idtaxes, $l_product->price<br>");
      $l_idtaxes = $adm_datas->idtaxes;
    }
  else
  {
    //  print("->DEFAULT: 1, $l_product->price<br>");
    $l_idtaxes = 1;
  }
  return $l_idtaxes;
}

function get_proper_currency($l_product, $adm_datas)
{
  if ($l_product->idcurrency)
  {
    //print("->LOCAL: $l_product->idcurrency, $l_product->price<br>");
    $l_idcurrency = $l_product->idcurrency;
  }
  elseif ($adm_datas->idcurrency)
    {
      //print("->SITE: $adm_datas->idcurrency, $l_product->price<br>");
      $l_idcurrency = $adm_datas->idcurrency;
    }
  else
  {
    //print("->DEFAULT: 1, $l_product->price<br>");
    $l_idcurrency = 1;
  }
  return $l_idcurrency;
}

function bdd2txt($p_text)
{
  return $p_text;
}

function bdd2html($p_text)
{
     return nl2br($p_text);
}

function txt2bdd($p_text)
{
     return addslashes($p_text);
}

function get_text_wap($p_text)
{
     $l_text = ereg_replace("<br>", "<br/>", $p_text);
     $l_text = strip_tags($p_text);
//     $l_text = stripslashes($l_text);
     return $l_text;
}

function post2bdd($str)
{
  return strtr($str, "<", "_");
}

function get_text_link($str)
{
     $str = veaccents($str);
     $str = strtr($str,   ", ;:/!<>.#&+=^[](){}?|@\\'",   "_________________________");
     return $str;
}

?>
