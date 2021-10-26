<form action=<?php print("$PHP_SELF"); ?> method=POST>

<input type="hidden" name="p_filename" value="<?php print("$p_userfile_name"); ?>">
<input type="hidden" name="p_rep" value="<?php print("$p_rep"); ?>">

<?php

$l_file = "$l_base/$p_rep/$p_userfile_name";

print("<input type=hidden name=p_userfile_name value=$p_userfile_name>");
print("<textarea rows=20 cols=100 name=p_content>");
readfile($l_file);
print("</textarea>");

?>
<br><br>

<select name=p_fileaction>
 <option value="file_store">-- enregistrer ce fichier --</option>
</select>

&nbsp;&nbsp;<input type="submit" class=button value="exécuter">

</form>

<?php show_back(); ?>
