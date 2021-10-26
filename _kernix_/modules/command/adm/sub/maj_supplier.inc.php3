<?php

$l_sql = "SELECT * FROM $table_supplier WHERE mode = 'EMAIL'";
$c_db->query($l_sql);
$i = 0;
while($supplier = $c_db->object_result())
{
  $tab_supplier[$supplier->idsupplier] = "EMAIL";
  $i++;
}

unset($tab_session);

$l_sql = "SELECT idsession, idsupplier FROM $table_session WHERE numsession = $command->numsession";
$c_db->query($l_sql);
$i = 0;
while($session = $c_db->object_result())
{
  if ($tab_supplier[$session->idsupplier] == "EMAIL")
  {
    $tab_session[$i] = $session->idsupplier;
  }
  $i++;
}

$i = 0;
while ($tab_session[$i])
{ 
  $l_sql = "SELECT * FROM $table_supplier WHERE idsupplier = " . $tab_session[$i];
  $c_db->query($l_sql);
  $supplier = $c_db->object_result();
  $l_sql = "SELECT * FROM $table_session WHERE numsession = $command->numsession AND idsupplier = " . $tab_session[$i];
  $c_db->query($l_sql);
  if ($supplier->mode == "EMAIL")
  {
    $l_header  = "";
    $l_header .= "From: boutique $g_sitename <$adm->email>\n";
    $l_header .= "Cc: $adm->email\n";
    $l_header .= "Reply-To: $adm->email\n";
    $l_header .= "Errors-To: $adm->email\n";
    $l_header .= "X-Mailer: KerniX WEB OFFICE\n";
    
    $l_body  = "Profil client :\n";
    $l_body .= " - nom     : $client->firstname\n";
    $l_body .= " - prénom  : $client->lastname\n";
    $l_body .= " - adresse : $client->address\n";
    $l_body .= " - ville   : $client->town ( $client->zipcode )\n";
    $l_body .= " - pays    : $client->zone_name\n";
    $l_body .= " - tel     : $client->phone\n";
    $l_body .= " - email   : $client->email1\n\n\n";
    $l_body .= "Commande : BTQ-" . sprintf("%05d",$command->idcommand) . " ,  datant du " . show_datetime($command->date) . " : \n";
    $l_body .= "------------------------------------------------------------------------------\n\n";
    while ($session = $c_db->object_result())
    {
      $l_options = "";
      if (!empty($session->options))
      {
	$l_options = "(" . urldecode($session->options) . ")";
	$l_options = ereg_replace("&",", ",$l_options);
	$l_options = ereg_replace("="," : ",$l_options);
      }
      $l_body .= " * <$session->productcode> $session->description $l_options\n";
      $l_body .= "   [ qté = $session->quantity ], PUHT = $session->purchasepriceht $session->currency\n\n";
    }
    $l_body .= "------------------------------------------------------------------------------\n\n\n";
    $l_title = "[F] commande $g_sitename < BTQ-" . sprintf("%05d",$command->idcommand) . " >";
    if ($g_sendflag == 1)
    {
      if ($g_pubflag == 1) $l_body .= $g_pubmsg;
//      $l_email = $supplier->email;
//      $l_email = $adm->email;
      mail($supplier->email, $l_title, $l_body, $l_header . "Bcc: <$adm->email>, <$g_kernixemail>\n");
    }    
  }
  $l_sql = "UPDATE $table_supplier SET nbsent = nbsent + 1";
  $c_db->query($l_sql);
  $i++;
}

?>
