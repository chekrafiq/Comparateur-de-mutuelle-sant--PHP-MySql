<?php
  if ($p_etape == 1)
  {
?>
        <tr><td width="100%" class="contenu">
<?=($l_txt==1)?get_msg("SOUS_ACC2"):get_msg("DEVIS_ACC")?>
        </td></tr>
	<tr><td align="center"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>
        <tr><td width="100%" class="contenu">
Vous souhaitez assurer :
<br />
<br />
Un ou plusieurs adultes :
<select name="p_adulte">
<option value=1 <?=($tab_params["adulte"] == 1)?"selected":""?>>vous</option>
<!--<option value=2 <?=($tab_params["adulte"] == 2)?"selected":""?>>votre conjoint ou concubin</option>-->
<option value=3 <?=($tab_params["adulte"] == 3)?"selected":""?>>vous et votre conjoint ou concubin</option>
</select>
<br />
<br />
Un ou plusieurs enfants (- de 20 ans):
<select name="p_enfant">
<option value=0 <?=($tab_params["enfant"] == 0)?"selected":""?>>0</option>
<option value=1 <?=($tab_params["enfant"] == 1)?"selected":""?>>1</option>
<option value=2 <?=($tab_params["enfant"] == 2)?"selected":""?>>2</option>
<option value=3 <?=($tab_params["enfant"] == 3)?"selected":""?>>3</option>
<option value=4 <?=($tab_params["enfant"] == 4)?"selected":""?>>4</option>
<option value=5 <?=($tab_params["enfant"] == 5)?"selected":""?>>5</option>
<option value=6 <?=($tab_params["enfant"] == 6)?"selected":""?>>6</option>
<option value=7 <?=($tab_params["enfant"] == 7)?"selected":""?>>7</option>
</select>
        </td></tr>
	<tr><td align="center"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>
<?php
   }
?>

