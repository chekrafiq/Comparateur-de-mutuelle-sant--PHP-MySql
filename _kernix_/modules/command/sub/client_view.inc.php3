<?php

if (!isset($_POST['p_email1']) || !isset($_POST['p_password'])) :

?>

<form method="POST" action="<?=$PHP_SELF?>" name="commande">
<input type=hidden name="p_za"            value="command">
<input type=hidden name="p_commandaction" value="client_view">
<input type=hidden name="p_fromref"       value="<?=$p_fromref?>">
<input type="hidden" name="p_parc" value="<?=$p_parc?>">
<input type="hidden" name="p_poche" value="<?=$p_poche?>">


<table align="center" width="50%"> 
 <tr>
  <td align="left" class="caddiecolor1"><b><?=$gl_email?></b> :</td> 
 </tr>
 <tr>
  <td align="left" class="caddiecolor1"><input type="text" name="p_email1" class="caddietext" size="40"><br></td>
 </tr> 
 <tr>
  <td align="left" class="caddiecolor1"><b><?=$gl_password?></b> :</td> 
 </tr>
 <tr>
  <td align="left" class="caddiecolor1"><input type="password" name="p_password" class="caddietext" size="40" autocomplete="off"></td>
 </tr>
 <tr>
  <td class="caddiecolor1" align="left"><br><input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">&nbsp;<input type="submit" value="<?=$gl_modifyprofile?>" class="caddiebutton"></td>
 </tr>
</table> 

</form>

<?php

return 1;
endif;

$l_sql = "SELECT * FROM $table_client WHERE email1 = '$p_email1' AND password = '$p_password'";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  $l_caddie_error_msg = "erreur lors de l'identification.";
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

$client = $c_db->object_result();

$l_countrylist = build_select("port_zone",$client->idportzone,"id_portzone","zone_name","p_idportzone","","","class=caddietext");

?>

<br>

<form method="POST" action="<?=$PHP_SELF?>">
 <input type="hidden" name="p_za"             value="command"> 
 <input type="hidden" name="p_commandaction"  value="client_store">
 <input type="hidden" name="p_idclient"       value="<?=$client->idclient?>">
 <input type="hidden" name="p_fromref"        value="<?=$p_fromref?>">
<input type="hidden" name="p_parc" value="<?=$p_parc?>">
<input type="hidden" name="p_poche" value="<?=$p_poche?>">


<table align="center" width="95%"> 
 <tr>
  <td align="right" class="caddiecolor1" width="30%">&nbsp;</td> 
  <td class="caddiecolor1">
   <select name="p_title" class="caddietext">
    <option value="Mr">Mr.</option>
    <option value="Mme" <?php if ($client->title == "Mme") print("SELECTED"); ?>>Mme.</option>
    <option value="Mme" <?php if ($client->title == "Mle") print("SELECTED"); ?>>Mle.</option>
   </select>
  </td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><b><?=$gl_lastname?></b></td> 
  <td class="caddiecolor1"><input type="text" name="p_lastname" class="caddietext" value="<?=$client->lastname?>" size="40"></td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><b><?=$gl_firstname?></b></td> 
  <td class="caddiecolor1"><input type="text" name="p_firstname" class="caddietext" value="<?=$client->firstname?>" size="40"></td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><?=$gl_company?></td> 
  <td class="caddiecolor1"><input type="text" name="p_company" class="caddietext" value="<?=$client->company?>"> *</td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><b>email</b></td> 
  <td class="caddiecolor1"><input type="text" name="p_email1" class="caddietext" value="<?=$client->email1?>" size="40"></td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><b><?=$gl_phone?></b></td> 
  <td class="caddiecolor1"><input type="text" name="p_phone" class="caddietext" value="<?=$client->phone?>"></td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><?=$gl_cellphone?></td> 
  <td class="caddiecolor1"><input type="text" name="p_cellphone" class="caddietext" value="<?=$client->cellphone?>"> *</td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1" valign="top"><b><?=$gl_address?></b></td> 
  <td class="caddiecolor1"><textarea name="p_address" cols="40" rows="2" class="caddietext"><?=$client->address?></textarea>
  </td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><b><?=$gl_town?></b></td> 
  <td class="caddiecolor1"><input type="text" name="p_town" class="caddietext" value="<?=$client->town?>" size="40"></td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><b><?=$gl_zipcode?></b></td> 
  <td class="caddiecolor1"><input type="text" name="p_zipcode" class="caddietext" value="<?=$client->zipcode?>"></td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1"><b><?=$gl_country?></b></td>
  <td class="caddiecolor1"><?=$l_countrylist?></td>
 </tr>
 <tr>
  <td align="right" class="caddiecolor1">&nbsp;</td>
  <td class="caddiecolor1" align="left"><br><input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">&nbsp;<input type="submit" value="<?=$gl_saveprofile?>" class="caddiebutton"></td>
 </tr>
</table> 

</form>

