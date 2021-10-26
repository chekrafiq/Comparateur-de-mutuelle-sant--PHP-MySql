<?php

$l_sql = "SELECT * FROM $table_admshop WHERE idadmshop=1";
$c_db->query($l_sql);
$obj = $c_db->object_result();

$l_currencylist = build_select($table_currency,$obj->idcurrency,"idcurrency","name","p_idcurrency","WHERE cybermutflag = 1","","");
$l_taxeslist    = build_select($table_taxes,$obj->idtaxes,"idtaxes","name","p_idtaxes","","","");
$l_paymentlist  = build_select($table_payment,$obj->idpayment,"idpayment","name","p_idpayment","WHERE mode = 'CCB'","AUCUN","");
$l_portlist     = build_select($table_port,$obj->idport,"idport","name","p_idport","WHERE idport != 2 ORDER BY idport","AUCUN","");


$l_stockmodelist      = yesno_list($obj->stockmodeflag, "p_stockmodeflag");
$l_commandwarninglist = yesno_list($obj->commandwarningflag, "p_commandwarningflag");
$l_caddielist         = yesno_list($obj->caddieflag, "p_caddieflag");
$l_dutyfreelist       = yesno_list($obj->dutyfreeflag, "p_dutyfreeflag");

?>

<form method=POST action="<?=$PHP_SELF?>">
 <input type=hidden name="p_shiadmaction"  value="store">
 <input type=hidden name="p_oldidcurrency" value="<?=$obj->idcurrency?>">

 <table width=98%>

  <tr>
   <td align=left class=color1 colspan=2 height=20>
    :: valeurs globales de fonctionnement de la boutique
   </td> 
  </tr>

  <tr>
   <td align=right class=color2 width=40%>
    monnaie &nbsp;
   </td>
   <td class=color3>
   <?=$l_currencylist?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    taxe &nbsp;
   </td>
   <td class=color3>
   <?=$l_taxeslist?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    mode de saisie des prix &nbsp;
   </td>
   <td class=color3>
    <select name=p_idpriceentermode>
     <option value="1" <?php if ($obj->idpriceentermode == 1) print("SELECTED"); ?>>-- H.T. --</option>
     <option value="2" <?php if ($obj->idpriceentermode == 2) print("SELECTED"); ?>>-- T.T.C. --</option>
    </select>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    affichage des prix &nbsp;
   </td>
   <td class=color3>
    <select name=p_idcurrencyviewmode >
     <option value="1" SELECTED>-- MONNAIE DU SITE --</option>
     <option value="2" >-- FRANCS - EUROS --</option>
     <option value="3" >-- EUROS - DOLLARS --</option>
     <option value="4" >-- FRANCS - EUROS - DOLLARS --</option>
    </select>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    fonctionnement du port &nbsp;
   </td>
   <td class=color3>
   <?php print($l_portlist);?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    valeur du port &nbsp;
   </td>
   <td class=color3 valign=top>
    <input class="text" type="text" name="p_portvalue" value="<?php print($obj->portvalue);?>" size="10">
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    port maximum &nbsp;
   </td>
   <td class=color3 valign=top>
    <input class="text" type="text" name="p_portlimit" value="<?php print($obj->portlimit);?>" size="10">
   </td>
  </tr>

  <tr>
   <td align="right" class="color2">
    mode de paiement &nbsp;
   </td>
   <td class="color3">
    <input type="checkbox" name="p_paymentmode[]" value="TEST" <?php if (ereg("TEST",$obj->paymentmode)) print("CHECKED"); ?>> TEST - 
    <input type="checkbox" name="p_paymentmode[]" value="CHQ"  <?php if (ereg("CHQ",$obj->paymentmode)) print("CHECKED"); ?>> CHQ -
    <input type="checkbox" name="p_paymentmode[]" value="CCB"  <?php if (ereg("CCB",$obj->paymentmode)) print("CHECKED"); ?>> CCB
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    paiement électronique &nbsp;
   </td>
   <td class=color3>
   <?php print($l_paymentlist);?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    gestion du stock &nbsp;
   </td>
   <td class=color3>
   <?php print($l_stockmodelist);?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    stocklimit &nbsp;
   </td>
   <td class=color3 valign=top>
    <input class="text" type="text" name="p_stocklimit" value="<?php print($obj->stocklimit);?>" size="10">
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    avertir d'une commande par mail &nbsp;
   </td>
   <td class=color3 valign=top>
   <?php print($l_commandwarninglist);?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    destinataire supplémentaire &nbsp;
   </td>
   <td class=color3 valign=top>
    <input class="text" type="text" name="p_commandwarningemail" value="<?php print($obj->commandwarningemail);?>" size=40>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    caddie permanent &nbsp;
   </td>
   <td class=color3 valign=top>
   <?php print($l_caddielist);?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    id shop &nbsp;
   </td>
   <td class=color3 valign=top>
   <input class="text" type="text" name="p_idshop" value="<?php print($obj->idshop);?>" size="10">
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    duty free &nbsp;
   </td>
   <td class=color3 valign=top>
   <?php print($l_dutyfreelist);?>
   </td>
  </tr>

  <tr>
   <td align=right class=color2>
    vendeurs &nbsp;
   </td>
   <td class=color3 valign=top>
    <input class="text" type="text" name="p_sellers" value="<?php print($obj->sellers);?>" size=40>
   </td>
  </tr>

 </table>
 <br><br>

<?php show_hr(); ?>

 <br><br>
 <select name=p_shiadmaction>
  <option value="store" SELECTED>-- enregistrer les modifications --</option>
<?php if (ereg("CCB",$obj->paymentmode))  print("<option value=paymentview>-- paramètres bancaires --</option>"); ?>
 </select>
 <input type=submit name="button" value="enregistrer" class="button">

</form>
