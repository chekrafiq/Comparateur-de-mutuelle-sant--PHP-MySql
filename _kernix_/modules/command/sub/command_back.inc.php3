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
s'est produite durant<br>la phase de paiement s�curis�.</b> <br><br><br>
Vous ne serez d�bit� d'aucun montant.<br><br><br>
<!---
Nous vous invitons � rejoindre le site ...<br><br><br>

<input type="button" value="Cliquez ici pour revenir au site" Onclick="javascript:document.fin.submit()" class="caddiebutton">
//--->
<?php

elseif ($p_transacflag == "ANNUL") :

?>

<b>Vous avez annul� votre commande.</b> <br><br><br>
<!---
Nous vous invitons � rejoindre le site ...<br><br><br>

<input type="button" value="Cliquez ici pour revenir au site" Onclick="javascript:document.fin.submit()" class="caddiebutton">
//--->
<?php

else :

?>

Nous vous remercions d'avoir souscrit votre compl�mentaire sant� aupr�s d'AssurSant�.
<br><br>
<font color="#EABF40">Le num�ro de votre commande est <?php printf("%05d",$p_idcommand); ?>.</font>
<br><br>
<?php if ($l_command->mode == "CHQ") { ?>
Nous traitons votre dossier et vous renvoyons dans les plus brefs d�lais le contrat en 2 exemplaires;
<br><br>
A r�ception de votre contrat, veuillez nous retourner un exemplaire sign� ainsi que votre premier r�glement par ch�que.
<br><br>
<?php } else { ?>
Nous traitons votre dossier et vous renvoyons dans les plus brefs d�lais le contrat en 2 exemplaires ainsi qu'une autorisation de pr�l�vement automatique.
<br><br>
A r�ception de ces documents, veuillez nous retourner, sign�s, un exemplaire du contrat ainsi que l'autorisation de pr�l�vement.
<br><br>
<?php } ?>

D�s la souscription en ligne, vous b�n�ficiez d'une garantie imm�diate sans d�lais d'attente (sauf si date d'effet souhait�e post�rieure � la date du jour).
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
