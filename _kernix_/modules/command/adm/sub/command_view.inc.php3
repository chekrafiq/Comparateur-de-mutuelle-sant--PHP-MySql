<?php

$l_sql = "SELECT * FROM $table_command WHERE idcommand = '$p_idcommand'";
$c_db->query($l_sql);

if (!($c_db->numrows > 0))
{
  show_response("Erreur : la commande < $p_idcommand  > n'existe pas.");
  include("sub/home.inc.php3");
  return 0;
}

$command = $c_db->object_result();

$l_sql = "SELECT idsession  FROM $table_session WHERE numsession = '$command->numsession' AND billdate != '$command->billdate'";
$c_db->query($l_sql);
if ($c_db->numrows >= 1)
{
  $l_sql = "DELETE FROM $table_session WHERE numsession = '$command->numsession' AND billdate != '$command->billdate'";
  $c_db->query($l_sql);
  show_response("command cleaned !!");
  mail($g_kernixemail,"command $command->idcommand cleaned [$g_sitename]","","Errors-to: $adm->email\n");
}
$l_sql = "SELECT * FROM $table_commandstatus WHERE mode = '$command->mode' ORDER BY status";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $tab_status[$obj->status] = $obj->name;
//  print("$obj->status $obj->name - ");
}


$l_sql = "SELECT * FROM $table_commandstatus WHERE mode = 'NONE' ORDER BY status";
$c_db->query($l_sql);
while ($obj = $c_db->object_result())
{
  $tab_status_none[$obj->status] = $obj->name;
//  print("$obj->status $obj->name - ");
}
$l_sql = "SELECT * FROM $table_currency WHERE idcurrency = '$command->idcurrency'";
$c_db->query($l_sql);
$currency = $c_db->object_result();

$l_sql = "SELECT C.*, Z.* FROM $table_client AS C, $table_zone AS Z WHERE C.idclient = '$command->idclient' AND C.idportzone = Z.id_portzone";
$c_db->query($l_sql);
$client = $c_db->object_result();

?>

<form method="POST" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_idcommand"  value="<?=$p_idcommand?>">
<input type="hidden" name="p_numsession" value="<?=$command->numsession?>">

<table width=98%>

<tr>
 <td align=left class=color1 colspan=2 height=20>
   :: commande [ <?=$command->idcommand?> ] 
      ( <small><?php print(show_datetime($command->date));?></small> - <small><?php print(show_datetime($command->billdate));?></small> ) 
 </td> 
</tr>

<tr>
 <td class=color2 width=30% align=right valign=top>
  contenu &nbsp;
 </td>
 <td class=listlightsmall>
 <?php
$l_sql = "SELECT * FROM $table_session WHERE numsession = '$command->numsession'";
$c_db->query($l_sql);

while ($session = $c_db->object_result())
{
  $l_options = urldecode($session->options);
  $l_options = ereg_replace("&",", ",$l_options);
  $l_options = ereg_replace("="," : ",$l_options);
  print('- ');
  if (!empty($session->productcode)) print("[$session->productcode] ");
  print(nl2br($session->description)."<br> $l_options<br> (qté = $session->quantity) $session->pricettc $command->currency T.T.C<br><br>");
}

 ?>
 </td>
</tr>

<tr>
 <td class=color2 align=right valign=top>
  client &nbsp;
 </td>
 <td class=listlightsmall>
 <?php print("<b>$client->title $client->firstname $client->lastname</b>"); ?> 
 &#187; <a href="<?php print("/$g_modulespath/client/adm/index.php3?p_clientaction=view&p_idclient=$command->idclient"); ?>" class=truelink>detail</a><br>
  <?php print("$client->address<br>"); ?>
  <?php print("$client->zipcode $client->town, $client->zone_name<br>"); ?>
  <?php print("tel: $client->phone - email: <a href=mailto:$client->email1 class=truelink>$client->email1</a><br><br>"); ?>
  
 </td>
</tr>

<tr>
<td class=color2 align=right height=20>
etat &nbsp;
</td>
<td class=color3>
<?php 

if (($command->status < 4) || ($command->status == 20)) print($tab_status_none[$command->status]);
else print($tab_status[$command->status]);

if ($command->status == 20) print("<font style='font-weight: normal;'> le < " . show_datetime($command->validatedate) . " ></font>");

