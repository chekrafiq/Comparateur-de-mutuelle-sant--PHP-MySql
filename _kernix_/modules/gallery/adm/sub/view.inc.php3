<?php

$l_sql = "SELECT * FROM $table_gallery WHERE idgallery = '$p_idgallery' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idgallery" value="<?php print($p_idgallery); ?>">

 <table align="center" width="85%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Gallery <?php print("$p_idgallery"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" value="<?php print($obj->name); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">valeur &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_value" class="text" value="<?php print($obj->value); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" cols="50" rows="10"><?php print($obj->description); ?></textarea>
   </td>
  </tr> 
 </table> 

<br>

 <select name="p_galleryaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce gallery --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>

<?php show_back(); ?>

