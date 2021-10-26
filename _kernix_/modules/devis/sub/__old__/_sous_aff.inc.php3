<?php
  if ($p_etape == 2)
  {
    if ($l_error >= 1)
    {
?>
        <tr><td width="100%" class="contenu" colspan="2">
<br />
<div align="center" class="contenu"><strong>Erreur dans le formulaire !</strong><br />
<br />
Vous devez remplir correctement
<br />
<strong>tous les champs obligatoires du formulaire</strong>.
<br />
<?php
if ($l_error > 1)
{
	echo "<br />Une erreur a été détectée sur le champs : <strong>";
	switch ($l_error)
	{
		case 2:
		echo "numéro de sécurité sociale";
		break;
		case 3:
		echo "clé de la sécurité sociale";
		break;
		case 4:
		echo "adresse email";
                break;
	        case 5:
	        echo "Incohérence du champ département et du champ code postal";
		break;
	}
	echo "</strong>.<br />";
}
?>
<br />
</div>
       </td></tr>
<?php 
    }
    else
    { 
?>
        <tr><td width="100%" class="contenu" colspan="2">
         <?=get_msg("SOUS_ACC1")?>
        </td></tr>
<?php
    }
?>
	<tr><td align="center" colspan="2"><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"></td></tr>
        <tr><td width="100%" class="contenu"  colspan="2">
<strong>Informations concernant les assurés</strong>
<br />
<i>Attention : les champs suivis  de <?=$g_champsolbigatoire?> sont obligatoires.</i>
<br />
        </td></tr>

<?php foreach ($tab_sous2 as $skey => $sval) { ?>
        <tr><td width="100%" class="contenu" colspan="2" align="left">
         <strong><?php if ($skey > 10) echo "<img src='$g_modulespicturepath/devis/picto_enfant.gif' hspace='2' align='absmiddle'> Enfant n°".($skey-10)." (ayant droit de l'adulte n°".$sval["ad"].")"; elseif ($skey == 1) echo "<img src='$g_modulespicturepath/devis/picto_parent.gif' hspace='2' align='absmiddle'> Souscripteur (adulte n°$skey)"; else echo "<img src='$g_modulespicturepath/devis/picto_parent.gif' hspace='2' align='absmiddle'> Conjoint (adulte n°$skey)"; ?><strong>
        </td></tr>
           
        <tr><td width="50%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
Nom :
<br />
<br />
<br />
Prénom :
<br />
<br />
<br />
Date de naissance :
<br>
<i>ex: 12/02/1976</i>
        </td>
        <td width="50%" class="contenu" valign="top">
<input type="text" name="p_<?=$skey?>_nom" value="<?=$sval["nom"]?>" size="25"><?=$g_champsolbigatoire?>
<br />
<br />
<input type="text" name="p_<?=$skey?>_prenom" value="<?=$sval["prenom"]?>" size="25"><?=$g_champsolbigatoire?>
<br />
<br />
<SCRIPT LANGUAGE="JavaScript" ID="jscal<?=$skey?>">
var cal<?=$skey?> = new CalendarPopup();
cal<?=$skey?>.setMonthNames('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');
cal<?=$skey?>.setDayHeaders('D','L','M','M','J','V','S');
cal<?=$skey?>.setWeekStartDay(1);
cal<?=$skey?>.setTodayText("");
cal<?=$skey?>.showYearNavigation();
cal<?=$skey?>.showYearNavigationInput();
</SCRIPT>
<input type="text" name="p_<?=$skey?>_nai" value="<?=$sval["nai"]?>" size="10"><?=$g_champsolbigatoire?>
<a HREF="#" onClick="cal<?=$skey?>.select(document.suitedevis.p_<?=$skey?>_nai,'anchor<?=$skey?>','dd/MM/yyyy','01/01/1984'); return false;" TITLE="afficher le calendrier" NAME="anchor<?=$skey?>" ID="anchor<?=$skey?>"><span class="contenu_rouge">calendrier</span></a>
        </td></tr>
<?php if ($skey <= 10) { ?>
        <tr><td width="50%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
Numéro et clé de sécurité sociale :
<br />
<!--
<br />
<br />
Code grand régime et code caisse :
//-->
<?php if ($sval["regime"] == "T.N.S.") { ?>
<!--
<br />
<br />
<br />
Adhérent :
//-->
<?php } ?>
        </td>
        <td width="50%" class="contenu" valign="top">
<input type="text" name="p_<?=$skey?>_secu" value="<?=$sval["secu"]?>" size="13"><?=$g_champsolbigatoire?>&nbsp;-&nbsp;<input type="text" name="p_<?=$skey?>_cle" value="<?=$sval["cle"]?>" size="2"><?=$g_champsolbigatoire?>
<!--
<br />
<br />
<input type="text" name="p_<?=$skey?>_codegr" value="<?=$sval["codegr"]?>" size="2">&nbsp;-&nbsp;<input type="text" name="p_<?=$skey?>_codec" value="<?=$sval["codec"]?>" size="3">
//-->
<input type="hidden" name="p_<?=$skey?>_codegr" value="<?=$sval["codegr"]?>">
<input type="hidden" name="p_<?=$skey?>_codec" value="<?=$sval["codec"]?>">
<?php if ($sval["regime"] == "T.N.S.") { ?>
<!---
<br />
<br />
<input type="radio" name="p_<?=$skey?>_tns" value="RAM" <?=($sval["tns"]=="RAM")?"checked":""?>>RAM
<input type="radio" name="p_<?=$skey?>_tns" value="autre" <?=($sval["tns"]=="autre")?"checked":""?>>autre organisme
<?=$g_champsolbigatoire?>
//--->
<?php } ?>
        </td></tr>
<?php } ?>
<?php if ($skey == 1) { ?>
        <tr><td height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
Titre :
<br />
<br />
<br />
Email :
<br />
<br />
<br />
Complément d'identité :
<br />
<br />
<br />
N° et Rue :
<br />
<br />
<br />
Rés., Bât., Appt. :
        </td>
        <td class="contenu" valign="top">
<?php if ($sval["sexe"] == "H" || empty($sval["sexe"])):?>
<input type="radio" name="p_<?=$skey?>_titre" value="M." <?=($sval["titre"]=="M." || $sval["sexe"]=="H")?"checked":""?>>M.
<?php endif; ?>
<?php if ($sval["sexe"] == "F" || empty($sval["sexe"])):?>
<input type="radio" name="p_<?=$skey?>_titre" value="Mme" <?=($sval["titre"]=="Mme")?"checked":""?>>Mme
<input type="radio" name="p_<?=$skey?>_titre" value="Mlle" <?=($sval["titre"]=="Mlle")?"checked":""?>>Mlle
<?php endif; ?>
<?=$g_champsolbigatoire?>
<br />
<br />
<input type="text" name="p_<?=$skey?>_email" value="<?=$sval["email"]?>" size="25"><?=$g_champsolbigatoire?>
<br />
<br />
<input type="text" name="p_<?=$skey?>_cplident" value="<?=$sval["cplident"]?>" size="25">
<br />
<br />
<input type="text" name="p_<?=$skey?>_numero" value="<?=$sval["numero"]?>" size="3">&nbsp;-&nbsp;<input type="text" name="p_<?=$skey?>_rue" value="<?=$sval["rue"]?>" size="20"><?=$g_champsolbigatoire?>
<br />
<br />
<input type="text" name="p_<?=$skey?>_res" value="<?=$sval["res"]?>" size="25">
        </td></tr>
        <tr><td height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
Lieu-dit/Hameau et Code postal :
<br />
<br />
<br />
Localité :
<br />
<br />
<br />
Téléphone domicile :
<br />
<br />
<br />
Téléphone professionnel et Fax :
        </td>
        <td class="contenu" valign="top">
<input type="text" name="p_<?=$skey?>_lieudit" value="<?=$sval["lieudit"]?>" size="15">&nbsp;-&nbsp;<input type="text" name="p_<?=$skey?>_cp" value="<?=$sval["cp"]?>" size="5"><?=$g_champsolbigatoire?>
<br />
<br />
<input type="text" name="p_<?=$skey?>_ville" value="<?=$sval["ville"]?>" size="25"><?=$g_champsolbigatoire?>
<br />
<br />
<input type="text" name="p_<?=$skey?>_tel" value="<?=$sval["tel"]?>" size="10"><?=$g_champsolbigatoire?>
<br />
<br />
<input type="text" name="p_<?=$skey?>_telpro" value="<?=$sval["telpro"]?>" size="10">&nbsp;-&nbsp;<input type="text" name="p_<?=$skey?>_fax" value="<?=$sval["fax"]?>" size="10">
        </td></tr>
        <tr><td height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
<br />
Statut :
<br />
<br />
<br />
<br />
<br />
Enfant(s) à charge :
        </td>
        <td class="contenu" valign="top">
<input type="radio" name="p_<?=$skey?>_statut" value="celibataire" <?=($sval["statut"]=="celibataire")?"checked":""?>>Célibataire
<input type="radio" name="p_<?=$skey?>_statut" value="marie" <?=($sval["statut"]=="marie")?"checked":""?>>Marié(e)
<input type="radio" name="p_<?=$skey?>_statut" value="divorce" <?=($sval["statut"]=="divorce")?"checked":""?>>Divorcé(e)
<input type="radio" name="p_<?=$skey?>_statut" value="veuf" <?=($sval["statut"]=="veuf")?"checked":""?>>Veuf(veuve)
<input type="radio" name="p_<?=$skey?>_statut" value="concubin" <?=($sval["statut"]=="concubin")?"checked":""?>>Concubin(e)
<?=$g_champsolbigatoire?>
<br />
<br />
<input type="radio" name="p_<?=$skey?>_enfantacharge" value="oui" <?=($sval["enfantacharge"]=="oui")?"checked":""?>>oui
<input type="radio" name="p_<?=$skey?>_enfantacharge" value="non" <?=($sval["enfantacharge"]=="non")?"checked":""?>>non
<!--<?=$g_champsolbigatoire?>-->
        </td></tr>
<?php } ?>

<?php } ?>
        </td></tr>
<td class="contenu" colspan=2>  <input type="checkbox" name="p_<?=$skey?>_pref" value="1" <?=($sval["pref"]==1) ? "checked" : ""?>> <em class="contenu">je suis intéressé(e) par des offres préférentielles de nos partenaires</em></td>
	<tr><td align="center" colspan="2"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>
<?php
   }
