<?php

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">

 <table align=center width=90%> 
  <input type=hidden name="p_idproperty" value="<?php print("$obj->idproperty"); ?>">
   <tr>
    <td align=right class=color2>name</td> 
    <td class=color3 align=left colspan=2><input type=text name="p_propertyname" class=text value="<?php print("$obj->propertyname"); ?>" size=50></td>
   </tr>
    <tr>
    <td align=right class=color2 valign=top>datas</td> 
    <td class=color3 colspan=2 align=left><textarea name="p_structure" cols=50 rows=10><?php print("$obj->structure"); ?></textarea></td>
   </tr>
   <tr>
    <td align=right class=color2>propertyflag</td> 
    <td class=color3 colspan=2  align=left>
     <select name="p_propertyflag">
      <option value="category" <?php if($p_propertyflag == "category"){print("SELECTED");} ?>>category</option>
      <option value="ref" <?php if($p_propertyflag == "ref"){print("SELECTED");} ?>>ref</option>
     </select>
    </td>
   </tr>
   <tr>
    <td align=right valign=top class=color2>idowner</td> 
    <td class=color3 colspan=2><input type=text name="p_idowner" size=50 class=text value="<?php print("$obj->idowner"); ?>" size=50></td>
   </tr>
  </table> 

<br>
 <input type=hidden name=p_idpoll value="<?php print("$obj->idproperty"); ?>">
 <select name=p_propertyaction>
  <option value=update SELECTED>enregistrer les modifications</option>
  <option value=delete >supprimer</option>
  <option value=generatepropertyform >générer le formulaire</option>
  <option value=viewpropertyform >voir le formulaire</option>    
 </select>
 <input type=submit value=executer class=button>
</form>

<?php show_back(); ?>
