<?php

if (!isset($_POST['p_email1'])) :

?>

<form method="POST" action="<?=$PHP_SELF?>" name="commande">
<input type=hidden name="p_za"            value="command">
<input type=hidden name="p_commandaction" value="client_forgetpass">
<input type=hidden name="p_fromref"       value="<?=$p_fromref?>">
<input type="hidden" name="p_parc" value="<?=$p_parc?>">
<input type="hidden" name="p_poche" value="<?=$p_poche?>">
<input type="hidden" name="p_idnumsession"  value="<?=$g_numsession?>">

Indiquez votre adresse E-mail, la même que celle que vous avez utilisée lors de la création de votre compte client, et nous vous adresserons par mail votre mot de passe des que vous aurez cliqué sur Envoyer.

<table align="center" width="50%"> 
 <tr>
  <td align="left" class="caddiecolor1"><b><?=$gl_email?></b> :</td> 
 </tr>
 <tr>
  <td align="left" class="caddiecolor1"><input type="text" name="p_email1" class="caddietext" size="40"><br></td>
 </tr> 
 <tr>
  <td class="caddiecolor1" align="left"><br><input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">&nbsp;<input type="submit" value="Envoyer" class="caddiebutton"></td>
 </tr>
</table> 

</form>

<?php

return 1;
endif;

$l_sql = "SELECT * FROM $table_client WHERE email1 = '$p_email1'";
$c_db->query($l_sql);

if ($c_db->numrows == 0)
{
  $l_back = "history";
  $l_caddie_error_msg = "erreur lors de l'identification.";
  include("$g_modulespath/command/sub/_error.inc.php3");
  return 0;
}

$client = $c_db->object_result();

$table_msg = "msg";
$l_sql = "SELECT description FROM $table_msg WHERE code = 'MAIL_PASS_CLIENT'";
$c_db->query($l_sql);
$l_msg   = $c_db->result(0,"description");

if (($g_sendflag == 1) && is_valid_email($p_email1))
{
  $l_body  =  ($client->title == "Mr") ? "Cher" : "Chère";
  $l_body .= " $client->title $client->lastname,\n\n";
  $l_body .= "Vous êtes client de resaplace.com et vous avez oublié votre mot de passe.\n\n";
  $l_body  .= "Votre identifiant et votre mot de passe sont :\n\n";
  $l_body .= "  - E-mail     : $p_email1\n";
  $l_body .= "  - Mot de passe : $client->password\n\n";
  $l_body .= $l_msg;
  
  if ($g_pubflag == 1) $l_body .= $g_pubmsg;
  mail($p_email1, "Vos accès sur resaplace.com", $l_body, "From: resaplace.com <$adm->email>\nErrors-to: $adm->email\n");
}
?>

<form method="POST" action="<?=$PHP_SELF?>">
 <input type="hidden" name="p_za"             value="command"> 
 <input type="hidden" name="p_commandaction"  value="client_add">
 <input type="hidden" name="p_fromref"        value="<?=$p_fromref?>">
<input type="hidden" name="p_parc" value="<?=$p_parc?>">
<input type="hidden" name="p_poche" value="<?=$p_poche?>">
<input type="hidden" name="p_idnumsession"  value="<?=$g_numsession?>">

<table align="center" width="95%"> 
 <tr>
  <td class="caddiecolor1" align="center"><br>Votre mot de passe vient de vous être envoyé par mail à l'adresse <?=$p_email1?>.</td>
 </tr>
 <tr>
  <td class="caddiecolor1" align="center"><br><input type="submit" value="Retour" class="caddiebutton"></td>
 </tr>
</table> 

</form>
