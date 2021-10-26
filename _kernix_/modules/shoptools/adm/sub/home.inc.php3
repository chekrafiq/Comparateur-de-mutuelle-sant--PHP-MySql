<table width=100% cellspacing=4>
<tr>
<td width=50% align=center valign=top>


<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_roundprice">
<tr>
 <td class=color2 align=center> &#187; arrondir tous les prix &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>mode</td>
<td class=main>
<select name=p_mode>
<option value="ROUND">-- valeur la plus proche --</option>
<option value="CEILING">-- valeur superieure --</option>
<option value="FLOOR">-- valeur inferieure --</option>
</select>
</td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

 </td>
</tr>
</form>
</table>

<br>

<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_changeprice">
<tr>
 <td class=color2 align=center> &#187; maj des prix &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>mode</td>
<td class=main>
<select name=p_mode>
<option value="addval">-- ajouter val --</option>
<option value="addperc">-- ajouter % val --</option>
<option value="subval">-- soustraire val --</option>
<option value="subperc">-- soustraire % val --</option>
</select>
</td>
</tr>
<tr>
<td class=main align=right>valeur</td>
<td class=main><input type=text name=p_val class=text></td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

 </td>
</tr>
</form>
</table>

<br>

<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_stock">
<tr>
 <td class=color2 align=center> &#187; maj des stocks &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>mode</td>
<td class=main>
<select name=p_mode>
<option value="all">-- tous les produits --</option>
<option value="zero">-- produit avec stock = 0 --</option>
</select>
</td>
</tr>
<tr>
<td class=main align=right>valeur à ajouter</td>
<td class=main><input type=text name=p_val class=text></td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

</td>
</tr>
</form>
</table>

<br>

<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_portmode">
<tr>
 <td class=color2 align=center> &#187; maj des modes de port &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>remplacer</td>
<td class=main><?php print(build_select($table_port,"","idport","name","p_source","WHERE sessionflag = 1","AUNCUN PORT","")); ?></td>
</tr>
<tr>
<td class=main align=right>par</td>
<td class=main><?php print(build_select($table_port,"","idport","name","p_val","WHERE sessionflag = 1","AUNCUN PORT","")); ?></td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

</td>
</tr>
</form>
</table>

<br>

<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_portvalue">
<tr>
 <td class=color2 align=center> &#187; maj des valeurs de port &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>mode</td>
<td class=main>
<select name=p_mode>
<option value="all">-- tous les produits --</option>
<option value="zero">-- produit avec valeur = 0 --</option>
</select>
</td>
</tr>
<tr>
<td class=main align=right>valeur</td>
<td class=main><input type=text name=p_val class=text></td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

</td>
</tr>
</form>
</table>

<br>

<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_taxes">
<tr>
 <td class=color2 align=center> &#187; maj des taux de TVA &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>remplacer</td>
<td class=main><?php print(build_select($table_taxes, "", "idtaxes", "name", "p_source", "", "TAXE DU SITE", "")); ?></td>
</tr>
<tr>
<td class=main align=right>par</td>
<td class=main><?php print(build_select($table_taxes, "", "idtaxes", "name", "p_val", "", "TAXE DU SITE", "")); ?></td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

</td>
</tr>
</form>
</table>

<br>

<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_currency">
<tr>
 <td class=color2 align=center> &#187; maj des changes &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>remplacer</td>
<td class=main><?php print(build_select($table_currency, "", "idcurrency", "name", "p_source", "", "DEFAUT : $g_currencyname", "")); ?></td>
</tr>
<tr>
<td class=main align=right>par</td>
<td class=main><?php print(build_select($table_currency, "", "idcurrency", "name", "p_val", "", "DEFAUT : $g_currencyname", "")); ?></td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

</td>
</tr>
</form>
</table>

<br>

<table width="100%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_staction" value="do_suppliers">
<tr>
 <td class=color2 align=center> &#187; maj des fournisseurs &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>remplacer</td>
<td class=main><?php print(build_select($table_supplier, "", "idsupplier", "name", "p_source", "", "", "")); ?></td>
</tr>
<tr>
<td class=main align=right>par</td>
<td class=main><?php print(build_select($table_supplier, "", "idsupplier", "name", "p_val", "", "", "")); ?></td>
</tr>
<tr>
<td class=main align=right>etes vous sur ?</td>
<td class=main><input type=checkbox name=p_flag value=1></td>
</tr>
<tr><td class=main>&nbsp;</td><td class=main><input type=submit value="exécuter" class=button></td></tr>
</table>

</td>
</tr>
</form>
</table>

<br>

</td>
</tr>
</table>

<br><br>

<?php show_back(); ?>
