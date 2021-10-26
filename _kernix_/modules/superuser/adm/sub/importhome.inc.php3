<form action="<?=$PHP_SELF?>">
<input type="hidden" name="p_superuseraction" value="importexec">

<table width="90%">
 <tr><td class="main" align="right" width="30%">fichier à remplacer &nbsp;<br>(<i>dans files</i>) &nbsp; </td><td><input type="text" name="p_file" class="text" size="50"></td></tr>
 <tr><td class="main" align="right">caractère de séparation &nbsp; (<i> \t ; , etc.</i>) &nbsp; </td><td class="main"><input type="text" name="p_sep" class="text" size="3"></td></tr>
 <tr><td class="main" align="right">&nbsp;</td><td class="main"><input type="checkbox" name="p_testflag" value="1" CHECKED> tester une ligne</td></tr>
 <tr><td class="main" align="right">&nbsp;</td><td class="main"><input type="checkbox" name="p_showflag" value="1"> afficher les idref</td></tr>
 <tr><td class="main" align="right">&nbsp;</td><td><br><input type="submit" value="exécuter" class="button"></td></tr>
</table>
</form>

