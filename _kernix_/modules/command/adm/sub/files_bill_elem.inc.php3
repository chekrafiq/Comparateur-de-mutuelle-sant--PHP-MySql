<?php

if (isset($p_idcommand))
{
  break_page();
  print("<table width=100% height=$adm->headerheight border=0><tr><td></td></tr></table>");
  $g_idcommand = $p_idcommand;
}

$l_sql = "SELECT * FROM $table_command WHERE idcommand = '$g_idcommand'";
$c_db->query($l_sql);
$command = $c_db->object_result();

$l_sql = "SELECT C.*, Z.* FROM $table_client AS C, $table_zone AS Z WHERE C.idclient = '$command->idclient' AND C.idportzone = Z.id_portzone";
$c_db->query($l_sql);
$client = $c_db->object_result();

$l_sql = "SELECT * FROM $table_company";
$c_db->query($l_sql);
$company = $c_db->object_result();

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$command->numsession'";
$c_db->query($l_sql);

?>

<table border=0 cellspacing=1 cellpadding=0 width=95%>

 <tr>
  <td  class="main" width="60%" align="left" valign="top">
   <b><?=$company->companyname?></b> <br>
   <?php if (!empty($company->service)) print("<i>$company->service</i> <br>"); ?>
   <?=$company->address?> <br> 
   <?="$company->zipcode $company->town, $company->country"?> <br>
   tel : <?=$company->phone1?> <br>
   fax : <?=$company->fax?> <br><br>  
   <?=$company->forme?> au capital de <?=$company->capital?><br>
   Siret : <?=$company->siret?> <br>
   N�TVA: <?=$company->num_tva?> - APE: <?=$company->ape?><br>
  </td>
  <td align="left" valign="top" class="main">
   <b><?="$client->title $client->firstname $client->lastname"?></b><br>
   <?php if (!empty($client->company)) print("<i>$client->company</i><br>"); ?>
   <?=$client->address?> <br>
   <?="$client->zipcode $client->town,"?> <br>
   <?=$client->zone_name?> <br>
   <?="Tel : $client->phone<br>Email : $client->email1"?><br>
  </td>
 </tr>

</table>

<br><br><br><br>

<table bordercolor=#444F5F border=1 cellspacing=0 cellpadding=0 width=98%>

 <tr>
  <td  class=color2 width=30% align=center colspan=5 height=30><b>COMMANDE N� BTQ-<?php printf("%05d",$g_idcommand); ?></b> - <small><?php print(show_datetime($command->billdate)); ?> - [<?php print($command->mode); ?>]</small>
  <?php if (!empty($command->infos)) print("<br><small>$command->infos</small>"); ?>
  </td>
 </tr>

 <tr>
  <td class=listdarksmall width=50% align=center height=25>D�signation</td>
  <td class=listdarksmall width=10% align=center>Quantite</td>
  <td class=listdarksmall width=15% align=center>P.U H.T</td>
  <td class=listdarksmall width=10% align=center>Taxes</td>
  <td class=listdarksmall width=15% align=right>Total T.T.C</td>
 </tr>

<?php

$g_quantity     = 0;
$g_priceht      = 0;
$g_pricettc     = 0;
$g_pricettcport = 0;

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$command->numsession'";
$c_db->query($l_sql);

while ($session = $c_db->object_result())
{
  print("<tr>");
  print("<td class=list align=left height=20><br>");
  if (!empty($session->productcode))
  {
    print("[$session->productcode] ");
  }
  print($session->description);
  print(" ($session->idref)");
  if ($session->options)
  {
    $l_options = urldecode($session->options);
    $l_options = ereg_replace("&","<br> &middot; ",$l_options);
    $l_options = " &middot; " . $l_options;
    $l_options = ereg_replace("="," : ",$l_options);
    print("<br>$l_options");
  }
  print("<br><br></td>");
  print("<td class=list align=center>$session->quantity</td>");
  print("<td class=list align=center>$session->priceht $command->currency</td>");
  if ($session->taxe)
  {
    print("<td class=list align=center>$session->taxe%</td>");
  }
  else
  {
    print("<td class=list align=center>&nbsp;</td>");
  }
  $l_tmp = $session->quantity * $session->pricettc;
  print("<td class=list align=right>$l_tmp $command->currency</td>");
  print("</tr>");

}

?>

 <tr>
  <td  class=list align=center colspan=5>&nbsp;</td>
 </tr>

 <tr>
  <td  class=list align=left rowspan=3 valign=bottom>&nbsp;</td>
  <td  class=listdarksmall align=left colspan=3 height=25>Total H.T</td>
  <td  class=listdarksmall align=right><?php print("$command->priceht $command->currency"); ?></td>
 </tr>

 <tr>
  <td  class=listdarksmall align=left colspan=3 height=25>Total T.T.C</td>
  <td  class=listdarksmall align=right><?php print("$command->pricettc $command->currency"); ?></td>
 </tr>

 <tr>
  <td  class=listdarksmall align=left colspan=3 height=25><b>A PAYER</b><br>Total T.T.C + port (<?php echo ($command->pricettcport - $command->pricettc)." $command->currency"; ?>)</td>
  <td  class=listdarksmall align=right valign=top><b><?php print("$command->pricettcport $command->currency"); ?></b></td>
 </tr>

</table>

<br>

generated by KWO - kernix.com

<br><br>

<?php

if (isset($p_idcommand))
{
  break_page();
  show_back();
}

?>