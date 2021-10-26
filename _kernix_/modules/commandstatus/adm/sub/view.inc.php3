<?php

$l_sql = "SELECT * FROM $table_commandstatus WHERE idcommandstatus = '$p_idcommandstatus' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idcommandstatus" value="<?php print($p_idcommandstatus); ?>">

 <table align="center" width="85%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Statut <?php print("$p_idcommandstatus"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2" width=30%>mode &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_mode" class="text" value="<?php print($obj->mode); ?>" size="5">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">statut &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_status" class="text" value="<?php print($obj->status); ?>" size="5">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" value="<?php print($obj->name); ?>" size="40">
   </td>
  </tr>
 </table> 

<br>

 <select name="p_commandstatusaction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce commandstatus --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>

<?php show_back(); ?>

