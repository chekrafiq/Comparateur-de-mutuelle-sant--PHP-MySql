<?php
//--- OUVERTURE D'UNE SESSION
getmysession();
?>


<table width="100%"  border="0" cellspacing="15" cellpadding="0">
 <tr>
  <td width="76%" valign="top">

<?php
if (isset($MYSESSION["devis"])) unset($MYSESSION["devis"]);
if (isset($MYSESSION["params"])) unset($MYSESSION["params"]);

$tab_sous = (isset($MYSESSION["sous"])) ? $MYSESSION["sous"] : array();
$tab_sous2 = (isset($MYSESSION["sous2"])) ? $MYSESSION["sous2"] : array();

if ($p_devisaction == "sousetape")
{
  include("_sous_trt.inc.php3");
?>
   <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_top.gif" width="450" height="8"></td>
    </tr>
    <tr>
     <td background="<?=$g_modulespicturepath?>/devis/encart_pattern.gif">

      <table width="100%" border="0" cellspacing="0" cellpadding="6">
       <form method="POST" name="suitedevis" id="suitedevis" action="<?=$PHP_SELF?>">
       <input type="hidden" name="p_idref" value="<?=$p_idref?>">
       <input type="hidden" name="p_devisaction" value="sousetape">
       <input type="hidden" name="p_devissubaction" value="next">
       <input type="hidden" name="p_etape" value="<?=$p_etape?>">

<?php
include("_sous_aff.inc.php3");
?>
       </form>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="4">

<?php if ($p_etape > 2) { ?>
<form method="POST" name="retourdevis" id="retourdevis" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_idref" value="<?=$p_idref?>">
<input type="hidden" name="p_devisaction" value="sousetape">
<input type="hidden" name="p_devissubaction" value="prev">
<input type="hidden" name="p_etape" value="<?=$p_etape?>">
</form>
<?php } ?>

       <tr valign="top">

<?php if ($p_etape == 2) { ?>
        <td align="center"><a href="javascript:document.suitedevis.submit()"><img src="<?=$g_modulespicturepath?>/devis/bouton_suite_sous.gif" border="0"></td>
<?php } ?>

<?php if ($p_etape == 3) { ?>
        <td align="center"><a href="javascript:document.retourdevis.submit()"><img src="<?=$g_modulespicturepath?>/devis/bouton_retour_sous.gif" border="0"></td>
        <td align="center"><input type="image" Onclick="javascript:valid()" src="<?=$g_modulespicturepath?>/devis/bouton_finaliser_sous.gif" border="0">
<SCRIPT LANGUAGE=JAVASCRIPT>
<!--
function valid() {
  if(!document.suitedevis.CGV_CHECKBOX.checked) {
    alert("Veuillez prendre connaissance des conditions générales de vente d'Assursante et les accepter afin de finaliser votre commande.");
    return false;
  }
  document.suitedevis.submit()
}
-->
</script>
        </td>
<?php } ?>

       </tr>
      </table>
     </td>
    </tr>
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_bottom.gif" width="450" height="8"></td>
    </tr>
   </table>
   <br>

<?php } ?>
