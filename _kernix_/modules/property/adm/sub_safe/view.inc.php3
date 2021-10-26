<?php

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
 <input type=hidden name="p_idproperty" value="<?php print("$obj->idproperty"); ?>">

  <table align=center width=90%>
   <tr>
    <td align="left" class="color1" colspan="2" height="20">
:: PROPERTY < <small><?php print("$obj->propertyname"); ?></small> >  &nbsp;&nbsp; <small><?php print(show_date($obj->date)); ?></small>
    </td> 
   </tr> 
   <tr>
    <td align=right class=color2>name</td> 
    <td class=color3 align=left><input type=text name="p_propertyname" class=text value="<?php print("$obj->propertyname"); ?>" size=50></td>
   </tr>
    <tr>
    <td align=right class=color2 valign=top>structure</td> 
    <td class=color3 align=left><textarea name="p_structure" cols=50 rows=10><?php 
       $l_structure = ereg_replace("&&", "\r\n&&", $obj->structure);
       print("$l_structure"); 
     ?></textarea></td>
   </tr>
  </table> 

<br>
 <input type=hidden name=p_idpoll value="<?php print("$obj->idproperty"); ?>">
 <select name=p_propertyaction>
  <option value=store SELECTED>-- enregistrer les modifications --</option>
  <option value=suppress>-- supprimer --</option>
  <option value=generatepropertyform >-- générer le formulaire --</option>
  <option value=viewpropertyform >-- voir le formulaire --</option>    
 </select>
 <input type="submit" value="exécuter" class="button">
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


<br><br>

<?php show_back(); ?>
