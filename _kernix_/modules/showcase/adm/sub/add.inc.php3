<form method="post" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_showcaseaction" value="store">
 <input type="hidden" name="p_showcaseflag" value="create">

 <table align="center" width="75%"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Creer un nouveau showcase
   </td> 
  </tr>
  <tr>
   <td width= 30% align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" size="35">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2" valign="top">sujet &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" class="text" cols="35" rows="6"></textarea>
   </td>
  </tr>
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
 </table> 

</form> 





