<?php

$l_sql = "SELECT * FROM $table_ref WHERE idref = '$p_idref'";
$c_db->query($l_sql);
$ref = $c_db->object_result();

$l_sql = "SELECT * FROM $table_product WHERE idproduct = '$ref->idproduct'";
$c_db->query($l_sql);
$product = $c_db->object_result();

$l_currencylist = build_select($table_currency,$product->idcurrency,"idcurrency","name","p_idcurrency","","DEFAUT : $g_currencyname","");
$l_portlist     = build_select($table_port,$product->idport,"idport","name","p_idport","WHERE sessionflag = 1 ORDER BY idport","CELUI DU SITE","");
$l_tvalist      = build_select($table_taxes,$product->idtaxes,"idtaxes","name","p_idtaxes","","TAXE DU SITE","");
$l_supplierlist = build_select($table_supplier,$product->idsupplier,"idsupplier","name","p_idsupplier","","","");
$l_caddielist   = yesno_list($product->caddieflag, "p_caddieflag");

include("sub/onglet.inc.php3");

?>

<form method="post" action="<?php print($PHP_SELF)?>">
 <input type="hidden" name="p_idproduct" value="<?php print($ref->idproduct)?>">

 <table width=100%>

  <tr>
   <td align=left class=color1 colspan=2 height=20>
:: [ <small>page#<?php print($p_idref); ?></small> ] produit<small>[<?php print($ref->idproduct); ?>]</small> : <small><?php print($ref->name); ?></small> 
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    référence interne &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_productcode" value="<?php print($product->productcode);?>">
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    info &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_productinfo" value="<?php print($product->productinfo);?>" size="60">
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    prix &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_price" value="<?php print($product->price);?>">
<?php
if (($product->idcurrency == 0) && !empty($product->price))
{
  print(" $g_currencyname");
}
?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right> 
    change &nbsp;
   </td>
   <td class=color3>
    <?php print($l_currencylist);?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    vieux prix (<small>solde</small>) &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_oldprice" value="<?php print($product->oldprice);?>">
    <?php print(" $g_currencyname"); ?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    prix d'achat H.T &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_purchaseprice" value="<?php print($product->purchaseprice);?>">
    <?php print(" $g_currencyname"); ?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    stock &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_stock" value="<?php print($product->stock);?>">
   </td>
  </tr>

 
  <tr>
   <td class=color2 align=right>
    TVA &nbsp;
   </td>
   <td class=color3>
    <?php print($l_tvalist);?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    port &nbsp;
   </td>
   <td class=color3>
    <?php print($l_portlist);?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    port value &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_port_value" value="<?php print($product->port_value);?>"> 
<?php 
if ($product->idport == 1) print($g_currencytxt);
elseif ($product->idport == 5) print("%");
?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right> 
    fournisseur &nbsp;
   </td>
   <td class=color3>
    <?php print($l_supplierlist);?>
   </td>
  </tr>

  <tr>
   <td class=color2 align=right valign=top>
    avis produit &nbsp;
   </td>
   <td class=color3>
    <textarea type="text" name="p_opinion" rows=6 cols=60><?php print($product->opinion);?></textarea> 
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    date de début &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_startdate" value="<?php print(show_date($product->startdate));?>">
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    date de fin &nbsp;
   </td>
   <td class=color3>
    <input class="text" type="text" name="p_enddate" value="<?php print(show_date($product->enddate));?>">
   </td>
  </tr>

  <tr>
   <td class=color2 align=right>
    caddie &nbsp;
   </td>
   <td class=color3>
    <?php print($l_caddielist);?>
   </td>
  </tr>

 <tr>
  <td colspan="2" align="center">

   <br>
    <input type="hidden" name="p_idref" value="<?=$p_idref?>">
    <select name="p_siteadmaction" size="1">
     <option value=product_update selected> -- enregistrer les modifications -- </option>
    </select>
    <input type="submit" name="submit" value="exécuter" class="button">
    <br><br>
  </td>
 </tr>

</table>

</form>