<?php
  if ($p_etape == 2)
  {
    if ($l_erreuretape2==1){
?>
        <tr><td width="100%" class="contenu" colspan="2">
<br />
<div align="center" class="contenu"><strong>Erreur dans le formulaire !<br />
<br />
Il est impossible d'assurer un enfant mineur<br/>pour une personne de plus de 65 ans.</strong></div>
       </td></tr>
<?php }

   if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
   else $l_nbadulte = 1;

   for ($i=1;$i<=$l_nbadulte;$i++)
   {
?>
        <tr><td width="56%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu"><strong><img src="<?=$g_modulespicturepath?>/devis/picto_parent.gif" hspace="2" align="absmiddle"><?=($i==1 && ($tab_params["adulte"] == 1 || $tab_params["adulte"] == 3))?"Vous":"Conjoint ou concubin"?></strong><br /><br />
        </td>
        <td width="44%" class="contenu">
Sexe :
<select name="p_<?=$i?>_sexe">
<option value='H' <?=($tab_params[$i."_sexe"] == "H")?"selected":""?>>masculin</option>
<option value='F' <?=($tab_params[$i."_sexe"] == "F")?"selected":""?>>féminin</option>
</select>
<br />
<br />
Age :
<select name="p_<?=$i?>_age">
<?php for($j=20;$j<=99;$j++) echo "<option value='$j'", ($tab_params[$i."_age"] == $j)?"selected":"", ">$j</option>\n"; ?>
</select>
<br />
<br />
Département :
<select name="p_<?=$i?>_dept">
<?php for($j=1;$j<=20;$j++) echo "<option value='$j'", ($tab_params[$i."_dept"] == $j)?"selected":"", ">", str_pad($j,2,0,STR_PAD_LEFT), "</option>";
echo "<option value='20'>", str_pad("2A",2,0,STR_PAD_LEFT), "</option>";
echo "<option value='20'>", str_pad("2B",2,0,STR_PAD_LEFT), "</option>";
for($j=21;$j<=95;$j++) echo "<option value='$j'", ($tab_params[$i."_dept"] == $j)?"selected":"", ">", str_pad($j,2,0,STR_PAD_LEFT), "</option>"; ?>
</select>
<br />
<br />
Régime :
<select name="p_<?=$i?>_regime">
<option value='S' <?=($tab_params[$i."_regime"] == "S")?"selected":""?>>S.S.</option>
<option value='N' <?=($tab_params[$i."_regime"] == "N")?"selected":""?>>T.N.S.</option>
<option value='A' <?=($tab_params[$i."_regime"] == "A")?"selected":""?>>Agricole</option>
</select>
<br />
<br />
<!---
<?php if ($i==1) { ?>
Souscripteur :
<select name="p_<?=$i?>_scpt">
<option value=0 <?=($tab_params[$i."_scpt"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_scpt"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>
	<tr><td colspan="2" align="center"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>
<?php } ?>
//--->
<?php
    }
   if ($tab_params["adulte"] == 3)
   {
     for ($i=1;$i<=$tab_params["enfant"];$i++)
     {
?>
        <tr><td width="56%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu"><strong><img src="<?=$g_modulespicturepath?>/devis/picto_enfant.gif" hspace="2" align="absmiddle">Enfant n°<?=$i?></strong><br /><br />
        </td>
        <td width="44%" class="contenu">
ayant de droit de :
<select name="p_<?=($i+10)?>_ad">
<option value=1 <?=($tab_params[($i+10)."_ad"] == 1)?"selected":""?>>Vous</option>
<option value=2 <?=($tab_params[($i+10)."_ad"] == 2)?"selected":""?>>Conjoint ou concubin</option>
</select>
        </td></tr>
	<tr><td colspan="2" align="center"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>

<?php
    }
   }
  }
?>

<?php
  if ($p_etape == 3)
  {
    $i=1;
?>
      <input type="hidden" name="p_<?=$i?>_gamme" value="1">
<!--
        <tr><td width="56%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu"><strong><img src="<?=$g_modulespicturepath?>/devis/picto_parent.gif" hspace="2" align="absmiddle">Gamme</td>
        <td width="44%" class="contenu">
<select name="p_<?=$i?>_gamme">
<option value=1 <?=($tab_params[$i."_gamme"] == 1)?"selected":""?>>économique</option>
<option value=2 <?=($tab_params[$i."_gamme"] == 2)?"selected":""?>>principale</option>

<?php if ($tab_params[$i."_age"] <= 65) echo "<option value=3 ",($tab_params[$i."_gamme"] == 3)?"selected":"",">haut de gamme</option>"; ?>

</select>
        </td></tr>
	<tr><td colspan="2" align="center"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>
//-->
<?php
    if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
    else $l_nbadulte = 1;
    $flag_etape3 = 1;
    for ($i=1;$i<=$l_nbadulte;$i++) {
      if ($tab_params[$i."_regime"] == "N") {
	$flag_etape3 = 2;
?>
        <tr><td width="56%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu"><strong><img src="<?=$g_modulespicturepath?>/devis/picto_parent.gif" hspace="2" align="absmiddle"><?=($i==1 && ($tab_params["adulte"] == 1 || $tab_params["adulte"] == 3))?"Vous":"Conjoint ou concubin"?></strong><br /><br />
        </td>
        <td width="44%" class="contenu">
Loi Madelin :
<select name="p_<?=$i?>_agis">
<option value=0 <?=($tab_params[$i."_agis"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_agis"] == 1)?"selected":""?>>oui</option>
</select>
<br />
<br />
        </td></tr>
	<tr><td colspan="2" align="center"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>

<?php
	   }
      if ($flag_etape3==1 && $p_devissubaction!="prev") echo "<script type='text/javascript'>document.suitedevis.submit();</script>";
    }
  }
?>

<?php
  if ($p_etape == 4)
  {
?>

<?php
   if ($tab_params["adulte"] == 3) $l_nbadulte = 2;
   else $l_nbadulte = 1;

   for ($i=1;$i<=$l_nbadulte;$i++)
   {
     if ($tab_params[$i."_age"] > 65 || $tab_params[$i."_gamme"] == 3)
     {
?>
        <tr><td width="70%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu"><strong><img src="<?=$g_modulespicturepath?>/devis/picto_parent.gif" hspace="2" align="absmiddle"><?=($i==1 && ($tab_params["adulte"] == 1 || $tab_params["adulte"] == 3))?"Vous":"Conjoint ou concubin"?></strong><br /><br />
        </td>
        <td width="30%" class="contenu"></td></tr>

        <tr><td class="contenu" valign="middle">
<b>[Q1]</b> Etes-vous actuellement hospitalisé(e) ?
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q1">
<option value=0 <?=($tab_params[$i."_q1"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_q1"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>

        <tr><td class="contenu" valign="middle">
<b>[Q2]</b> Envisagez-vous un séjour hospitalier et/ou un séjour spécialisé (repos, cure...) avec ou sans intervention chirurgicale dans les 6 mois ? (autre que appendicite, amygdales, végétations)
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q2">
<option value=0 <?=($tab_params[$i."_q2"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_q2"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>
        <tr><td class="contenu" valign="middle">
<b>[Q3]</b> Etes-vous pris(e) en charge à 100% par votre régime obligatoire ?
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q3">
<option value=0 <?=($tab_params[$i."_q3"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_q3"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>
        <tr><td class="contenu" valign="middle">
<b>[Q4]</b> Dans les 3 années précédant la souscription, avez-vous été soigné(e) pendant plus de 2 mois consécutifs pour une maladie, un accident, une malformation ?
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q4">
<option value=0 <?=($tab_params[$i."_q4"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_q4"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>
        <tr><td class="contenu" valign="middle">
<b>[Q5]</b> Dans les 2 mois qui viennent de s'écouler, avez-vous consulté plus de 4 fois un généraliste ou un spécialiste ?
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q5">
<option value=0 <?=($tab_params[$i."_q5"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_q5"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>
        <tr><td class="contenu" valign="middle">
<b>[Q6-1]</b> Merci d'indiquer votre poids approximatif :
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q61">
<?php for($j=30;$j<=150;$j+=2) echo "<option value='$j'", ($tab_params[$i."_q61"] == $j)?"selected":"", ">$j</option>"; ?>
</select> kg
        </td></tr>
        <tr><td class="contenu" valign="middle">
<b>[Q6-2]</b> Merci d'indiquer votre taille approximative :
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q62">
<?php for($j=120;$j<=220;$j+=2) echo "<option value='$j'", ($tab_params[$i."_q62"] == $j)?"selected":"", ">$j</option>"; ?>
</select> cm
        </td></tr>

<?php if ($tab_params[$i."_sexe"] == "F" && $tab_params[$i."_gamme"] == 3) { ?>
        <tr><td class="contenu" valign="middle">
<b>[Q7]</b> Etes vous actuellement enceinte ?
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q7">
<option value=0 <?=($tab_params[$i."_q7"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_q7"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>

<?php } ?>

<?php if ($tab_params[$i."_gamme"] == 3) { ?>
        <tr><td class="contenu" valign="middle">
<b>[Q8]</b> Des travaux de prothèses dentaires ou d'orthodontie sont-ils en cours ou envisagés pour les 12 mois à venir ?
        </td><td class="contenu" valign="middle">
<select name="p_<?=$i?>_q8">
<option value=0 <?=($tab_params[$i."_q8"] == 0)?"selected":""?>>non</option>
<option value=1 <?=($tab_params[$i."_q8"] == 1)?"selected":""?>>oui</option>
</select>
        </td></tr>
<?php } ?>

	<tr><td colspan="2" align="center"><br><img src="<?=$g_modulespicturepath?>/devis/encart_ligne.gif" width="435" height="2"><br/><br/></td></tr>

<?php
      }
    }
  }
?>

<?php
  if ($p_etape == 5)
  {
    if ($tab_params["infosdevis"] == 2)
    {
?>
        <tr><td width="100%" class="contenu" colspan="2">
<br />
<div align="center" class="contenu"><strong>Erreur dans le formulaire !<br />
<br />
Vous devez remplir correctement tous les champs du formulaire.</strong></div>
       </td></tr>
<?php
    }
?>

        <tr><td width="100%" class="contenu" colspan="2">

Veuillez remplir le formulaire ci-dessous :
<br/>
<br/>
	</td></tr>

        <tr><td width="48%" height="26" valign="top" background="<?=$g_modulespicturepath?>/devis/encart_trame.gif" class="contenu">
<strong>Nom* :</strong>
<br />
<br />
<br />
<strong>Prénom* :</strong>
<br />
<br />
<br />
<strong>Email* :</strong>
<br />
<br />
<br />
<strong>Téléphone* :</strong>
<br />
<br />
<br />
<i>Les champs suivi de *<br>sont obligatoires.</i>
        </td>
        <td width="52%" class="contenu" valign="top">
<input type="text" name="p_nom" value="<?=$tab_params["infosdevis_nom"]?>" size="30">
<br />
<br />
<input type="text" name="p_prenom" value="<?=$tab_params["infosdevis_prenom"]?>" size="30">
<br />
<br />
<input type="text" name="p_email" value="<?=$tab_params["infosdevis_email"]?>" size="30">
<br />
<br />
<input type="text" name="p_tel" value="<?=$tab_params["infosdevis_tel"]?>" size="30">
<br />
<br />
        </td></tr>
<tr>
<td class="contenu" colspan=2>  <input type="checkbox" name="p_pref" value="1" <?=($tab_params["infosdevis_pref"]==1) ? "checked" : ""?>> <em class="contenu">je suis intéressé(e) par des offres préférentielles de nos partenaires</em></td>
</tr>
<?php
  }
?>

