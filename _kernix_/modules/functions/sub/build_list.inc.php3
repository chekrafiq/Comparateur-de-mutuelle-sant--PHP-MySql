<?php

function build_select($table_name,$optionsel,$optionval,$optionname,$selectname,$sql,$zeroname,$class)
{
  global $c_db;

  $l_sql = "SELECT $optionval, $optionname FROM $table_name " . $sql;
  $c_db->query($l_sql);
//  $out = "- $l_sql";
//  return $out;
  $out = "<select name=$selectname $class>\n";
  if (!empty($zeroname))
  {
    if ($optionsel == 0) $l_selected = "SELECTED";
    $out .= "<option value=0 $l_selected>-- $zeroname --</option>\n";
  }
  $n = $c_db->numrows;
  for ($i=0;$i<$n;$i++)
  {
    $l_selected = "";
    $val  = $c_db->result($i,$optionval);
    $name = $c_db->result($i,$optionname);
    if ($optionsel == $val) $l_selected = "SELECTED";
    $out .= "<option value=\"$val\" $l_selected>-- " . strtoupper($name) . " --</option>\n";
  }
  $out .= "</select>\n";
  return $out;
}

function build_select_wrvg($table_name,$optionsel,$optionval,$optionname,$selectname,$sql,$zeroname,$class,$zerovalue,$randomname,$randomvalue) // with random value gestion
{
  global $c_db;

  $l_sql = "SELECT $optionval, $optionname FROM $table_name " . $sql;
  $c_db->query($l_sql);
//  $out = "- $l_sql";
//  return $out;
  $out = "<select name=$selectname $class>\n";
  if (!empty($zeroname))
  {
    if ($optionsel == $zerovalue) $l_selected = "SELECTED";
    $out .= "<option value=\"$zeroevalue\" $l_selected>-- $zeroname --</option>\n";
  }
  $l_selected = "";
  if (!empty($randomname))
  {
    if ($optionsel == $randomvalue) $l_selected = "SELECTED";
    $out .= "<option value=\"$randomvalue\" $l_selected>-- $randomname --</option>\n";
  }
  $n = $c_db->numrows;
  for ($i=0;$i<$n;$i++)
  {
    $l_selected = "";
    $val  = $c_db->result($i,$optionval);
    $name = $c_db->result($i,$optionname);
    if ($optionsel == $val) $l_selected = "SELECTED";
    $out .= "<option value=\"$val\" $l_selected>-- " . strtoupper($name) . " --</option>\n";
  }
  $out .= "</select>\n";
  return $out;
}

function build_select_csv($csv,$optionsel,$selectname,$class)
{
  $out = "<select name=$selectname $class>\n";
  $tab = explode(",",$csv);
  $i = 0;
  while ($val = $tab[$i])
  {
    $l_selected = "";
    if ($optionsel == $val) $l_selected = "SELECTED";
    $out .= "<option value=\"$val\" $l_selected>-- " . strtoupper($val) . " --</option>\n";
    $i++;
  }
  $out .= "</select>\n";
  return $out;
}


function yesno_list($l_refvalue, $l_pname)
{
  $l_select_liste = "<select name=$l_pname>";
  $l_select_liste .= "<option value=1 ";
  if ($l_refvalue == 1): $l_select_liste .= "selected"; endif;
  $l_select_liste .= ">-- OUI --</option>";
  $l_select_liste .= "<option value=0 ";
  if ($l_refvalue == 0): $l_select_liste .= "selected"; endif;
  $l_select_liste .= ">-- NON --</option>";
  $l_select_liste .= "</select>\n";
  return $l_select_liste;
}

?>
