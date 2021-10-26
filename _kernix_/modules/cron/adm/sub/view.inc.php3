<?php

$l_sql = "SELECT * FROM $table_cron WHERE idcron = '$p_idcron' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="POST" action="<?=$PHP_SELF?>">
 <input type="hidden" name="p_idcron" value="<?=$p_idcron?>">

 <table align="center" width="85%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Cron <?=$p_idcron?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" value="<?=$obj->name?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">valeur &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_value" class="text" value="<?=$obj->value?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" cols="50" rows="10"><?=$obj->description?></textarea>
   </td>
  </tr> 
 </table> 

<br>

 <select name="p_cronaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce cron --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>

<?php show_back(); ?>

