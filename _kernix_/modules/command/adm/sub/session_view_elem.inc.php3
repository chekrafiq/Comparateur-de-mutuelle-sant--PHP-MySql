<table width=90%>
<tr>
 <td align=left class=color1 colspan=2>
   :: achat <?php print($i);?> [ <?php print("$session->idsession");?> ] 
      datée du <?php print(show_datetime($session->date));?>
 </td> 
</tr>

<tr>
<td class=color2 width=30% align=right>
Produit &nbsp;
</td>
<td class=color3>
<?php print($session->description); ?>
</td>
</tr>
<tr>
<td class=color2 width=30% align=right>
Quantite &nbsp;
</td>
<td class=color3>
<?php print($session->quantity); ?>
</td>
</tr>

<tr>
<td class=color2 width=30% align=right>
Prix d'achat HT &nbsp;
</td>
<td class=color3>
<?php print($session->purchasepriceht . " $session->currency"); ?>
</td>
</tr>

<tr>
<td class=color2 width=30% align=right>
Prix UHT &nbsp;
</td>
<td class=color3>
<?php print($session->priceht . " $session->currency"); ?>
</td>
</tr>

<tr>
<td class=color2 width=30% align=right>
Total H.T &nbsp;
</td>
<td class=color3>
<?php print($session->priceht * $session->quantity . " $session->currency"); ?>
</td>
</tr>

<tr>
<td class=color2 width=30% align=right>
Taxes &nbsp;
</td>
<td class=color3>
<?php print("$session->taxe %"); ?>
</td>
</tr>

<tr>
<td class=color2 width=30% align=right>
Total T.T.C &nbsp;
</td>
<td class=color3>
<?php print($session->pricettc * $session->quantity . " $session->currency"); ?>
</td>
</tr>

</table>

<br>
