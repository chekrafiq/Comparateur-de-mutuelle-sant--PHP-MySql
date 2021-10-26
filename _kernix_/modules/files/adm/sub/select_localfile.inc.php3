<form enctype="multipart/form-data" action="<?=$PHP_SELF?>" method="post">
<input type="hidden" name="MAX_FILE_SIZE" value="100000000">
<input type="hidden" name="p_fileaction" value="file_send">

<table>
 <tr>
  <td class="main" align="right">selection du fichier &nbsp;</td> 
  <td valign="top" align="left"><input name="p_userfile" type="file" class="text"></td>
 </tr>
 <tr>
  <td class="main" align="right">répertoire de destination &nbsp;</td>
  <td valign="top" align="left">
   <select name="p_rep">
<?php

if (empty($p_rep)) $p_rep = 'upload/pictures';

$tab_dir = array();
getDirList("$g_absolutepath/upload/",''); 

sort($tab_dir);
$i = 0;
while ($tab_dir[$i])
{
  $l_rep = $tab_dir[$i];
  if ($p_rep == "upload/$l_rep") $l_selected = "SELECTED";
  print("<option value=upload/$l_rep $l_selected> -- $l_rep -- </option>\n");
  $l_selected = "";
  $i++;
}

?>
   </select>
  </td>
 </tr>
 <tr>
  <td class="main" align="right">forcer l&#39;écriture &nbsp;</td>
  <td align="left" class="main"><input type="checkbox" name="p_uploadflag"></td>
 </tr>
 <tr>
  <td colspan="2" align="center">
   <br><input type="submit" value="envoyer le fichier" class="button">
  </td>
 </tr>
 </table>
</form>
