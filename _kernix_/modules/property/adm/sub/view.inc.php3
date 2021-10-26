<?php

$l_sql = "SELECT idref FROM $table_ref WHERE idproperty = '$p_idproperty' ";
$c_db->query($l_sql);
$npages = $c_db->numrows; 

$l_sql = "SELECT * FROM $table_property WHERE idproperty = '$p_idproperty' ";
$c_db->query($l_sql);
$obj = $c_db->object_result();

?>

<form method=post action="<?php print("$PHP_SELF"); ?>">
 <input type=hidden name="p_idproperty" value="<?php print($obj->idproperty); ?>">

  <table align=center width=90%>
   <tr>
    <td align="left" class="color1" colspan="2" height="20">
:: Type de page < <small><?php print("$obj->propertyname"); ?></small> > <br> &nbsp;&nbsp; <small><?php print(show_date($obj->date)); ?></small>
- <small><?php print("$npages pages utilisent ce type de page"); ?></small>
    </td> 
   </tr> 
   <tr>
    <td align=right class=color2>nom</td> 
    <td class=color3 align=left><input type=text name="p_propertyname" class=text value="<?php print("$obj->propertyname"); ?>" size=50></td>
   </tr>
    <tr>
    <td align=right class=color2 valign=top>structure</td> 
    <td class=color3 align=left><textarea name="p_structure" cols=50 rows=10><?php 
       $l_structure = ereg_replace("&&", "\r\n&&", $obj->structure);
       print($l_structure); 
     ?></textarea></td>
   </tr>
  </table> 

<br>
 <input type=hidden name=p_idpoll value="<?php print("$obj->idproperty"); ?>">
 <select name=p_propertyaction>
  <option value=store SELECTED>-- enregistrer les modifications --</option>
  <option value=suppress>-- supprimer --</option>
  <option value=filelist>-- lister les fichiers --</option>
  <option value=rebuild>-- db rebuild --</option>
 </select>
 <input type="submit" value="exécuter" class="button">
</form>

<br><br>

<?php show_hr(); ?>

<form>
<textarea cols="70" rows="10"><?php include("sub/doc.txt"); ?></textarea>
</form>


<br><br>

<?php show_back(); ?>
