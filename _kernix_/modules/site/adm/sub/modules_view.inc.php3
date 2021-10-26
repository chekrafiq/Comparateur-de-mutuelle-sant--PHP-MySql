<?php

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);

$ref = $c_db->object_result();

$l_polllist         = build_select_wrvg($table_poll,$ref->idpoll,"idpoll","name","p_idpoll","","AUCUN","", "", "ALEATOIRE", "0");
$l_egrouplist       = build_select($table_egroup,$ref->idegroup,"idegroup","name","p_idegroup","","AUCUN","");

$l_loglist          = yesno_list($ref->logflag, "p_logflag");
$l_refreshlist      = yesno_list($ref->refreshflag, "p_refreshflag");
$l_gblist           = yesno_list($ref->gbflag, "p_gbflag");

$l_publist          = build_select_wrvg($table_pub, $ref->idpub, "idpub", "name", "p_idpub", "", "AUCUNE", "", "", "ALEATOIRE", "0");

$l_pagenotifierlist = yesno_list($ref->pagenotifierflag, "p_pagenotifierflag");
$l_ratinglist       = yesno_list($ref->ratingflag, "p_ratingflag");

$l_boardlist        = build_select($table_board,$ref->idboard,"idboard","title","p_idboard","","AUCUN","");
$l_formlist         = build_select($table_form,$ref->idform,"idform","name","p_idform","","AUCUN","");

include("sub/onglet.inc.php3");

?>

<form method="post" action="<?php print("$PHP_SELF")?>">
<input type="hidden" name="p_siteadmaction" value="modules_update">
<input type="hidden" name="p_idref" value="<?=$p_idref?>">

<table width=100% align=center>

 <tr>
  <td align=left class=color1 colspan=3 height=20>
:: [ <small>page#<?php print("$p_idref"); ?></small> ] modules : <small><?php print($ref->name); ?></small>
  </td>
 </tr>

 <tr>
  <td align=right class=color2 width=30%>
   Compteur de visites &nbsp;
  </td>
  <td class=color3>
   <?php print($l_loglist);?>
  </td>
  <td class=listlight align=center> 
   <?php aff_incelllink(" &#187; ","/$g_modulespath/traffic/adm",$ref->logflag); ?>
  </td>
 </tr>

 <tr>
  <td align=right class=color2 width=30%>
   Auto rafraichissement &nbsp;
  </td>
  <td class=color3>
   <?php print($l_refreshlist);?>
  </td>
  <td class=listlight align=center> 
  &nbsp;
  </td>
 </tr>

 <tr>
  <td align=right class=color2>
   Publicité &nbsp;
  </td>
  <td class=color3>
   <?php print($l_publist);?>
  </td>
  <td class=listlight align=center>
   <?php aff_incelllink(" &#187; ","/$g_modulespath/pub/adm/index.php3?p_pubaction=view&p_idpub=$ref->idpub",$ref->idpub); ?>
  </td>
 </tr>

 <tr>
  <td align=right class=color2>
   Envoyer cette page à un ami &nbsp;
  </td>
  <td class=color3>
   <?php print($l_pagenotifierlist);?>
  </td>
  <td class=listlight align=center> 
   &nbsp;
  </td>
 </tr>
 <tr>
  <td align=right class=color2>
   Evaluation &nbsp;
  </td>
  <td class=color3>
  <?php print($l_ratinglist);?>
  </td>
  <td class=listlight align=center>
   <?php aff_incelllink(" &#187; ","/$g_modulespath/rating/adm/index.php3",$ref->ratingflag); ?>
  </td>
 </tr>
 <tr>
  <td align=right class=color2>
   Liste de diffusion - Newsletter &nbsp;
  </td>
  <td class=color3>
   <?php print($l_egrouplist);?>
  </td>
  <td class=listlight align=center>
   <?php aff_incelllink(" &#187; ","/$g_modulespath/egroup/adm/index.php3?p_egroupaction=egroup_view&p_idegroup=$ref->idegroup",$ref->idegroup); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>
   Vote &nbsp;
  </td>
  <td class=color3>
   <?php print($l_polllist);?>
  </td>
  <td class=listlight align=center>
   <?php aff_incelllink(" &#187; ","/$g_modulespath/poll/adm/index.php3?p_pollaction=view&p_idpoll=$ref->idpoll",$ref->idpoll); ?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>
   Livre d'or &nbsp;
  </td>
  <td class=color3>
   <?php print("$l_gblist");?>
  </td>
  <td class=listlight align=center>
<?php 
if ($ref->gbflag > 0)
{
if (isset($p_idref))
{
aff_incelllink(" &#187; ", "/$g_modulespath/guestbook/adm/index.php3?p_id=$p_idref", $p_idref);
}
else
{
     aff_incelllink(" &#187; ", "/$g_modulespath/guestbook/adm/index.php3?p_id=$p_idcategory", $p_idcategory);
}
}
?>
  </td>
 </tr>
 <tr>
  <td class=color2 align=right>
   Forum - News - FAQ &nbsp;
  </td>
  <td class=color3>
   <?php print("$l_boardlist");?>
  </td>
  <td class=listlight align=center>
   <?php aff_incelllink(" &#187; ","/$g_modulespath/board/adm/index.php3?p_boardaction=view&p_idboard=$ref->idboard",$ref->idboard); ?>
  </td>
 </tr>

 <tr>
  <td class=color2 align=right>
   Formulaire &nbsp;
  </td>
  <td class=color3>
   <?php print("$l_formlist");?>
  </td>
  <td class=listlight align=center>
   <?php aff_incelllink(" &#187; ","/$g_modulespath/form/adm/index.php3?p_formaction=view&p_idform=$ref->idform",$ref->idform); ?>
  </td>
 </tr>

 <tr>
  <td colspan="3" align="center">
   <br>
    <input type="submit" name="submit" value="enregistrer" class="button">
   <br><br>
  </td>
 </tr>

</table>

</form>
