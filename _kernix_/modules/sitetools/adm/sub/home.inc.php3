
<table width="95%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_sitetoolsaction" value="do_keyword">
<tr>
 <td class=color2 align=center> &#187; gestion des keywords &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>position</td>
<td class=main>
<select name="p_insertplace">
<option value="beginning">-- début --</option>
<option value="end">-- fin --</option>
</select>
</td>
</tr>
<tr>
<td class=main align=right width=30%>mots clefs</td>
<td class=main>
<input type="text" name="p_keywords" class="text" size="40">
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

<br><br>


<table width="95%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_sitetoolsaction" value="do_description">
<tr>
 <td class=color2 align=center> &#187; gestion des descriptions &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>mode</td>
<td class=main>
<select name="p_content">
<option value="sentence">-- inserer la phrase --</option>
<option value="keywords">-- inserer les keywords de la page --</option>
</select>
</td>
</tr>
<tr>
<td class=main align=right width=30%>critere</td>
<td class=main>
<select name="p_whichpage">
<option value="empty">-- dans les pages sans description --</option>
<option value="all">-- dans toutes les pages --</option>
</select>
</td>
</tr>
</tr>
<tr>
<td class=main align=right width=30%>phrase</td>
<td class=main>
<input type="text" name="p_description" class="text" size="40">
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

<br><br>


<table width="95%" bordercolor="black" bgcolor="black" border="0" cellpadding="1" cellspacing="1" align="center">
<form method="POST" action="<?php print($PHP_SELF);?>">
<input type="hidden" name="p_sitetoolsaction" value="do_pub">
<tr>
 <td class=color2 align=center> &#187; gestion des publicités &#171; </td>
</tr>
<tr>
 <td class=list align=center valign=center>

<table width=100% cellspacing=4>
<tr>
<td class=main align=right width=30%>valeur</td>
<td class=main>

<?php $l_null = NULL; print(build_select_wrvg($table_pub, $lnull, "idpub", "name", "p_val", "", "AUCUNE", "", "", "ALEATOIRE", "0")); ?>

</td>
</tr>
<tr>
<td class=main align=right width=30%>critere</td>
<td class=main>
<select name="p_whichpage">
<option value="all">-- dans toutes les pages --</option>
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
<br>

<?php show_back(); ?>
