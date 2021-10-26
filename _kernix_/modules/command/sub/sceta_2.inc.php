<?php
$l_tab = get_pocheresa($p_poche);

$l_datecheck = "$deb_annee-$deb_mois-$deb_jour";
$l_debtest = $deb_annee.$deb_mois.$deb_jour.$deb_heure.$deb_min;
$l_fintest = $fin_annee.$fin_mois.$fin_jour.$fin_heure.$fin_min;
$l_month = date('m');
$l_year = date('Y');
$l_day = date('d');
$l_heure = date('G');

$l_now = $l_year.$l_month.$l_day.$l_heure."00";

if ($l_heure >= $g_sp_limitheureresa)
{
  $l_validday = mktime(0,0,0,$l_month,($l_day+2),$l_year);
}
else
{
  $l_validday = mktime(0,0,0,$l_month,($l_day+1),$l_year);
}

$l_validdaymax = mktime(0,0,0,$l_month,($l_day+$l_tab["nbjouravt"]+1),$l_year);

$l_deb = mktime(0,$deb_min,$deb_heure,$deb_mois,$deb_jour,$deb_annee);

$msg = "";

if (!check_resa($p_poche, $l_datecheck, $l_tab["nbplace"])) $msg = "&nbsp;&nbsp;<b>DESOLE : plus de place disponible pour cette date d'entrée.</b>";

if ($l_deb > $l_validdaymax) $msg = "&nbsp;&nbsp;<b>ATTENTION : vous pouvez réserver une place au plus tôt ".$l_tab["nbjouravt"]." jours à l'avance.</b>";

if ($l_deb < $l_validday) $msg = "&nbsp;&nbsp;<b>ATTENTION : vous pouvez réserver une place au plus tard<br>la veille avant $g_sp_limitheureresa"."h00 (dernier délai).</b>";

if ($l_now >= $l_debtest) $msg = "&nbsp;&nbsp;<b>ATTENTION : vous devez sélectionner une période valide.</b>";

if ($l_fintest <= $l_debtest) $msg = "&nbsp;&nbsp;<b>ATTENTION : vous devez sélectionner une période valide.</b>";

if (!checkdate($deb_mois,$deb_jour,$deb_annee) || !checkdate($fin_mois,$fin_jour,$fin_annee)) $msg = "&nbsp;&nbsp;<b>ATTENTION : vous devez sélectionner une période valide.</b>";

if ($msg == "")
{  
  $l_datedeb = "$deb_jour/$deb_mois/$deb_annee à $deb_heure"."h$deb_min";
  $l_dateresa = $deb_annee."-".$deb_mois."-".$deb_jour;
  $l_datefin = "$fin_jour/$fin_mois/$fin_annee vers $fin_heure"."h";
}

?>

<SCRIPT LANGUAGE=JAVASCRIPT>
function valid() {
  if(!document.parcresa.CGV_CHECKBOX.checked) {
    alert("Veuillez prendre connaissance des conditions générales de vente de SCETA Parc et les accepter afin de poursuivre votre réservation.");
    return false;
  }
  document.parcresa.submit()
}
</script>

<?php if ($msg == "") { ?>

<form name="parcresa" action="<?php print($g_urldyn); ?>" method="POST">
<p align="left" class="txt_n_arial_black">
<input type="hidden" name="p_etape"		value="<?=($l_etape+1)?>">
<input type="hidden" name="p_za"		value="command">
<input type="hidden" name="p_commandaction"	value="client_add">
<input type="hidden" name="p_caddiecookieaction"  value="add">
<input type="hidden" name="p_fromref"		value="728">
<input type="hidden" name="p_quantity"		value="1">
<input type="hidden" name="p_prix"		value="<?=$l_tab["tarif"]?>">
<input type="hidden" name="p_parc"		value="<?=$p_parc?>">
<input type="hidden" name="p_poche"		value="<?=$p_poche?>">
<input type="hidden" name="p_codepoche"		value="<?=$l_tab["codepoche"]?>">
<input type="hidden" name="p_codeparc"		value="<?=$l_tab["codeparc"]?>">
<input type="hidden" name="p_dateresa"		value="<?=$l_dateresa?>">
<input type="hidden" name="p_description"	value="<?=urlencode("Réservation d'une place dans le parking " . $l_tab["libelle"] . " (code " . $l_tab["codepoche"] . "), le " . $l_datedeb . " jusqu'au " . $l_datefin . ".")?>">

<i><u>Confirmation de votre Réservation :</u></i><br><br>
   &nbsp;Parking : <b><?=$l_tab["libelle"]?></b><br>
   &nbsp;Entrée : <b>le <?=$l_datedeb?></b><br>
   &nbsp;Sortie : le <?=$l_datefin?>
</p>
<p align="right" class="txt_n_arial_red_big">
   <b>Montant : <?=number_format($l_tab["tarif"], 2, '.', ' ')?> euros</b>&nbsp; &nbsp;
</p>
<p align="left" class="txt_n_arial_black">
   &nbsp;NB: Le montant indiqué correspond à un coût de réservation. <b>Il ne comprend pas les frais<br>&nbsp;de stationnement</b> qui se règlent sur le parking.<br><br>
   <input type="checkbox" name="CGV_CHECKBOX"> En cochant cette case, je reconnais avoir pris connaissance et accepter les<br>&nbsp; &nbsp; &nbsp; &nbsp;<b>conditions générales de vente</b> de SCETA Parc.
</p>
</form>


<input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">&nbsp;
<input type="button" value="Confirmer" Onclick="javascript:valid()" class="caddiebutton"><br><br>

<?php } else { ?>

<p align="center" class="txt_n_arial_black">
<?=$msg?>
</p>
<input type="button" value="Retour" Onclick="javascript:history.back()" class="caddiebutton">&nbsp;
</p>

<?php } ?>


<?php if (empty($KERNIX)) { ?>
<SCRIPT LANGUAGE=JAVASCRIPT>
alert("<?=get_msg("ALERT_COOKIES")?>");
</script>
<?php } ?>

