<?php

$l_price        = $session->pricettc;
$l_total        = $session->quantity * $l_price;
$g_price       += $l_total;
$g_quantity    += $session->quantity;

?>

<table width="95%" bgcolor="#444F5F" border="0" cellpadding="1" cellspacing="1">

 <tr>
  <td class="caddiecolor2" align="right" valign="top" width="20%">
   <?=$gl_product?> &nbsp; 
  </td>
  <td class="caddiecolor1" valign="top">
   &nbsp;<b><?=$session->description?></b>
   <a href="<?php print("$g_urldyn?p_idref=$session->idref"); ?>" title="page produit">&#187;</a><br>
<?php 

$tab_options = explode("&",$session->options);
$i = 0;
while ($tab_options[$i])
{
  list($l_key,$l_val) = explode("=",$tab_options[$i]);
  print("&nbsp; &middot; " . urldecode($l_key) . " : " . urldecode($l_val) . "<br>");
  $i++;
}
print($l_tab[1]); 

?>
  </td>

  <td class="caddiedelete" rowspan="4" align="center" valign="top">

<?php

if (!empty($session->icon)) print("<img src=/upload/pictures/$session->icon width=80 height=80 vspace=2><br>");

?>   

  </td>
</form>
 </tr>

 <tr>
  <td class="caddiecolor2" align="right">
    <?php print($gl_price3); ?> &nbsp;
  </td>
  <td class="caddiecolor1">
   &nbsp;<?php print("$l_price $g_currencyhtml"); ?>
  </td>
 </tr>

 <tr>
  <td class="caddiecolor2" align="right">
   <?php print($gl_price4); ?> &nbsp;
  </td>
  <td class="caddiecolor1">
   &nbsp;<?php print("$l_total $g_currencyhtml"); ?>
  </td>
 </tr>

 <form method="POST"  action="<?=$PHP_SELF?>">
 <tr>
  <td class="caddiecolor2" align="right">
   <?=$gl_quantity?> &nbsp;
  </td>
  <td class="caddiecolor1" align="left">
   <input type="hidden" name="p_za"                  value="command">
   <input type="hidden" name="p_commandaction"       value="caddie_view">
   <input type="hidden" name="p_caddiecookieaction"  value="chgq">
   <input type="hidden" name="p_idsession"           value="<?=$session->idsession?>">
   <input type="hidden" name="p_fromref"             value="<?=$session->idref?>">
   &nbsp;<input type="text" size="2" value="<?=$session->quantity?>" class="caddietext" name="p_quantity">
   <input type="submit" value="<?=$gl_change?>" class="caddiebutton" title="modifier la quantité"> (<?=$gl_zerotosuppress?>)
  </td>
 </tr>
 </form>

</table>
