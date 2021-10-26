<form method="POST" action="<?php print($PHP_SELF); ?>">
 <input type="hidden" name="p_moduleaction" value="store">
 <input type="hidden" name="p_moduleflag" value="create">

 <table align="center" width="85%"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Creer un nouveau module
   </td> 
  </tr>
  <tr>
   <td width="30%" align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" size="35">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">code &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_code" class="text" size="35">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2" valign="top">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" cols="50" rows="10"></textarea>
   </td>
  </tr>
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
 </table> 

</form> 
