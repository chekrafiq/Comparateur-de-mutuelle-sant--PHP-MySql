<?php

$l_sql = "SELECT * FROM $table_admsite, $table_admshop";
$c_db->query($l_sql);
$adm = $c_db->object_result();

$l_sql = "SELECT idmailing FROM $table_mailing WHERE status = '1'";
$c_db->query($l_sql);

if ($c_db->numrows == 0) return 0;

echo ". bulkmailing ... started<br>\n";

while ($obj = $c_db->object_result()){
  $tab_mailing[] = $obj->idmailing;
}

while ($l_idmailing = array_shift($tab_mailing)){
  $l_sql = "SELECT * FROM $table_mailing WHERE idmailing = '$l_idmailing' AND status = '1'";
  $c_db->query($l_sql);
  $mailing = $c_db->object_result();

  $l_cond = "1";
  if ($mailing->idegroup > 0) $l_cond .= " AND idegroup = '$mailing->idegroup'";
  if (!empty($mailing->sel_format)) $l_cond .= " AND format = '$mailing->sel_format'";
  if (!empty($mailing->sel_opt)) $l_cond .= " AND opt = '$mailing->sel_opt'";
  $l_cond .= " AND status = '1'";

  $l_sel = "email";
  if ($mailing->idegroup == 0) $l_sel = " DISTINCT(email) ";

  $l_sql = "SELECT $l_sel FROM $table_email WHERE $l_cond";
  $c_db->query($l_sql);

  $l_nbtotal = $c_db->numrows;
  $l_status  = 2;
  $l_debdate = date("Y-m-d G:i:s");
  $l_enddate = date("Y-m-d G:i:s");
  if ($l_nbtotal == 0) $l_status = 3;

  $l_sql = "UPDATE $table_mailing SET nbtotal = '$l_nbtotal', status = '$l_status', debdate = '$l_debdate', enddate = '$l_enddate' WHERE idmailing = $l_idmailing";
  $c_db->query($l_sql);

  if ($l_nbtotal == 0) continue;

  $l_sql = "SELECT $l_sel FROM $table_email WHERE $l_cond ORDER BY idemail";
  $c_db->query($l_sql);

  $mailing->body = ereg_replace("%%IDMAILING%%", $mailing->idmailing, $mailing->body);
  if (strlen($mailing->body)<6) continue;
  
  echo "[$mailing->name] ";
  
  $i = 1;
  mail($adm->email,"MAILING [$mailing->idmailing-$g_sitename] ... started",$mailing->body,$mailing->header,"-f$adm->email");
  while ($email = $c_db->object_result()){
//    print "$email->email\n";
    if ($mailing->replace_flag == 1) $mailing->body = ereg_replace("%%EMAIL%%", $email->email, $mailing->body);
    mail($email->email,$mailing->subject,$mailing->body,$mailing->header,"-f$adm->email");
    if (($i % 100) == 0)  system("/usr/local/bin/php -c /etc/kernix -q mailing_update.php $mailing->idmailing-$i");
    if (($i % 1000) == 0)
    {
//      mail("fx@kernix.com","MAILING [$mailing->idmailing-$g_sitename] ... en cours ($i emails)",$mailing->body,$mailing->header,"-f$g_kernixemail");
      sleep(15);
    }
    $i++;
  }
  
  $i--;
  mail($adm->email,"MAILING [$mailing->idmailing-$g_sitename] ... finished ($i emails)",$mailing->body,$mailing->header,"-f$adm->email");
  
  $l_enddate = date("Y-m-d G:i:s");
  $l_sql = "UPDATE $table_mailing SET status = '3', enddate = '$l_enddate' WHERE idmailing = $l_idmailing";
  $c_db->query($l_sql);
  
  echo "<br>\n";
  break;
}

echo ". bulkmailing ... finished<br>\n";

return 1;

?>
