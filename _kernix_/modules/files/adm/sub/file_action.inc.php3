<?php

$l_file = "$g_urlroot/upload/$p_rep/" . $p_userfile_name;

$l_size = filesize("$l_base/$p_rep/" . $p_userfile_name) / 1000;

$l_size = sprintf("%.2f", $l_size);

print(".::&nbsp; <a href=$l_file>" . $p_userfile_name . "</a> [ <i>$l_size k </i> ] &nbsp;::.<br><br>");

show_hr();

?>

<form action="<?=$PHP_SELF?>">
 <input type="hidden" name="p_rep" value="<?=$p_rep?>">
 <input type="hidden" name="p_oldfile_name" value="<?=$p_userfile_name?>">
 <input name="p_userfile_name" type="text" class="text">
 <select name="p_fileaction">
  <option value="file_rename">-- renommer ce fichier --</option>
  <option value="file_copy">-- copier --</option>
 </select>
 <br><br>
 <input type="submit" value="exécuter" class="button">
</form>

<?php

show_hr();

?>

<form action="<?=$$PHP_SELF?>">
 <input type="hidden" name="p_rep" value="<?=$p_rep?>">
 <input type="hidden" name="p_userfile_name" value="<?=$p_userfile_name?>">
 <select name="p_fileaction">
<?php if (eregi("\.(gif)$|\.(jpe?g)$|\.(png)$",$p_userfile_name)): ?>
  <option value="file_transform">-- modifier cette image --</option>
<?php elseif (eregi("\.(zip)$",$p_userfile_name)): ?>
  <option value="file_unzip">-- dezipper ce fichier --</option>
<?php endif; ?>
  <option value="file_edit">-- editer ce fichier --</option>
  <option value="file_delete">-- supprimer ce fichier --</option>
 </select>
 <input type="submit" value="exécuter" class="button">
</form>

<?php 

if (eregi("\.(gif)$|\.(jpe?g)$|\.(png)$",$p_userfile_name))
{
  show_hr();
  print("<br><center><img src=\"/upload/$p_rep/$p_userfile_name\"></center><br>");
}

show_back_url("$PHP_SELF?p_fileaction=file_list&p_userfile_name=&p_rep=$p_rep");

?>

