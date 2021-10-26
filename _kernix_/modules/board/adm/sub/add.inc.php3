<form method="post" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_boardaction" value="store">
 <input type="hidden" name="p_boardflag" value="create">

 <table align="center" width="85%"> 
  <tr>
   <td align="left" class="color1" height="20" colspan="2">
    :: Creer un nouveau BOARD
   </td> 
  </tr>
  <tr>
   <td width= 30% align="right" class="color2">nom &nbsp;</td> 
   <td class="color3">
    <input type="text" name="p_title" class="text" size="35">
   </td>
  </tr> 
  <tr>
   <td align="right" valign="top" class="color2">description &nbsp;</td> 
   <td class="color3">
    <textarea name="p_description" cols="50" rows="6"></textarea>
   </td>
  </tr>
  <tr>
   <td align="right" class="color2">type &nbsp;</td> 
   <td class="color3">
    <select name="p_type">
<?// <option value="FORUM">-- FORUM --</option> ?>
     <option value="NEWS">-- NEWS --</option> ?>
<?// <option value="DIRECTORY">-- DIRECTORY --</option> ?>
<?// <option value="BOOKMARK">-- BOOKMARK --</option> ?>
<?// <option value="FAQ">-- FAQ --</option> ?>
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





