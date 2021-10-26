<?php

$l_sql = "SELECT * FROM $table_msg WHERE idmsg = '$p_idmsg'";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idmsg" value="<?php print($p_idmsg); ?>">

 <table align="center" width="98%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Msg <?php print("$p_idmsg"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">code &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_code" class="text" value="<?php print($obj->code); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">titre &nbsp;</td> 
   <td class="color3">
    <textarea name="p_title" cols="55" rows="4"><?php print($obj->title); ?></textarea>
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2" valign="top">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" cols="55" rows="35"><?php print($obj->description); ?></textarea>
   </td>
  </tr> 
 </table> 

<br>

<?php show_hr(); ?>

<br><br>

 <select name="p_msgaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce msg --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<?php show_back(); ?>

