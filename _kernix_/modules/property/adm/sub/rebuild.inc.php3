<?php

function split_refdata($str)
{
  $tab1 = explode("&",$str);
  $i = 0;
  while ($tab1[$i])
  {
    list ($code,$name,$val) = explode("=",$tab1[$i]);
    $tab2[$i][0] = $code;
    $tab2[$i][1] = urldecode($name);
    $tab2[$i][2] = urldecode($val);
    $i++;
  }
  return $tab2;
}

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);
$property = $c_db->object_result();

$tab_lines = explode("&&",$property->structure);

$i = 0;

while ($tab_lines[$i])
{
  list($code,$name,$var1,$var2) = explode(";;",$tab_lines[$i]); 
  $tab_caract[$code] = $name;
  $i++; 
}

$l_sql = "SELECT * FROM $table_ref WHERE idproperty = '$p_idproperty'";
$c_db->query($l_sql);
$i = 0;
while ($obj = $c_db->object_result())
{
  $tab_ref[$i][0] = $obj->idref;
  $tab_ref[$i][1] = $obj->data;
  $i++;
}

$l_nbupdate = 0;
$i = 0;
while ($tab_ref[$i])
{
  $tab_tmp = split_refdata($tab_ref[$i][1]);
  $l_updateflag = 0;
  $j = 0;
  $l_sepchar = "";
  $l_data = "";
  while ($tab_tmp[$j])
  {
    $l_code = $tab_tmp[$j][0];
    $l_data .= $l_sepchar . $l_code . "=" . $tab_caract[$l_code] . "=" . $tab_tmp[$j][2];
    if ($tab_tmp[$j][1] != $tab_caract[$tab_tmp[$j][0]])
    {
      $l_nbupdate++;
      $l_updateflag = 1;
    }
    $l_sepchar = "&";
    $j++;
  }
  if ( $l_updateflag == 1) 
  {
    
    $l_sql = "UPDATE $table_ref SET data = '$l_data' WHERE idref = " . $tab_ref[$i][0];
//    print($l_sql . "<br>");
    $c_db->query($l_sql);
  }
  $i++;
}

show_response("rebuild effectué < $l_nbupdate pages >");

include("sub/view.inc.php3");

?>
