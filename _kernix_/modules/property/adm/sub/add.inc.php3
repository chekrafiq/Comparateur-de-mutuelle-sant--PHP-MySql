<form method="POST" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_propertyaction" value="store">
 <input type="hidden" name="p_propflag"   value="create">

 <table align="center" width="90%"> 
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Ajouter un type de page
   </td> 
  </tr>
  <tr>
   <td align="right" class="color2">nom &nbsp;</td> 
   <td class="color3"><input type="text" name="p_propertyname" class="text"></td>
  </tr> 
  <tr>
   <td align="right" class="color2" valign="top">structure &nbsp;</td> 
   <td class="color3"><textarea name="p_structure" cols="50" rows="10"></textarea></td>
  </tr> 
  <tr>
   <td align="right" class="color2" valign="top">copier la structure depuis &nbsp;</td> 
   <td class="color3">

    <?php print(build_select($table_property, 0, "idproperty", "propertyname", "p_idpropertysource", "",  "AUCUNE", "")); ?>

   </td>
  </tr> 
  <tr>
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
</table> 

</form> 

<br><br>

<?php show_hr(); ?>

<form>
<textarea cols="70" rows="10"><?php include("sub/doc.txt"); ?></textarea>
</form>

