
<a href="<?=$PHP_SELF?>?p_fileaction=file_list&p_rep=<?=$p_rep?>" title="rafraichir la liste < <?=$p_rep?> >"><img src="/pictures/adm/reload.gif" border="0"></a>

<br><br>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 align=center width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=2 width=100%>

<?php

$l_files = getFileList("$g_absolutepath/upload/".$p_rep);
if (sizeof($l_files) != 0) sort($l_files);
$i = 0;

while ($l_files[$i])
{
  print("<tr>");
  print("<td class=list align=left width=50%>&nbsp;<a href=$PHP_SELF?p_fileaction=file_action&p_userfile_name=" . urlencode($l_files[$i]) . "&p_rep=$p_rep title=\"delete,rename,move,edit\"><img src=/pictures/poll/msg.gif border=0></a>&nbsp; <a href=\"$g_urlroot/upload/$p_rep/" . $l_files[$i]  . "\">" . $l_files[$i] . "</a></td>");
  $i++;
  if ($l_files[$i])
  {
    print("<td class=list align=left width=50%>&nbsp;<a href=$PHP_SELF?p_fileaction=file_action&p_userfile_name=" . urlencode($l_files[$i]) . "&p_rep=$p_rep title=\"delete,rename,move,edit\"><img src=/pictures/poll/msg.gif border=0></a>&nbsp;<a href=\"$g_urlroot/upload/$p_rep/" . $l_files[$i]  . "\">" . $l_files[$i] . "</a></td>");
  }
  else
  {
    print("<td class=list align=left width=50%>&nbsp</td>");  
  }
  print("</tr>");
  $i++;
}

?>

</table>
</td></tr></table>
<br><br>


<?php
show_hr();
?>

<br>
créer un nouveau fichier/répertoire

<form action="<?=$PHP_SELF?>" method="POST">
 <input type="hidden" name="p_fileaction" value="file_create">
 <input type="hidden" name="p_rep" value="<?=$p_rep?>">

 <input type="text" name="p_filename" size="35" class="text">
 <br>
 <select name="p_type">
  <option value="file">-- fichier --</option>
  <option value="directory">-- répertoire --</option>
 </select> 
 <input type="submit" class="button" value=" exécuter ">

</form>

<?php
show_back();
?>


