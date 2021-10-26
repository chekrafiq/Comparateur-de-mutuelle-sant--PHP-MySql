<?php

$l_sql = "SELECT type FROM $table_board WHERE idboard = '$p_idboard'";
$c_db->query($l_sql);
$l_type = $c_db->result(0,"type");

$l_sql = "SELECT * FROM $table_theme WHERE type = '$l_type'";
$c_db->query($l_sql);
$tab_theme[0] = "a u c u n";
while ($obj = $c_db->object_result())
{
  $tab_theme[$obj->idtheme] = $obj->name;
}
  
if (isset($p_idpost))
{
  $l_title = "REPLY TO < $p_title >";
  $p_idparent = $p_idpost;
  $p_level = 1;
}
else
{
  $l_title = "POST";
  $p_idparent = 0;
  $p_level = 0;
}

?>

<form method="post" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_boardaction" value="topicstore">
 <input type="hidden" name="p_idboard" value="<?php print($p_idboard); ?>">
 <input type="hidden" name="p_boardflag" value="create">
 <input type="hidden" name="p_validflag" value="1">
 <input type="hidden" name="p_adminflag" value="1">
 <input type="hidden" name="p_level" value="<?php print($p_level); ?>">
 <input type="hidden" name="p_idparent" value="<?php print($p_idparent); ?>">

 <table align="center" width="85%"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    <?php print(" :: $l_title"); ?>
   </td> 
  </tr>
  <tr>
   <td width= 30% align="right" class="color2">titre &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_title" class="text" size="50">
   </td>
  </tr> 
  <tr>
   <td align="right" valign="top" class="color2">resume &nbsp;</td> 
   <td class="color3">
    <textarea name="p_abstract" cols="50" rows="4"></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" valign="top" class="color2">contenu &nbsp;</td> 
   <td class="color3">
    <textarea name="p_content" cols="50" rows="10"></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">theme &nbsp;</td> 
   <td class="color3">
    <select name=p_idtheme>
<?php

foreach($tab_theme as $key => $value)
{
  print("<option value=$key>-- $value --</option>\n");
}

?>
    </selct>
   </td>
  </tr>
  <tr>
   <td width= 30% align="right" class="color2">lien &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_link" class="text" size="50">
   </td>
  </tr> 
  <tr>
   <td width= 30% align="right" class="color2">icone &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_url" class="text" size="50">
   </td>
  </tr>
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
 </table> 

</form> 





