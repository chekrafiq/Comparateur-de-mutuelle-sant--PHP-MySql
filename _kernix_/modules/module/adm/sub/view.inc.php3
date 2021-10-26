<?php

$l_sql = "SELECT * FROM $table_module WHERE idmodule = '$p_idmodule' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idmodule" value="<?php print($p_idmodule); ?>">

 <table align="center" width="85%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Module <?php print("$p_idmodule"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" value="<?php print($obj->name); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">code &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_code" class="text" value="<?php print($obj->code); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" cols="50" rows="10"><?php print($obj->description); ?></textarea>
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">path &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_path" class="text" value="<?php print($obj->path); ?>" size="50">
   </td>
  </tr>  
  <tr>
   <td align="right" class="color2">superuserflag &nbsp;</td> 
   <td class="color3">
    <input type="checkbox" name="p_superuserflag" value="1" <?php if ($obj->superuserflag == 1) print("CHECKED"); ?>>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">subscribeflag &nbsp;</td> 
   <td class="color3">
    <input type="checkbox" name="p_subscribeflag" value="1" <?php if ($obj->subscribeflag == 1) print("CHECKED"); ?>>
   </td>
  </tr>
 </table> 

<br>

 <select name="p_moduleaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce module --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>

<?php show_back(); ?>

