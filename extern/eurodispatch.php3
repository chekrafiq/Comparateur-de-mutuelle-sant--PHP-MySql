<?php


//include("_kernix_/var.inc.php3");
//include("_kernix_/tables.inc.php3");

if ($p_action != "yes")
{
  return 0;
}



$l_yesterday = mktime(0,0,0,date("m"),date("d")-1,date("Y"));
//$l_yesterday = mktime(0,0,0,date("m"),date("d"),date("Y"));

$l_year  = date("Y",$l_yesterday);
$l_month = date("m",$l_yesterday);
$l_day   = date("d",$l_yesterday);


$l_sql = "SELECT idsupplier FROM supplier WHERE mode = 'EURODISPATCH'";
$c_db->query($l_sql);
if (!$c_db->numrows)
{
  print("pas de fournisseurs");
  return 0;
}

$i = 0;
while ($obj = $c_db->object_result())
{
  $tab_supplier[$i] = $obj->idsupplier;
  $i++;
}
$l_supplier = "(" . join(",",$tab_supplier) . ")";

$l_sql = "SELECT Cmd.idcommand FROM $table_command AS Cmd, $table_session AS Ses WHERE Cmd.status = '20' AND date_format(Cmd.validatedate,'%m') = '$l_month' AND  date_format(Cmd.validatedate,'%Y') = '$l_year' AND  date_format(Cmd.validatedate,'%d') = '$l_day' AND Ses.idsupplier IN $l_supplier AND Cmd.numsession = Ses.numsession GROUP BY idcommand";
$c_db->query($l_sql);

if (!($l_nbcommand = $c_db->numrows))
{
  print("pas de commandes");
  return 0;
}

$l_sql = "SELECT idsession FROM $table_session WHERE status = '20' AND date_format(validatedate,'%m') = '$l_month' AND  date_format(validatedate,'%Y') = '$l_year' AND  date_format(validatedate,'%d') = '$l_day' AND idsupplier IN $l_supplier";
$c_db->query($l_sql);
$l_nbproduct = $c_db->numrows;

$l_nbline = $l_nbcommand * 2 + $l_nbproduct + 2;

//print("$l_sql<br>$l_nbline = $l_nbcommand * 2 + $l_nbproduct + 2;<br>");

$l_extrem  = date("Y") . date("m") . date("d");
$l_extrem .= date("H") . date("i") . date("s");
$l_extrem .= str_pad($l_nbline,10,"0",STR_PAD_LEFT);  
$l_extrem .= str_pad($l_nbcommand,5,"0",STR_PAD_LEFT);  
$l_extrem .= str_pad($l_nbcommand,5,"0",STR_PAD_LEFT);  
$l_extrem .= str_pad($l_nbproduct,5,"0",STR_PAD_LEFT);  
$l_extrem .= str_pad(" ",408);  
$l_extrem .= str_pad(" ",50);  


$l_top     = "000" . $l_extrem . "\n";
$l_bottom  = "999" . $l_extrem . "\n";


// 300 - 310