?>
</td>
</tr>

<tr>
<td  class=color2 align=right>
total H.T &nbsp;
</td>
<td class=color3>
<?php print("$command->priceht $command->currency");?>
</td>
</tr>

<tr>
<td class=color2  align=right>
total T.T.C &nbsp;
</td>
<td class=color3>
<?php print("$command->pricettc $command->currency");?>
</td>
</tr>
<? /* ?>
<tr>
<td class=color2  align=right>
total T.T.C + port &nbsp;
</td>
<td class=color3>
<?php print("$command->pricettcport $command->currency");?>
</td>
</tr>

<tr>
<td  class=color2 align=right>
moyen de paiement &nbsp;
</td>
<td class=color3>
<?php 

switch ($command->mode)
{
  case "CHQ":
  print("CHEQUE");
  break;
  case "CCB":
  print("PAIEMENT ELECTRONIQUE : CB");
  break;
  case "TEST":
  print("TEST");
  break;
  case "VIR":
  print("VIREMENT");
  break;
}

if (!empty($command->msgpayment))
{
  print(" [<font style=\"font-weight: normal;\">$command->msgpayment</font>]");
}

?>
</td>
</tr>



<tr>
<td class=color2  align=right>
port &nbsp;
</td>
<td class=color3>
<?=$command->idport?>
</td>
</tr>



<tr>
 <td class=color2 align=right>
  ref payment &nbsp;
 </td>
 <td class=color3>
  <input type=text name=p_refpayment value="<?=$command->refpayment?>" class=text size=15>
 </td>
</tr>

<tr>
 <td class=color2 align=right>
  montant réglé &nbsp;
 </td>
 <td class=color3>
  <input type=text name=p_amountreceived value="<?=$command->amountreceived?>" class=text size=15>  <?=$g_currencyisocode?>
 </td>
</tr>

<tr>
 <td class=color2  align=right>
  source - vendeur &nbsp;
 </td>
 <td class=color3>
<?php print(build_select_csv("WEB,SMAIL,MAIL,FAX,PHONE",$command->source,"p_source","") . " - " . build_select_csv($adm->sellers,$command->seller,"p_seller","")); ?>
 </td>
</tr>

<tr>
 <td class=color2 align=right valign=top>
  infos &nbsp;
 </td>
 <td class=color3>
  <textarea name="p_infos" rows=4 cols=45 class=text><?php print(stripslashes($command->infos)); ?></textarea>
 </td>
</tr>

<? */ ?>

<?php if ($command->idaffiliate != 0): ?>

<tr>
 <td class=color2  align=right>
  affilié &nbsp;
 </td>
 <td class=color3>
  <a href="<?php print("$g_urlroot/$g_modulespath/affiliate/adm/index.php3?p_affiliateaction=view&p_idaffiliate=$command->idaffiliate");?>" class=truelink>Cliquez ici</a>
 </td>
</tr>

<?php endif; ?>

</table>

<? /* ?>

<br>
 <select name="p_commandaction" size="1">
  <option value="command_store">-- enregistrer --</option>
  <option value="session_view">-- voir la session en détails --</option>
  <option value="files_bill_elem">-- afficher une facture --</option>
  <option value="command_force_chgstatus">-- forcer un état --</option>
 </select>

 <input type="submit" name="submit" value="exécuter" class=button>

<? */ ?>
</form>


<?php 

show_hr();

?>

<form method="POST" action="<?php print($PHP_SELF)?>">
 <input type="hidden" name="p_commandaction"  value="command_chgstatus">
 <input type="hidden" name="p_idcommand"         value="<?php print($p_idcommand)?>">
 <input type="hidden" name="p_oldstatus"         value="<?php print($command->status)?>">

 <select name="p_status" size="1">
<?php
while (list($key, $value) = each ($tab_status)) 
{
  if ($key > $command->status)
  {
    print("<option value=$key>-- $value --</option>\n");
  }
}
?>
  <option value="20">-- finaliser la commande --</option>
  <option value="0">-- annuler la commande --</option>
 </select>

 <input type="submit" name="submit" value="changer l'état" class="button">

</form>

<?php
//include("sub/form_send_command.inc.php3");

ext_show_back("p_commandaction","home","",""); 

?>
