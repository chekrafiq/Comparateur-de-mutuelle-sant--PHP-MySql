<form method="post" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_owneraction" value="store">
 <input type="hidden" name="p_ownerflag" value="create">

 <table align="center" width="85%"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Creer un nouveau owner
   </td> 
  </tr>
  <tr>
   <td width= 30% align="right" class="color2">login &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_login" class="text" size="35">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">password &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_password" class="text" size="35">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">property &nbsp;</td> 
   <td class="color3">
<?php

$l_sql = "SELECT idproperty, propertyname FROM $table_property WHERE propertyflag = 'owner'";
$c_db->query($l_sql);
print("<select name=p_idproperty>");
print("<option value=0>-- no property --</option>");
$i = 1;
while ($objprop = $c_db->object_result())
{
  print("<option value=$objprop->idproperty>-- " . $objprop->propertyname  . " --</option>");
  $i++;
}
print("</select>");

?>
   </td>
  </tr>
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
 </table> 

</form> 





