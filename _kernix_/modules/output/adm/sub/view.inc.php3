<?php

$l_sql = "SELECT * FROM $table_output WHERE idoutput = '$p_idoutput' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idoutput" value="<?php print("$p_idoutput"); ?>">

 <table align="center" width="80%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Output <?php print("$p_idoutput"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" value="<?php print("$obj->name"); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">valeur &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_value" class="text" value="<?php print("$obj->value"); ?>">
   </td>
  </tr> 
 </table> 

<br>

 <select name="p_outputaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce output --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>

<?php show_back(); ?>

