<?php
$l_sql = "SELECT description FROM $table_session WHERE numsession = '$p_numsession'";
$c_db->query($l_sql);
$l_obj = $c_db->object_result();

$l_sql = "SELECT * FROM $table_command WHERE numsession = '$p_numsession'";
$c_db->query($l_sql);
$l_command = $c_db->object_result();
?>

<form name="fin" id="fin" method="post" action="/?p_idref=17">
</form>

<table width="100%"  border="0" cellspacing="15" cellpadding="0">
 <tr>
  <td width="76%" valign="top">

   <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_top.gif" width="450" height="8"></td>
    </tr>
    <tr>
     <td background="<?=$g_modulespicturepath?>/devis/encart_pattern.gif">

      <table width="100%" border="0" cellspacing="0" cellpadding="6">
        <tr><td width="100%" class="contenu" colspan="2" align="center">
<?php

if ($p_transacflag == "ERR") :

?>

<b>Une erreur [<?php print($g_payment_error_msg); ?>]
s'est produite durant<br>la phase de paiement sécurisé.</b> <br><br><br>
Vous ne serez débité d'aucun montant.<br><br><br>
<!---
Nous vous invitons à rejoindre le site ...<br><br><br>

<input type="button" value="Cliquez ici pour revenir au site" Onclick="javascript:document.fin.submit()" class="caddiebutton">
//--->
<?php

elseif ($p_transacflag == "ANNUL") :

?>

<b>Vous avez annulé votre commande.</b> <br><br><br>
<!---
Nous vous invitons à rejoindre le site ...<br><br><br>

<input type="button" value="Cliquez ici pour revenir au site" Onclick="javascript:document.fin.submit()" class="caddiebutton">
//--->
<?php

else :

?>

Nous vous remercions d'avoir souscrit votre complémentaire santé auprès d'AssurSanté.
<br><br>
<font color="#EABF40">Le numéro de votre commande est <?php printf("%05d",$p_idcommand); ?>.</font>
<br><br>
<?php if ($l_command->mode == "CHQ") { ?>
Nous traitons votre dossier et vous renvoyons dans les plus brefs délais le contrat en 2 exemplaires;
<br><br>
A réception de votre contrat, veuillez nous retourner un exemplaire signé ainsi que votre premier règlement par chèque.
<br><br>
<?php } else { ?>
Nous traitons votre dossier et vous renvoyons dans les plus brefs délais le contrat en 2 exemplaires ainsi qu'une autorisation de prélèvement automatique.
<br><br>
A réception de ces documents, veuillez nous retourner, signés, un exemplaire du contrat ainsi que l'autorisation de prélèvement.
<br><br>
<?php } ?>

Dès la souscription en ligne, vous bénéficiez d'une garantie immédiate sans délais d'attente (sauf si date d'effet souhaitée postérieure à la date du jour).
<br><br>
Vous allez recevoir dans quelques minutes<br>la confirmation par mail de votre souscription.<br><br><br>
Nous vous remercions de votre confiance.

<?php

endif;

?>
    <br><br><br>
        </td>
       </tr>
      </table>
     </td>
    </tr>
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_bottom.gif" width="450" height="8"></td>
    </tr>
   </table>
   <br>
  </td>
  <td width="24%" align="center" valign="top"> 
    &nbsp;
  </td>
 </tr>
</table>
