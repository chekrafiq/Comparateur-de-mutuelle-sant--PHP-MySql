<?php
//--- OUVERTURE D'UNE SESSION
getmysession();

if ($p_devisaction=="homedevis")
{
  $p_devisaction = "etape";
  $p_devissubaction = "next";
  unset($MYSESSION);
}

$l_rubrique = "";
if ($p_idref==17) $l_rubrique = "_sous";

if ($p_devisaction=="etape" && $p_etape != 6)
{
?>

<table width="100%"  border="0" cellspacing="15" cellpadding="0">
 <tr>
  <td width="76%" valign="top">

<?php
}
$tab_devis = (isset($MYSESSION["devis"])) ? $MYSESSION["devis"] : array();
$tab_params = (isset($MYSESSION["params"])) ? $MYSESSION["params"] : array();

if ($p_devisaction=="etape")
{
  include("_devis_trt.inc.php3");
  if ($p_devisaction == "sousetape") return;
?>
   <table width="450" border="0" cellspacing="0" cellpadding="0">
    <tr>
     <td height="8"><img src="<?=$g_modulespicturepath?>/devis/encart_top.gif" width="450" height="8"></td>
    </tr>
    <tr>
     <td background="<?=$g_modulespicturepath?>/devis/encart_pattern.gif">

      <table width="100%" border="0" cellspacing="0" cellpadding="6">
       <form method="POST" name="suitedevis" id="suitedevis" action="<?=$PHP_SELF?>">
       <input type="hidden" name="p_idref" value="<?=($p_etape==6)?"17":$p_idref?>">
       <input type="hidden" name="p_devisaction" value="etape">
       <input type="hidden" name="p_devissubaction" value="next">
       <input type="hidden" name="p_etape" value="<?=$p_etape?>">

<?php
include("_devis_aff.inc.php3");

include("_devis_tarifs.inc.php3");
?>
       </form>
      </table>
      <table width="100%"  border="0" cellspacing="0" cellpadding="4">

<?php if ($p_etape > 1) { ?>
<form method="POST" name="retourdevis" id="retourdevis" action="<?=$PHP_SELF?>">
<input type="hidden" name="p_idref" value="<?=$p_idref?>">
<input type="hidden" name="p_devisaction" value="etape">
<input type="hidden" name="p_devissubaction" value="prev">
<input type="hidden" name="p_etape" value="<?=$p_etape?>">
</form>
<?php
   if ($flag_etape3==1 && $p_devissubaction=="prev") echo "<script type='text/javascript'>document.retourdevis.submit();</script>";
?>
 <?php } ?>

       <tr valign="top">
<?php if ($p_etape > 1 && $p_etape < 6) { ?>
        <td align="center"><a href="javascript:document.retourdevis.submit()"><img src="<?=$g_modulespicturepath?>/devis/bouton_retour<?=$l_rubrique?>.gif" border="0"></td>
<?php } ?>

<?php if ($p_etape == 6) { ?>

        <td align="center"></td>

        <td align="center">
         <a href="javascript:document.retourdevis.submit()"><img src="<?=$g_modulespicturepath?>/devis/bouton_modifchoix<?=$l_rubrique?>.gif" border="0"></a>
         &nbsp; &nbsp;<input type="image" Onclick="javascript:valid()" src="<?=$g_modulespicturepath?>/devis/bouton_souscrire<?=$l_rubrique?>.gif" border="0">
<SCRIPT LANGUAGE=JAVASCRIPT>
<!--
function valid()
{
  var radio_choice = false;
  for (counter = 0; counter < document.suitedevis.p_selectformule.length; counter++)
  {
    if (document.suitedevis.p_selectformule[counter].checked)
      radio_choice = true; 
  }  
  if (!radio_choice)
  {
    alert("Vous devez sélectionner une formule pour souscrire en ligne.");
    return (false);
  }
  document.suitedevis.submit()                        
}
-->
</script>
        </td>


<?php } ?>

<?php if ($p_etape < 6) { ?>
        <td align="center"><a href="javascript:document.suitedevis.submit()"><img src="<?=$g_modulespicturepath?>/devis/bouton_suite<?=$l_rubrique?>.gif" border="0"></td>
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
