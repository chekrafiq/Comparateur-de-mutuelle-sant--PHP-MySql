<?php

$l_sql = "SELECT * FROM $table_theme WHERE idtheme = '$p_idtheme' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idtheme" value="<?php print("$p_idtheme"); ?>">

 <table align="center" width="80%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Theme <?php print("$p_idtheme"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" value="<?php print("$obj->name"); ?>" size=40>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">sujet &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_subject" class="text" value="<?php print("$obj->subject"); ?>" size=40>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">image &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_picture" class="text" value="<?php print("$obj->picture"); ?>" size=40>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">type &nbsp;</td> 
   <td class="color3">
    <select name="p_type">
     <option value="NEWS" <?php if ($obj->type == "NEWS") print("SELECTED"); ?>>-- NEWS --</option>
     <option value="FORUM" <?php if ($obj->type == "FORUM") print("SELECTED"); ?>>-- FORUM --</option>
     <option value="DIRECTORY" <?php if ($obj->type == "DIRECTORY") print("SELECTED"); ?>>-- DIRECTORY --</option>
     <option value="BOOKMARK" <?php if ($obj->type == "BOOKMARK") print("SELECTED"); ?>>-- BOOKMARK --</option>
     <option value="FAQ" <?php if ($obj->type == "FAQ") print("SELECTED"); ?>>-- FAQ --</option>
    </select>
   </td>
  </tr>  
 </table> 

<br>

 <select name="p_themeaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce theme --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>
<?php 

show_hr();

print("<br><center><img src=/upload/modules/board/$obj->picture></center>");

?>

<br><br>

<?php show_back(); ?>

