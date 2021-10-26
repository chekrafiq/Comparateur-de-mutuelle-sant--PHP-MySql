<form method="post" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_themeaction" value="store">
 <input type="hidden" name="p_themeflag" value="create">

 <table align="center" width="85%"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Creer un nouveau theme
   </td> 
  </tr>
  <tr>
   <td width= 30% align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_name" class="text" size="35">
   </td>
  </tr> 
  <tr>
   <td align="right" class="color2">sujet &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_subject" class="text" size="35">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">image &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_picture" class="text" size="35">
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">type &nbsp;</td> 
   <td class="color3">
    <select name="p_type">
     <option value="NEWS">-- NEWS --</option>
     <option value="FORUM">-- FORUM --</option>
     <option value="DIRECTORY">-- DIRECTORY --</option>
     <option value="BOOKMARK">-- BOOKMARK --</option>
     <option value="FAQ">-- FAQ --</option>
    </select>
   </td>
  </tr> 
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
 </table> 

</form> 





