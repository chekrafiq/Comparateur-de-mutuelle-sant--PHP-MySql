<?php

$l_sql = "SELECT * FROM $table_owner WHERE idowner = '$p_idowner' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method="post" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_idowner" value="<?php print("$p_idowner"); ?>">

 <table align="center" width="80%">  
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Owner <?php print("$p_idowner"); ?>
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">login &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_login" class="text" value="<?php print("$obj->login"); ?>">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">password &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_password" class="text" value="<?php print("$obj->password"); ?>">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">property &nbsp;</td> 
   <td class="color3">
<?php

$l_sql = "SELECT idproperty, propertyname FROM $table_property WHERE propertyflag = 'owner'";
$c_db->query($l_sql);
print("<select name=p_idproperty>");
print("<option value=0> --  no property  -- </option>");
$i = 1;
while ($objprop = $c_db->object_result())
{
  $l_selected = "";
  if ($obj->idproperty == $objprop->idproperty)
    $l_selected = "SELECTED";
  print("<option value=$objprop->idproperty $l_selected>-- " . $objprop->propertyname  . " --</option>");
  $i++;
}
print("</select>");

?>
   </td>
  </tr>
 </table> 

<br>

 <select name="p_owneraction">
  <option value="store">-- enregistrer les modifications --</option>
  <option value="suppress">-- supprimer ce owner --</option>
 </select>&nbsp;
 <input type="submit" value="exécuter" class="button">

</form>

<br><br>

<?php show_back(); ?>

