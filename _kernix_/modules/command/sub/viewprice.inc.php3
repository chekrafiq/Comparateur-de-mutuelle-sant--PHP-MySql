<?php

if (($product->price == 0) || ($product->caddieflag == 0))
{
  return 0;
}

if (($product->stock == 0) && ($adm->stockmodeflag == 1))
{
  return 0;
}

$l_idtaxe = get_proper_taxe($product, $adm);
$l_sql    = "SELECT rate FROM $table_taxes WHERE idtaxes = '$l_idtaxe'";
$c_db->query($l_sql);
$taxe     = $c_db->object_result();

if ($adm->idpriceentermode == 1) 
{ 
  // mode HT
  $l_priceht  = $product->price;
  $l_pricettc = calc_taxe($product->price, $taxe->rate, 1); 
}
else
{
  // mode TTC
  $l_pricettc = $product->price;
  $l_priceht  = calc_taxe($product->price, $taxe->rate, -1);
}

$l_idcurrency    = get_proper_currency($product, $adm);
if ($adm->idcurrency != $l_idcurrency)
{
  $l_sql           = "SELECT value FROM  $table_currency WHERE idcurrency = '$l_idcurrency'";
  $c_db->query($l_sql);
  $l_currencyvalue = $c_db->result(0,"value");
  $l_pricettc     *= $l_currencyvalue;
}

?>

<table width=90% border=0>
 <tr>
  <td class=cellname colspan=2 align=left>
   #ref <font style="color: #AAAAAA; font-weight: bold;"><?php print($product->productcode); ?></font>
  </td>
 </tr>
 <tr>
  <td class=cellname align=left>
   prix TTC
  </td>
  <td class=cellvalue> 
   <?php printf("<b>%.2f</b> $adm->currencyhtml",$l_pricettc); ?>
  </td>
 </tr>
 <tr>
  <td class=cellname align=left>
  &nbsp;
  </td>
  <td class=cellvalue> 
   <?php $l_priceff = $l_pricettc * 6.55; printf("%.2f FF",$l_priceff); ?>
  </td>
 </tr>
 <tr>
  <td class=cellname align=left>
   prix HT&nbsp;&nbsp;
  </td>
  <td class=cellvalue> 
   <?php print("$l_priceht $adm->currencyhtml"); ?>
  </td>
 </tr>
<?php if ($product->oldprice > 0): ?>
 <tr>
  <td class=cellname align=left>
   vieux Prix
  </td>
  <td class=cellvalue> 
   <?php print("<s>$product->oldprice $adm->currencyhtml</s>"); ?>
  </td>
 </tr>
<?php endif; ?>
 <tr>
  <td class=cellname align=left>
   stock
  </td>
  <td class=cellvalue>
   <?php print("$product->stock"); ?>
  </td>
 </tr>
</table>

<br>

<table width="90%" border="0" cellspacing="0" cellpadding="0">
<form action="<?php print($g_urldyn); ?>" method="POST">
<input type="hidden" name="p_za"            value="command">
<input type="hidden" name="p_commandaction" value="caddie_property">
<input type="hidden" name="p_fromref"       value="<?php print($p_idref); ?>">
<input type="hidden" name="p_idproduct"     value="<?php print($ref->idproduct); ?>">
<input type="hidden" name="p_quantity"      value="1">

 <tr>
  <td class=main align=center>
<?php
// AFFICHAGE AJOUTER AU CADDIE
print("<input type=image value=submit src=/upload/pictures/ico_ajouteraupanier.gif border=0>");
?>
  </td>
 </tr> 
</form>
</table>

<br>

<table width="90%" border="0" cellspacing="0" cellpadding="0">
<form action="<?php print($g_urldyn); ?>" method="POST">
<input type="hidden" name="p_za"            value="command">
<input type="hidden" name="p_commandaction" value="caddie_view">
<input type="hidden" name="p_fromref"       value="<?php print($p_idref); ?>">

 <tr>
  <td class=main align=center>
<?php
if ($g_caddieflag == 1)
{
  // AFFICHAGE VOIR CADDIE
  print("<input type=image value=submit src=/upload/pictures/ico_voirlepanier.gif border=0>");
}
?>
  </td>
 </tr> 
</form>
</table>