?>

<?php
  if ($p_etape == 3)
  {
    if ($l_error >= 1)
    {
?>
        <tr><td width="100%" class="contenu" colspan="2">
<br />
<div align="center" class="contenu"><strong>Erreur dans le formulaire !</strong><br />
<br />
Vous devez remplir correctement
<br />
<strong>tous les champs obligatoires du formulaire</strong>.
<br />
<?php
if ($l_error >= 1)
{
	echo "<br />Une erreur a été détectée sur le champs : <strong>";
	switch ($l_error)
	{
		case 1:
		echo "date d'effet";
		break;
		case 2:
		echo "moyen de paiement";
		break;
		case 3:
		echo "RIB";
		break;
	}
	echo "</strong>.<br />";
}
?>
<br />
</div>
       </td></tr>
      </table>
     </td>
    </tr>
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_bottom.gif" width="450" height="8"></td>
    </tr>
   </table>
   <br>
   <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_top.gif" width="450" height="8"></td>
    </tr>
    <tr>
     <td background="<?=$g_modulespicturepath?>/devis/encart_pattern.gif">

      <table width="100%" border="0" cellspacing="0" cellpadding="6">
<?php 
    } 
?>
        <tr><td width="100%" class="contenu" colspan="2">
        <img src='<?=$g_modulespicturepath?>/devis/picto_garanties.gif' hspace='2' align='absmiddle'> <strong>Les garanties choisies</strong><br><br>
<?php
    foreach($tab_sous2 as $skey => $sval)
    {
     echo $sval["nom"] ." ". $sval["prenom"] ." né le ". $sval["nai"] ." : Formule Swiss Santé ". $session->productcode ."<br>";
    }
    echo "<br><strong>=> Votre cotisation mensuelle : $session->pricettc EUR</strong>"; 
?>
        </td></tr>
        <tr><td height="26" width="50%" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
Date d'effet souhaitée :
<br />
<i>ex: <?=date('d/m/Y',mktime(0, 0, 0, date("m") , date("d") + 1, date("Y")))?></i>
<br />
<br />
Code client :
        </td>
        <td class="contenu" width="50%" valign="top">
<SCRIPT LANGUAGE="JavaScript" ID="jscal">
var cal = new CalendarPopup();
cal.addDisabledDates(null,'<?=date('Y-m-d')?>');
cal.setMonthNames('Janvier','Février','Mars','Avril','Mai','Juin','Juillet','Aout','Septembre','Octobre','Novembre','Decembre');
cal.setDayHeaders('D','L','M','M','J','V','S');
cal.setWeekStartDay(1);
cal.setTodayText("");
cal.showYearNavigation();
cal.showYearNavigationInput();

</SCRIPT>
<input type="text" name="p_dateeffet" value="<?=($tab_sous["dateeffet"])?$tab_sous["dateeffet"]:date('d/m/Y',mktime(0, 0, 0, date("m") , date("d") + 1, date("Y")))?>" size="10"><?=$g_champsolbigatoire?>
<a HREF="#" onClick="cal.select(document.suitedevis.p_dateeffet,'anchor','dd/MM/yyyy','<?=($tab_sous["dateeffet"])?$tab_sous["dateeffet"]:date('d/m/Y',mktime(0, 0, 0, date("m") , date("d") + 1, date("Y")))?>'); return false;" TITLE="afficher le calendrier" NAME="anchor" ID="anchor"><span class="contenu_rouge">calendrier</span></a>
<br />
<br />
<input type="text" name="p_codeclient" value="<?=$tab_sous["codeclient"]?>" size="5">
        </td></tr>

      </table>
     </td>
    </tr>
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_bottom.gif" width="450" height="8"></td>
    </tr>
   </table>
   <br>
   <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_top.gif" width="450" height="8"></td>
    </tr>
    <tr>
     <td background="<?=$g_modulespicturepath?>/devis/encart_pattern.gif">

      <table width="100%" border="0" cellspacing="0" cellpadding="6">


        <tr><td width="100%" class="contenu" colspan="2">
<img src='<?=$g_modulespicturepath?>/devis/picto_paiement.gif' hspace='2' align='absmiddle'> <strong>Les modes de paiement</strong>
<br />
<br />
<strong>Mensuel</strong>
<br />
<!--<input type="radio" name="p_mp" value="cb" <?=($tab_sous["mp"]=="cb")?"checked":""?>>&nbsp; &nbsp; Paiement du 1er mois par CB (<?=$command->pricettcport?> EUR) et ensuite prélèvement automatique
<br />-->
<input type="radio" name="p_mp" value="pa" <?=($tab_sous["mp"]=="pa")?"checked":""?>>Prélèvement automatique direct dès le premier mois (première mensualité de <?=$command->pricettcport?> EUR)
        </td></tr>
        <tr><td width="100%" class="contenu" colspan="2" align=right>
      <table width="95%" border="0" cellspacing="0" cellpadding="6">
        <tr><td width="100%" class="contenu" colspan="2">
Pour un règlement mensuel, veuillez choisir une date de prélèvement et compléter le <strong>RIB</strong> ci-dessous :
        </td></tr>
        <tr><td height="26" width="50%" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
Date de prélèvement :
        </td>
        <td class="contenu" width="50%" valign="top">
<select name="p_prelevement">
<option value="5" <?=($tab_sous["prelevement"]=="5")?"selected":""?>>le 5 du mois</option>
<option value="10" <?=($tab_sous["prelevement"]=="10")?"selected":""?>>le 10 du mois</option>
<option value="20" <?=($tab_sous["prelevement"]=="20")?"selected":""?>>le 20 du mois</option>
<option value="dernier" <?=($tab_sous["prelevement"]=="dernier")?"selected":""?>>le dernier jour du mois</option>
</select>
        </td></tr>
        <tr><td height="26" width="50%" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
Banque  et Guichet :
<br />
<i>ex: 12345 et 67890</i>
<br />
<br />
N° compte et Clé :
<br />
<i>ex: 12345678901 et 21</i>
        </td>
        <td class="contenu" width="50%" valign="top">
<input type="text" name="p_rib_banque" value="<?=$tab_sous["rib_banque"]?>" size="5"> - <input type="text" name="p_rib_guichet" value="<?=$tab_sous["rib_guichet"]?>" size="5">
<br />
<br />
<input type="text" name="p_rib_compte" value="<?=$tab_sous["rib_compte"]?>" size="10"> - <input type="text" name="p_rib_cle" value="<?=$tab_sous["rib_cle"]?>" size="2">
        </td></tr>
       </table>
        </td></tr>
        <tr><td width="100%" class="contenu" colspan="2">
<strong>Semestriel</strong>
<br />
<input type="radio" name="p_mp" value="ch6" <?=($tab_sous["mp"]=="ch6")?"checked":""?>>Chèque à l'ordre de <strong>Swisslife</strong> de <?=($command->pricettcport + (5 * $session->pricettc))?> EUR.
<br />
<br />
<strong>Annuel</strong>
<br />
<input type="radio" name="p_mp" value="ch12" <?=($tab_sous["mp"]=="ch12")?"checked":""?>>Chèque à l'ordre de <strong>Swisslife</strong> de <?=($command->pricettcport + (11 * $session->pricettc))?> EUR.
        </td></tr>
      </table>
     </td>
    </tr>
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_bottom.gif" width="450" height="8"></td>
    </tr>
   </table>
   <br>
   <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_top.gif" width="450" height="8"></td>
    </tr>
    <tr>
     <td background="<?=$g_modulespicturepath?>/devis/encart_pattern.gif">

      <table width="100%" border="0" cellspacing="0" cellpadding="6">

        <tr><td width="100%" class="contenu" colspan="2">
<img src='<?=$g_modulespicturepath?>/devis/picto_infos_sous.gif' hspace='2' align='absmiddle'> <strong>Conditions Générales de Vente</strong>
<br />
<br />
<input type="checkbox" name="CGV_CHECKBOX">En cochant cette case, je reconnais avoir pris connaissance et accepter les conditions générales de vente d'Assursante. 
        </td></tr>
<?php
  }
?>
