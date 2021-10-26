<?php
function show_date($date)
{
     $tmp = explode(" ",$date);
     $tmp1 = explode("-",$tmp[0]);
     $out = "$tmp1[2]/$tmp1[1]/$tmp1[0]";
     return($out);
}

function show_datetime($date)
{
     $tmp = explode(" ",$date);
     $tmp1 = explode("-",$tmp[0]);
     $tmp2 = explode(":",$tmp[1]);
     $out = "$tmp1[2]/$tmp1[1]/$tmp1[0] $tmp2[0]:$tmp2[1]";
     return($out);
}


function show_datetimesec($date)
{
     $tmp = explode(" ",$date);
     $tmp1 = explode("-",$tmp[0]);
     $tmp2 = explode(":",$tmp[1]);
     $out = "$tmp1[2]/$tmp1[1]/$tmp1[0] $tmp2[0]:$tmp2[1]:$tmp2[2]";
     return($out);
}

function date2bdd($date)
{
  $tmp = explode("/",$date);
  $out = "$tmp[2]-$tmp[1]-$tmp[0]";
  return $out;
}

function heure_diff($date, $i)
{
  $maintenant = time();
  
  $tab1 = explode(" ",$date);
  
  $tab_date = explode("-",$tab1[0]);
  $year = $tab_date[0];
  $month = $tab_date[1];
  $day = $tab_date[2];
  
  $tab_heure = explode("-",$tab1[1]);
  $hour = $tab_heure[0];
  $minute = $tab_heure[1];
  $second = $tab_heure[2];
  
  $old = mktime($hour,$minute,$second,$month,$day,$year);
  
  $result = $maintenant - $old;
  
  if ($result < (3600 * $i))
  {
    return 0;
  }
  else
  {
    return 1;
  }
} 

function jour_diff($date1, $date2)
{
  $tab1 = explode(" ",$date1);
  $tab_date = explode("-",$tab1[0]);
  $year = $tab_date[0];
  $month = $tab_date[1];
  $day = $tab_date[2];
  $d1 = mktime(0,0,0,$month,$day,$year);
  
  $tab1 = explode(" ",$date2);
  $tab_date = explode("-",$tab1[0]);
  $year = $tab_date[0];
  $month = $tab_date[1];
  $day = $tab_date[2];
  $d2 = mktime(0,0,0,$month,$day,$year);
  
  return ((max($d1, $d2) - min($d1, $d2)) / 86400);
} 
?>
