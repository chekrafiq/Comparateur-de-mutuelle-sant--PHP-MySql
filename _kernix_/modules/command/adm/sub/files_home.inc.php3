<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td class=color2 align=center colspan=2> &#187; factures &#171; </td>
 </tr>
 <tr>
  <td class=list align=center>

<br>
<form method="POST" action="<?php print($PHP_SELF); ?>">
<input type="hidden" name="p_commandaction" value="files_bill">
<table width=98%>
<tr>
<td class=list width=40% align=right>date de début &nbsp;</td>
<td class=list><input type=text size=20 class=text name=p_deb value="<?php print(date("01/m/Y")); ?>"> jj/mm/aaaa</td>
</tr>
<tr>
<td class=list align=right>date de fin &nbsp;</td>
<td class=list><input type=text size=20 class=text name=p_end value="<?php print(date("d/m/Y")); ?>"> jj/mm/aaaa</td>
</tr>
<tr><td colspan=2 class=list align=center><br><input type=submit value="exécuter" class=button></td></tr>
</table>
</form>
   
  </td>
 </tr>
</table>
</td></tr></table>

<br><br>

<?php show_hr(); ?>

<br><br>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td class=color2 align=center colspan=2> &#187; fichier comptable &#171; </td>
 </tr>
 <tr>
  <td class=list align=center>

<br>
<form method="POST" action="<?php print($PHP_SELF); ?>">
<input type="hidden" name="p_commandaction" value="files_bookkeeper">
<table width=98%>
<tr>
<td class=list width=40% align=right>date de début &nbsp;</td>
<td class=list><input type=text size=20 class=text name=p_deb value="<?php print(date("01/m/Y")); ?>"> jj/mm/aaaa</td>
</tr>
<tr>
<td class=list align=right>date de fin &nbsp;</td>
<td class=list><input type=text size=20 class=text name=p_end value="<?php print(date("d/m/Y")); ?>"> jj/mm/aaaa</td>
</tr>
<tr>
<td class=list align=right>email &nbsp;</td>
<td class=list><input type=text size=25 class=text name=p_email value="<?php print($adm->email); ?>"></td>
</tr>
<tr><td colspan=2 class=list align=center><br><input type=submit value="exécuter" class=button></td></tr>
</table>
</form>
   
  </td>
 </tr>
</table>
</td></tr></table>

<br><br>

<?php show_hr(); ?>

<br><br>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td class=color2 align=center colspan=2> &#187; fichier clients &#171; </td>
 </tr>
 <tr>
  <td class=list align=center>

<br>
<form method="POST" action="<?php print($PHP_SELF); ?>">
<input type="hidden" name="p_commandaction" value="files_clients">
<table width=98%>
<tr>
<td class=list width=40% align=right>date de début &nbsp;</td>
<td class=list><input type=text size=20 class=text name=p_deb value="<?php print(date("01/m/Y")); ?>"> jj/mm/aaaa</td>
</tr>
<tr>
<td class=list align=right>date de fin &nbsp;</td>
<td class=list><input type=text size=20 class=text name=p_end value="<?php print(date("d/m/Y")); ?>"> jj/mm/aaaa</td>
</tr>
<tr>
<td class=list align=right>email &nbsp;</td>
<td class=list><input type=text size=25 class=text name=p_email value="<?php print($adm->email); ?>"></td>
</tr>
<tr><td colspan=2 class=list align=center><br><input type=submit value="exécuter" class=button></td></tr>
</table>
</form>
   
  </td>
 </tr>
</table>
</td></tr></table>

<br><br><br>

<?php show_back(); ?>
