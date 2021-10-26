<form method="POST" action="<?php print("$PHP_SELF"); ?>">
 <input type="hidden" name="p_propertyaction" value="store">
 <input type="hidden" name="p_propflag"   value="create">

 <table align="center" width="90%"> 
  <tr>
   <td align="left" class="color1" colspan="2" height="20">
    :: Ajouter une PROPERTY
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
   <td align="center" colspan="2">
    <br><input type="submit" value="enregistrer" class="button">
   </td>
  </tr> 
 </table> 

</form> 

<br><br>

<?php show_hr(); ?>

<form>
<textarea cols="70" rows="10">nom;;type;;value
&& ...

type
0 : txt
1 : txtarea
2 : select

value
comma separated for select


example :

couleur;;2;;vert,rouge,bleu,jaune
&&taille;;2;;2 par 4, 4 par 6
&&tissu;;0;;options:lin,coton
&&motifs;;0;;options:golf,chasse

NOTE pour les produits
mettre un _ devant les caracteristiques du produit

exemple :
_couleur;;0;;options:vert, rouge
&&font;;0;;
</textarea>
</form>

