
<br>
visualiser ou downloader mes fichiers
<br><br>

<form action="<?=$PHP_SELF?>">
 <input type="hidden" name="p_fileaction" value="file_list">
 <select name="p_rep">
<?php

$i = 0;
while ($tab_dir[$i])
{
  $l_select = '';
  if ($tab_dir[$i] == 'pictures') $l_select = 'SELECTED';
  print("<option value=" . $tab_dir[$i] . " $l_select> -- " . $tab_dir[$i] . " -- </option>\n");
  $i++;
}

?>
 </select>
 <br><br>
 <input type="submit" class="button" value="lister les fichiers">
</form>
