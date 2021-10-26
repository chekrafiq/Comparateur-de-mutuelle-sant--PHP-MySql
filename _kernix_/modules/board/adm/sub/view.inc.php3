<?php

$l_sql = "SELECT idegroup, name FROM $table_egroup";
$c_db->query($l_sql);
$i = 0;
while ($obj = $c_db->object_result())
{
  $tab_egroup[$i][0] = $obj->idegroup;
  $tab_egroup[$i][1] = $obj->name;
  $i++;
}

$l_sql = "SELECT * FROM $table_post WHERE idboard = '$p_idboard' AND validflag = '0'";
$c_db->query($l_sql);
$l_validate = $c_db->numrows;

$l_sql = "SELECT * FROM $table_board WHERE idboard = '$p_idboard' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>



<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr>
<td width=65% align=center valign=top class=main>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idboard" value="<?php print("$p_idboard"); ?>">

 <table align="center" width="98%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Board <?php print("$p_idboard"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">titre &nbsp;</td> 
   <td class="color3">    
    <input type="text" name="p_title" class="text" value="<?php print("$obj->title"); ?>" size="40">
   </td>
  </tr>
  <tr>
   <td align="right" valign="top" class="color2">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" cols="40" rows="6"><?php print("$obj->description"); ?></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">email &nbsp;</td> 
   <td class="color3">    
    <input type="text" name="p_moderatoremail" class="text" value="<?php print("$obj->moderatoremail"); ?>" size="40">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">type &nbsp;</td> 
   <td class="color3">
    <select name="p_type">
     <option value="NEWS" <?php if ($obj->type == "NEWS") print("SELECTED"); ?>>-- NEWS --</option>
<? /* ?>
<option value="FORUM" <?php if ($obj->type == "FORUM") print("SELECTED"); ?>>-- FORUM --</option>
<option value="DIRECTORY" <?php if ($obj->type == "DIRECTORY") print("SELECTED"); ?>>-- DIRECTORY --</option>
 <option value="BOOKMARK" <?php if ($obj->type == "BOOKMARK") print("SELECTED"); ?>>-- BOOKMARK --</option>
 <option value="FAQ" <?php if ($obj->type == "FAQ") print("SELECTED"); ?>>-- FAQ --</option>
<? */ ?>
    </select>
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">egroup associé &nbsp;</td> 
   <td class="color3">
    <select name="p_idegroup">
<?php
$i = 0;
while ($tab_egroup[$i])
{
  if ($obj->idegroup == $tab_egroup[$i][0])
  {
    print("<option value=\"" . $tab_egroup[$i][0] . "\" SELECTED>-- " . $tab_egroup[$i][1] . " --</option>");
  }
  else
  {
    print("<option value=\"" . $tab_egroup[$i][0] . "\">-- " . $tab_egroup[$i][1] . " --</option>");
  }
  $i++;
}
?>
    </select>
   </td>
  </tr>   
 </table> 

<br>

 <select name="p_boardaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce board --</option>
  <option value="empty">-- vider ce board --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

</td>
<td align=right valign=top class=main>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td align=center  class=color3>
    .:: nb articles ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center valign=center height=25>
    <?php print("$obj->nbtopic / $obj->nbpost"); ?>
  </td>
 </tr>
 <tr>
  <td align=center  class=color3>
    .:: dernier article ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center valign=center height=25>
    <?php print(show_datetime($obj->lastpostdate)); ?>
  </td>
 </tr>
 <tr>
  <td align=center  class=color3>
    .:: articles à valider ::.
  </td>
 </tr>
 <tr>
  <td class=list align=center valign=center height=25>
<?php

  print("$l_validate");

?>
  </td>
 </tr>
</table>
</td></tr></table>

<br>

<table bgcolor=black border=0 cellspacing=0 cellpadding=0 width=90%><tr><td>
<table bgcolor=black border=0 cellspacing=1 cellpadding=1 width=100%>
 <tr>
  <td class=list align=center>
   <br>
   <a href="<?php print("$PHP_SELF?p_boardaction=adminview&p_idboard=$p_idboard"); ?>">- admin avancée -</a><br>
   <a href="<?php print("$PHP_SELF?p_boardaction=view&p_idboard=$p_idboard"); ?>">- actualiser -</a><br>
   <br>
  </td>
 </tr>
</table>
</td></tr></table>

</td>
</tr>
</table>

<br><br>

<?php show_hr(); ?>

<br>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idboard" value="<?php print("$p_idboard"); ?>">
 <select name="p_boardaction">
  <option value="topicadd">-- poster un nouvel article --</option>
  <option value="topiclist">-- lister les articles --</option>
  <option value="listunvalid">-- lister les articles à valider --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<?php show_back(); ?>

