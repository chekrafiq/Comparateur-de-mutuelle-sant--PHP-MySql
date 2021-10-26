
<table width="400" align="center" cellspacing="0" cellpadding="1" class="border" border="0">
<tr><td>

<table width="100%" cellspacing="1" cellpadding="4" border="0">
<tr>
<td colspan=4 align=center class=forum1>

<br>
<form method="post" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_za"          value="board">
 <input type="hidden" name="p_boardaction" value="post_store">
 <input type="hidden" name="p_idboard"     value="<?php print($p_idboard); ?>">
 <input type="hidden" name="p_validflag"   value="<?php if ($board->moderatorflag == 0) print("1"); else print("0"); ?>">
 <input type="hidden" name="p_adminflag"   value="0">
 <input type="hidden" name="p_level"       value="<?php print($p_level); ?>">
 <input type="hidden" name="p_idparent"    value="<?php print($p_idparent); ?>">
 <input type="hidden" name="p_idref"       value="<?php print($p_idref); ?>">

 <table align="center" width="85%"> 
  <tr>
   <td width= 30% align="left" class="forum1">titre &nbsp;</td>
  </tr>
  <tr>
   <td class="forum1">
    <input type="text" name="p_title" class="forumtext" size="50">
   </td>
  </tr> 
  <tr>
   <td align="left" valign="top" class="forum1">contenu &nbsp;</td> 
  </tr>
  <tr>
   <td class="forum1">
    <textarea name="p_content" cols="40" rows="10" class="forumtext"></textarea>
   </td>
  </tr>
  <tr>
   <td width= 30% align="left" class="forum1">
    theme &nbsp;
   </td> 
  </tr>
  <tr>
   <td width= 30% align="left" class="forum1">
<?php

$l_sql = "SELECT * FROM $table_theme WHERE type = 'FORUM' ";
$c_db->query($l_sql);
$i = 1;
while ($obj = $c_db->object_result())
{
  print("<img src=/upload/modules/board/$obj->picture>");
  print("<input type=radio name=p_idtheme value=$obj->idtheme> &nbsp;");
  if (($i % 8) == 0) print("<br>");
  $i++;
}

?>
   </td> 
  </tr>
  <tr>
   <td class="forum1"><br></td> 
  </tr>
  <tr>
   <td width= 30% align="left" class="forum1">pseudonyme &nbsp;</td> 
  </tr>
  <tr>
   <td class="forum1">
    <input type="text" name="p_nickname" class="forumtext" size="35" value="<?php print($c_cookie->search("nickname")); ?>">
   </td>
  </tr>
  <tr>
   <td width= 30% align="left" class="forum1">email &nbsp;</td> 
  </tr>
  <tr>
   <td class="forum1">
    <input type="text" name="p_email" class="forumtext" size="35" value="<?php print($c_cookie->search("email")); ?>">
   </td>
  </tr>
  <tr>
   <td width= 30% align="left" class="forum1">homepage &nbsp;</td> 
  </tr>
  <tr>
   <td class="forum1">
    <input type="text" name="p_url" class="forumtext" size="35" value="<?php print($c_cookie->search("url")); ?>">
   </td>
  </tr>
  <tr>
   <td class="forum1">
    <input type="checkbox" name="p_storecookie" value="email,nickname,url"> 
    stocker mes informations
   </td>
  </tr>  
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer mon message" class="forumbutton">
   </td>
  </tr> 
 </table> 

</form> 

</td>
</tr>

</table>

</td></tr></table>

