<?php

$l_sql = "SELECT * FROM $table_company";
$c_db->query($l_sql);
$company = $c_db->object_result();

?>

<table border="0" cellspacing="1" cellpadding="0" width="95%">

 <tr>
  <td  class="caddiecolor1" width="50%" align="left" valign="top" rowspan="2">
   <b><?php print("$company->companyname $company->forme"); ?></b> <br>
   <?php if (!empty($company->service)) print("<i>$company->service</i> <br>"); ?> 
   <?=$company->address?> <br> 
   <?php print("$company->zipcode $company->town, $company->country"); ?> <br>
   tel : <?=$company->phone1?> <br>
   fax : <?=$company->fax?> <br>
   email : <?=$company->email?> <br><br>  
   <?=$company->forme?> au capital de <?=$company->capital?><br>
   siret: <?=$company->siret?> <br>
   N°TVA: <?=$company->num_tva?> - APE: <?=$company->ape?><br>

  </td>
  <td align="left" valign="top" class="caddiecolor1">
   <b><?php print("$client->title $client->firstname $client->lastname"); ?></b> <br>
   <?php if (!empty($client->company)) print("<i>$client->company</i> <br>"); ?> 
   <?=$client->address?> <br>
   <?php print("$client->zipcode $client->town"); ?>, <br>
   <?=$client->zone_name?> <br>
   tel : <?=$client->phone?> <br>
   email : <?=$client->email1?> <br><br>
   <span class="caddiecolor2">&#187; Pour modifier vos coordonnées,<br> <a href="<?=$g_urldyn?>?p_commandaction=client_view&p_za=command&p_fromref=<?=$p_fromref."&p_parc=".$p_parc."&p_poche=".$p_poche?>" title="modifier mes coordonnées" class="caddielink">cliquez ici</a>.</span>
  </td>
 </tr>

</table>

<br><br><br>

<table width="95%" bordercolor="#444F5F" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">

 <tr>
  <td  class="caddiecolor2" width="30%" align="center" colspan="5" height="30"><b><?php print(strtoupper($gl_bill)); ?>- <small><?php print(show_datetime($l_date)); ?></td>
 </tr>

 <tr>
  <td class="caddiecolor2" width="51%" align="center" height="20">Designation</td>
  <td class="caddiecolor2" width="12%" align="center">Qté</td>
  <td class="caddiecolor2" width="12%" align="center">PU H.T</td>
  <td class="caddiecolor2" width="10%" align="center">Taxe</td>
  <td class="caddiecolor2" width="15%" align="right">Total T.T.C</td>
 </tr>

<?php

$g_quantity     = 0;
$g_priceht      = 0;
$g_pricettc     = 0;
$g_pricettcport = 0;
$g_portval      = 0;
$g_portweight   = 0;
$g_tabportval   = array();
$g_tabportid    = array();

$l_sql = "SELECT * FROM $table_session WHERE numsession = '$g_numsession'";
$c_db->query($l_sql);

while ($session = $c_db->object_result())
{
  if (($client->frflag == 0) && ($adm->dutyfreeflag == 1))
  {
    $session->pricettc = $session->priceht;
  }
  print("<tr>");
  print("<td class=caddiecolor1 align=left height=20>&nbsp;");
  if (!empty($session->productcode))
  {
    print("[$session->productcode] ");
  }
  print("<b>" . $session->description . "</b>");
  $l_options = urldecode($session->options);
  $l_options = ereg_replace("&",", ",$l_options);
  $l_options = ereg_replace("="," : ",$l_options);
  //print("<br>&nbsp;$l_options");
  print("</td>");
  print("<td class=caddiecolor1 align=center valign=top>$session->quantity</td>");
  print("<td class=caddiecolor1 align=center valign=top>$session->priceht $g_currencyhtml</td>");
  $l_tmp             = $session->quantity * $session->pricettc;
  $g_quantity       += $session->quantity;
  $g_priceht        += $session->quantity * $session->priceht;
  $g_pricettc       += $l_tmp;

//----- CALCUL DES PORTS LOCAUX 
  $session->portvalue += 0;
  $l_idport = 0;

  if ($session->idport == 2) 
  { 
    $l_portvalue = 0; 
    $l_idport = 2; 
  } 
  elseif ($session->idport == 3)
    { 
      $l_portvalue = $session->portvalue * $session->quantity;
      $l_idport = 2;
    } 
  elseif ($session->idport == 10)
    { 
      $l_portvalue = $l_tmp * $session->portvalue / 100;
      $l_idport = 2;
    } 
  elseif ($session->idport >= 20)
    { 
      $l_portvalue = $session->portvalue * $session->quantity;
      $l_idport = $session->idport;
    } 
  else 
  { 
    if ($adm->idport == 0) 
    { 
      $l_portvalue = 0; 
      $l_idport = 2; 
    } 
    elseif ($adm->idport == 1)
      { 
	if ($l_globalportflag == 0)
	{
	  $l_globalportflag = 1;
	  $l_portvalue = $adm->portvalue;
	}
	else
	{
	  $l_portvalue = 0;
	}
	$l_idport = 2;
      } 
    elseif ($adm->idport == 3)
      { 
	$l_portvalue = $adm->portvalue * $session->quantity;
	$l_idport = 2;
      } 
    elseif ($adm->idport == 10)
      { 
	$l_portvalue = $l_tmp * $adm->portvalue / 100;
	$l_idport = 2;
      } 
    elseif ($adm->idport >= 20)
      { 
	$l_portvalue = $session->portvalue * $session->quantity;
	$l_idport = $adm->idport;
      }
  }
  array_push($g_tabportid, $l_idport);
  array_push($g_tabportval, $l_portvalue);

//------

  if (!empty($session->taxe))
  {
    print("<td class=caddiecolor1 align=center valign=top>$session->taxe%</td>");
  }
  else
  {
    print("<td class=caddiecolor1 align=center valign=top>&nbsp;</td>");
  }
  print("<td class=caddiecolor1 align=right valign=top>$l_tmp $g_currencyhtml</td>\n");
  print("</tr>\n\n");
}

?>


 <tr>
  <td class="caddiecolor1" align="left" rowspan="3" valign="bottom">&nbsp;</td>
  <td class="caddiecolor2" align="left" colspan="3">Total H.T</td>
  <td class="caddiecolor2" align="right"><?php print("$g_priceht $g_currencyhtml"); ?></td>
 </tr>

 <tr>
  <td class="caddiecolor2" align="left" colspan="3">Total T.T.C</td>
  <td class="caddiecolor2" align="right"><?php print("$g_pricettc $g_currencyhtml"); ?></td>
 </tr>

<?php 
//----- CALCUL DU PORT GLOBAL
$g_pricettcport = include("$g_modulespath/command/sub/command_port.inc.php3"); 
//----- 
?>

 <tr>
<!-- <td class="caddiecolor2" align="left" colspan="3" valign="top"><b><?php print(strtoupper($gl_topay)); ?></b><br>Total T.T.C + port <?php echo "(".($g_pricettcport - $g_pricettc)." $g_currencyhtml)"; ?> //--> 
 <td class="caddiecolor2" align="left" colspan="3" valign="top"><b><?php print(strtoupper($gl_topay)); ?></b>
  <?php if (($client->frflag == 0) && ($adm->dutyfreeflag == 1)) print("<br><small><i>NO TAXE OUT OF FRANCE</i></small>"); ?>
  </td>
  <td class="caddiecolor2" align="right" valign="top">
   <b><?php print("$g_pricettcport $g_currencyhtml"); ?><b> 
  </td>
 </tr>

</table>