$l_sql = "SELECT Clt.*, Cmd.*, date_format(Cmd.date,'%Y%m%d') AS cmddate, Pz.* FROM $table_command AS Cmd, $table_client AS Clt, $table_portzone AS Pz, $table_session AS Ses WHERE Cmd.status = '20' AND date_format(Cmd.validatedate,'%m') = '$l_month' AND  date_format(Cmd.validatedate,'%Y') = '$l_year' AND  date_format(Cmd.validatedate,'%d') = '$l_day' AND Cmd.idclient = Clt.idclient AND Pz.id_portzone = Clt.idportzone  AND Ses.idsupplier IN $l_supplier AND Cmd.numsession = Ses.numsession GROUP BY idcommand";
$c_db->query($l_sql);
//print("<br>$l_sql<br>");
while ($obj = $c_db->object_result())
{
  $l_300 .= "300CR";
  $l_300 .= str_pad($obj->idcommand,10," ",STR_PAD_RIGHT);
  $l_300 .= str_pad(" ",10);
  $l_300 .= str_pad("1",15," ",STR_PAD_RIGHT);
  $l_300 .= str_pad("$obj->title $obj->lastname $obj->firstname",32," ",STR_PAD_RIGHT);
  $l_300 .= "003";
  $l_300 .= str_pad(" ",15);
  $l_300 .= "STDN ";
  $l_300 .= str_pad($obj->cmddate,8," ",STR_PAD_RIGHT);
  $l_300 .= " ";
  $l_300 .= " ";
  $l_300 .= "001";
  $l_300 .= str_pad(" ",392);
  $l_300 .= "\n";


  $l_310 .= "310CR";
  $l_310 .= str_pad($obj->idcommand,10," ",STR_PAD_RIGHT);
  $l_310 .= str_pad(" ",10);
  $l_310 .= str_pad($obj->company,32," ",STR_PAD_RIGHT);
  $l_310 .= str_pad("$obj->title $obj->lastname $obj->firstname",32," ",STR_PAD_RIGHT);
  $obj->address = ereg_replace("\r?\n"," ",$obj->address);

//--> pr avoir 2 adr sur 32 
//  $l_310 .= str_pad($obj->address,32," ",STR_PAD_RIGHT);
//  $l_310 .= str_pad(" ",32);

//--> pr avoir 1 adr sur 64
  $l_310 .= str_pad($obj->address,64," ",STR_PAD_RIGHT); 

  $l_310 .= str_pad($obj->zipcode,10," ",STR_PAD_RIGHT);
  $l_310 .= str_pad($obj->town,32," ",STR_PAD_RIGHT);
  if (($obj->idportzone == 1) || ($obj->idportzone == 2))
    $l_310 .= str_pad("FRA",4," ",STR_PAD_RIGHT);
  else
    $l_310 .= str_pad("    ",4," ",STR_PAD_RIGHT);
  $l_310 .= str_pad(trim($obj->zone_name),32," ",STR_PAD_RIGHT);
  $l_310 .= str_pad(" ",269);
  $l_310 .= "\n";
}

// 320
$l_sql = "SELECT Cmd.idcommand, Cmd.numsession FROM $table_command AS Cmd, $table_session AS Ses WHERE Cmd.status = '20' AND date_format(Cmd.validatedate,'%m') = '$l_month' AND  date_format(Cmd.validatedate,'%Y') = '$l_year' AND  date_format(Cmd.validatedate,'%d') = '$l_day' AND Ses.idsupplier IN $l_supplier AND Cmd.numsession = Ses.numsession GROUP BY idcommand";
$c_db->query($l_sql);
$i = 0;
while ($obj = $c_db->object_result())
{
  $tab_cmd[$i][0] = $obj->idcommand;
  $tab_cmd[$i][1] = $obj->numsession;
  $i++;
}

$i = 0;
while ($tab_cmd[$i])
{
  $l_idcommand = $tab_cmd[$i][0];
  $l_numsession = $tab_cmd[$i][1];
  $l_sql = "SELECT * FROM $table_session WHERE numsession = '$l_numsession' AND idsupplier IN $l_supplier AND status = 20";
  $c_db->query($l_sql);
  $j = 1;
  while ($obj = $c_db->object_result())
  {
    $l_320 .= "320CR";
    $l_320 .= str_pad($l_idcommand,10," ",STR_PAD_RIGHT);
    $l_320 .= str_pad(" ",10);
    $l_320 .= str_pad($j,4," ",STR_PAD_RIGHT);
    $l_320 .= str_pad($obj->productcode,20," ",STR_PAD_RIGHT);
    $l_320 .= str_pad(" ",13);
    $l_320 .= str_pad($obj->quantity,9,"0",STR_PAD_LEFT);
    $l_320 .= str_pad(sprintf("%.2f",$obj->priceht),9,"0",STR_PAD_LEFT);
    $l_320 .= str_pad("0",9,"0");
    $l_320 .= str_pad(" ",1);
    $l_320 .= str_pad(" ",360);
    $l_320 .= str_pad(" ",50);
    $l_320 .= "\n";
    $j++;
  }
  $i++;
}

$l_text = $l_top . $l_300 . $l_310 . $l_320 . $l_bottom;

//$l_html = ereg_replace("\n","<br>\r\n",$l_text);
print("<pre>$l_text</pre>"); 

//return 0;

$l_file = $g_absolutepath . "/_kernix_/opt/eurodispatch/FIMAED";
$fp = fopen($l_file . "." . $l_year . $l_month . $l_day,"w+");
fwrite($fp,$l_text);
fclose($fp);

?>
