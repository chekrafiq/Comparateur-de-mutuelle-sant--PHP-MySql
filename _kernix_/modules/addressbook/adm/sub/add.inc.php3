<form method="post" action="<?=$PHP_SELF?>">
<input type=hidden name="p_addressbookaction" value="store"> 
<input type=hidden name="p_addressbookflag"   value="create"> 

<table align=center width=90%> 
 <tr>
  <td align="left" class="color1" height="20" colspan="2">
   :: Creer une nouvelle entrée
  </td> 
 </tr>
 <tr>
  <td align="right" class="color2" width="30%">prénom &nbsp;</td> 
  <td class="color3" align="left"><input type="text" name="p_firstname" class="text" size="40"></td>
 </tr>
 <tr>
  <td align="right" class="color2">nom &nbsp;</td> 
  <td class="color3"><input type="text" name="p_lastname" class="text" size="40"></td>
 </tr>
</table> 

<br><br>
<?php show_hr(); ?>
   <br><input type="submit" value="enregistrer" class="button">
</form> 

